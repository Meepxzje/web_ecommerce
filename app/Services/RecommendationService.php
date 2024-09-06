<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Sanpham;
use Illuminate\Support\Facades\Log;

class RecommendationService
{
    public function dexuatspchuaxem($nguoidungid)
    {

        $daxem = DB::table('luotxemsanpham')
            ->where('nguoidungid', $nguoidungid)
            ->pluck('sanphamid')
            ->toArray();


        $chuaxem = DB::table('luotxemsanpham')
            ->whereIn('sanphamid', $daxem)
            ->where('nguoidungid', '!=', $nguoidungid)
            ->groupBy('nguoidungid')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->pluck('nguoidungid');


        $dexuat = DB::table('luotxemsanpham')
            ->whereIn('nguoidungid', $chuaxem)
            ->whereNotIn('sanphamid', $daxem)
            ->groupBy('sanphamid')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->pluck('sanphamid');

        return Sanpham::whereIn('id', $dexuat)->get();
    }


    public function dexuatspmatrix($nguoidungid)
    {
        // Bước 1: Chuẩn bị dữ liệu và tạo ma trận người dùng-sản phẩm
        $ratings = DB::table('luotxemsanpham')
            ->select('nguoidungid', 'sanphamid', DB::raw('COUNT(*) as luotxem'))
            ->groupBy('nguoidungid', 'sanphamid')
            ->get();

        $users = $ratings->pluck('nguoidungid')->unique()->values()->all();
        $products = $ratings->pluck('sanphamid')->unique()->values()->all();

        $user_product_matrix = [];
        foreach ($users as $user) {
            foreach ($products as $product) {
                $user_product_matrix[$user][$product] = 0;
            }
        }

        foreach ($ratings as $rating) {
            $user_product_matrix[$rating->nguoidungid][$rating->sanphamid] = $rating->luotxem;
        }

        // Bước 2: Xuất ma trận ra file CSV
        $csvFile = storage_path('app/matrandudoan.csv');
        $fp = fopen($csvFile, 'w');
        fputcsv($fp, array_merge(['user_id'], $products));

        foreach ($user_product_matrix as $user => $products) {
            fputcsv($fp, array_merge([$user], $products));
        }
        fclose($fp);

        // Bước 3: Thực thi Python để thực hiện SVD
        $pythonPath = 'C:\\Users\\minht\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';
        $scriptPath = base_path('scripts/svd_recommendation.py');
        $csvPath = storage_path('app/matrandudoan.csv');

        $command = escapeshellcmd("$pythonPath $scriptPath $csvPath");
        $output = shell_exec($command);

        // dd($output);


        // Debug: Kiểm tra đầu ra của lệnh shell_exec
        if ($output === null) {
            throw new \Exception("Lỗi khi thực thi script Python: $command");
        }

        $predictedFile = storage_path('app/ketquadudoan.csv');

        // Bước 4: Đọc kết quả từ file CSV do Python xuất ra
        $predicted_ratings = [];
        if (file_exists($predictedFile)) {
            if (($fp = fopen($predictedFile, 'r')) !== FALSE) {
                while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                    $user = array_shift($data);
                    $predicted_ratings[$user] = array_map('floatval', $data);
                }
                fclose($fp);
            }
        } else {
            throw new \Exception("File không tồn tại: $predictedFile");
        }

        // Bước 5: Lọc sản phẩm đã xem và lấy sản phẩm đề xuất
        Log::info('Lấy ra được:', ['predicted_ratings' => $predicted_ratings]);


