<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Carbon\Carbon;
use App\Models\Donhang;
use App\Models\Chitietdonhang;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportController extends Controller
{
    public function exportReport(Request $request)
    {
        $startDate = Carbon::parse($request->input('startDate'));
        $endDate = Carbon::parse($request->input('endDate'));

        // Lấy dữ liệu đơn hàng và chi tiết đơn hàng trong khoảng thời gian đã chọn
        $donhangs = Donhang::whereBetween('updated_at', [$startDate, $endDate])
            ->where('tinhtrang', 'like', '%Hoàn thành%')
            ->get();

        $chitietdonhangs = Chitietdonhang::whereHas('donhang', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('updated_at', [$startDate, $endDate])
                ->where('tinhtrang', 'like', '%Hoàn thành%');
        })->with('sanpham')->get();

        // Tổng hợp dữ liệu
        $totalRevenue = $donhangs->sum('tongtien');
        $products = $chitietdonhangs->groupBy('sanphamid')->map(function ($group) {
            $total_quantity = $group->sum('soluong');
            $total_price = $group->sum(function ($item) {
                return $item->soluong * $item->gia;
            });
            $sanpham = $group->first()->sanpham;

            return [
                'sanpham_id' => $sanpham->id,
                'ten_sanpham' => $sanpham->ten,
                'total_quantity' => $total_quantity,
                'total_price' => $total_price,
            ];
        });

        // Tạo file Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addTitle('Báo Cáo Doanh Thu', 1);
        $section->addText("Từ ngày: {$startDate->toDateString()} Đến ngày: {$endDate->toDateString()}");
        $section->addText("Tổng doanh thu: " . number_format($totalRevenue) . " VND");

        // Thêm bảng sản phẩm đã bán
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000)->addText('Tên Sản Phẩm');
        $table->addCell(2000)->addText('Số Lượng');
        $table->addCell(2000)->addText('Tổng Tiền');
        foreach ($products as $product) {
            $table->addRow();
            $table->addCell(2000)->addText($product['ten_sanpham']);
            $table->addCell(2000)->addText($product['total_quantity']);
            $table->addCell(2000)->addText(number_format($product['total_price']) . " VND");
        }

        // Lưu file Word
        $fileName = 'baocao_' . Carbon::now()->timestamp . '.docx';
        $filePath = storage_path('app/public/' . $fileName);
        $phpWord->save($filePath, 'Word2007');

        // Tạo biểu đồ doanh thu
        $chartData = $this->getChartData($startDate, $endDate);

        // Sử dụng Dompdf để tạo file PDF từ HTML
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Cho phép load các file từ URL bên ngoài
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($chartData);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pdfOutput = $dompdf->output();
        $pdfFilePath = storage_path('app/public/chart.pdf');
        file_put_contents($pdfFilePath, $pdfOutput);

        return response()->download($filePath);
    }

    private function getChartData($startDate, $endDate)
    {
        $doanhthuthang = Donhang::select(
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('SUM(tongtien) as total')
        )
            ->where('tinhtrang', 'like', '%Hoàn thành%')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->get();

        $monthlySales = [];
        foreach ($doanhthuthang as $dt) {
            $monthlySales[$dt->month] = $dt->total;
        }

        $labels = array_map(function ($month) {
            return 'Tháng ' . $month;
        }, array_keys($monthlySales));
        $data = array_values($monthlySales);

        // Tạo biểu đồ HTML
        $chartHtml = view('admin.chart', compact('labels', 'data'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($chartHtml);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents(storage_path('app/public/chart.pdf'), $output);
    }
}