        $recommendations = $this->getRecommendations($nguoidungid, $predicted_ratings);
        return Sanpham::whereIn('id', $recommendations)->get();
    }

    // Hàm để lấy sản phẩm đề xuất dựa trên dự đoán từ SVD
    private function getRecommendations($userId, $predicted_ratings, $num_recommendations = 5)
    {
        // Kiểm tra nếu không có dự đoán cho người dùng
        if (!isset($predicted_ratings[$userId])) {
            return [];
        }

        arsort($predicted_ratings[$userId]);
        $recommendedProducts = array_slice(array_keys($predicted_ratings[$userId]), 0, $num_recommendations, true);
        Log::info('Đề xuất:', ['products' => $recommendedProducts]);
        return $recommendedProducts;
    }






    public function dexuatspmuachua($nguoidungid)
    {
        // Bước 1: Lấy danh sách sản phẩm đã mua bởi người dùng
        $purchased_products = DB::table('chitietdonhang')
            ->join('donhang', 'chitietdonhang.donhangid', '=', 'donhang.id')
            ->where('donhang.tinhtrang', 'like', '%Hoàn thành%')
            ->select('donhang.nguoidungid', 'chitietdonhang.sanphamid')
            ->get()
            ->groupBy('nguoidungid')
            ->map(function ($row) {
                return $row->pluck('sanphamid')->toArray();
            });

        Log::info($purchased_products);

        // Lấy danh sách tất cả người dùng và sản phẩm
        $users = array_keys($purchased_products->toArray()); // Lấy danh sách tất cả người dùng
        $allProducts = collect($purchased_products)->flatten()->unique()->values()->all(); // Lấy danh sách tất cả sản phẩm

        // Tạo ma trận người dùng - sản phẩm
        $user_product_matrix = [];
        foreach ($users as $user) {
            foreach ($allProducts as $product) {
                $user_product_matrix[$user][$product] = 0; // Khởi tạo tất cả giá trị bằng 0
            }
        }

        // Đánh dấu sản phẩm mà người dùng đã mua
        foreach ($purchased_products as $userId => $productIds) {
            foreach ($productIds as $productId) {
                $user_product_matrix[$userId][$productId] = 1; // Gán giá trị 1 cho các sản phẩm đã mua
            }
        }

        // Bước 2: Xuất ma trận ra file CSV
        $csvFile = storage_path('app/matrandonhang.csv');
        $fp = fopen($csvFile, 'w');
        fputcsv($fp, array_merge(['user_id'], $allProducts));

        foreach ($user_product_matrix as $user => $productMatrix) {
            fputcsv($fp, array_merge([$user], $productMatrix));
        }
        fclose($fp);

        // Bước 3: Thực thi Python để thực hiện SVD
        $pythonPath = 'C:\\Users\\minht\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';
        $scriptPath = base_path('scripts/svd_recommendationdonhang.py');
        $csvPath = storage_path('app/matrandonhang.csv');

        $command = escapeshellcmd("$pythonPath $scriptPath $csvPath");
        $output = shell_exec($command);

        if ($output === null) {
            throw new \Exception("Lỗi khi thực thi script Python: $command");
        }

        $predictedFile = storage_path('app/ketquadonhang.csv');

        // Bước 4: Đọc kết quả từ file CSV do Python xuất ra
        $predicted_ratings = [];
        if (file_exists($predictedFile)) {
            if (($fp = fopen($predictedFile, 'r')) !== FALSE) {
                while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                    $user = array_shift($data);
                    $predicted_ratings[$user] = array_map('floatval', $data);
                }
                fclose($fp);
            }
        } else {
            throw new \Exception("File không tồn tại: $predictedFile");
        }

        // Bước 5: Lấy sản phẩm đề xuất cho người dùng dựa trên dự đoán từ SVD
        $recommendations = $this->getRecommendationsdonhang($nguoidungid, $predicted_ratings);

        Log::info('Lấy ra được1:', ['recommendations' => $recommendations]);
        return Sanpham::whereIn('id', $recommendations)->get();
    }


    private function getRecommendationsdonhang($userId, $predicted_ratings, $num_recommendations = 5)
    {
        // Kiểm tra nếu không có dự đoán cho người dùng
        if (!isset($predicted_ratings[$userId])) {
            Log::info('Không có dữ liệu dự đoán cho người dùng:', ['user_id' => $userId]);
            // Nếu không có dự đoán, có thể gợi ý sản phẩm phổ biến hoặc mới
            return $this->getPopularOrNewProducts($num_recommendations);
        }

        // Lấy danh sách các sản phẩm mà người dùng đã mua
        $purchased_products = DB::table('chitietdonhang')
            ->join('donhang', 'chitietdonhang.donhangid', '=', 'donhang.id')
            ->where('donhang.nguoidungid', $userId)
            ->where('donhang.tinhtrang', 'like', '%Hoàn thành%')
            ->pluck('chitietdonhang.sanphamid')
            ->toArray();

        // Sắp xếp dự đoán từ cao đến thấp
        arsort($predicted_ratings[$userId]);

        // Lọc các sản phẩm đã mua và các sản phẩm không tồn tại
        $allRecommendedProducts = $predicted_ratings[$userId];
        $validRecommendedProducts = array_filter($allRecommendedProducts, function($rating, $productId) use ($purchased_products) {
            return !in_array($productId, $purchased_products) && $rating > 0;
        }, ARRAY_FILTER_USE_BOTH);

        // Lọc các sản phẩm tồn tại trong cơ sở dữ liệu
        $existingProductIds = Sanpham::pluck('id')->toArray();
        $validRecommendedProducts = array_filter($validRecommendedProducts, function($productId) use ($existingProductIds) {
            return in_array($productId, $existingProductIds);
        }, ARRAY_FILTER_USE_KEY);

        // Kiểm tra sản phẩm hợp lệ
        Log::info('Sản phẩm hợp lệ:', ['validRecommendedProducts' => $validRecommendedProducts]);

        // Lấy các sản phẩm đề xuất theo số lượng yêu cầu
        $recommendedProducts = array_slice(array_keys($validRecommendedProducts), 0, $num_recommendations);

        Log::info('Đề xuất:', ['products' => $recommendedProducts]);

        return $recommendedProducts;
    }

    private function getPopularOrNewProducts($num_recommendations)
    {
        // Ví dụ: Lấy sản phẩm phổ biến nhất
        return Sanpham::orderBy('daban', 'desc')
            ->take($num_recommendations)
            ->pluck('id')
            ->toArray();
    }
}
