<?php

namespace App\Http\Controllers;

use App\Mail\NotifyUser;
use App\Models\Chitietdonhang;
use App\Models\Danhmuc;
use App\Models\Doitra;
use App\Models\Donhang;
use App\Models\Giamgia;
use App\Models\Giamgiahangloat;
use App\Models\Nguoidung;
use App\Models\Nhacungcap;
use App\Models\Nhasanxuat;
use App\Models\Phuongthucthanhtoan;
use Illuminate\Http\Request;
use App\Models\Sanpham;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    public function index()
    {
        $u = Nguoidung::all();
        $dh = Donhang::all();
        $dhht = Donhang::where('tinhtrang', 'like', '%Hoàn thành%')->get();
        $dhhuy = Donhang::where('tinhtrang', 'like', 'Đã hủy%')->get();
        $doanhthu = Donhang::where('tinhtrang', 'like', '%Hoàn thành%')->sum('tongtien');

        $dhkhac = Donhang::where('tinhtrang', 'not like', '%Hoàn thành%')->where('tinhtrang', 'not like', 'Đã hủy%')->get();


        $demdhhuy = count($dhhuy);
        $demdh = count($dh);
        $demdhht = count($dhht);
        $demnd = count($u);
        $demdhkhac = count($dhkhac);

        // Khởi tạo mảng để lưu doanh thu của 12 tháng
        $monthlySales = array_fill(1, 12, 0); // Khởi tạo tất cả các tháng với giá trị 0
        // Lấy doanh thu theo từng tháng
        $doanhthuthang = Donhang::select(
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('SUM(tongtien) as total')
        )
            ->where('tinhtrang', 'like', '%Hoàn thành%')
            ->whereYear('updated_at', Carbon::now()->year)
            ->groupBy('year', 'month')
            ->get();


        // Điền dữ liệu doanh thu vào mảng monthlySales
        foreach ($doanhthuthang as $dt) {
            $monthlySales[$dt->month] = $dt->total;
        }
        // Doanh thu của tháng hiện tại
        $currentMonth = Carbon::now()->month;
        $doanhthuthangnay = $monthlySales[$currentMonth];

        $sp = Sanpham::all();

        return view("admin.home", compact('demnd', 'demdhht', 'demdh', 'doanhthu', 'demdhhuy', 'doanhthuthangnay', 'demdhkhac', 'sp'));
    }


    public function getYearlySales(Request $request)
    {
        $year = $request->year;

        // Khởi tạo mảng để lưu doanh thu của 12 tháng cho năm hiện tại
        $monthlySales = array_fill(1, 12, 0);

        // Lấy doanh thu của năm hiện tại
        $doanhthuthang = Donhang::select(
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('SUM(tongtien) as total')
        )
            ->where('tinhtrang', 'like', '%Hoàn thành%')
            ->whereYear('updated_at', $year)
            ->groupBy('year', 'month')
            ->get();

        // Điền dữ liệu doanh thu vào mảng monthlySales cho năm hiện tại
        foreach ($doanhthuthang as $dt) {
            $monthlySales[$dt->month] = $dt->total;
        }

        // Khởi tạo mảng để lưu tổng doanh thu theo từng tháng của các năm trước
        $totalSalesPreviousYears = array_fill(1, 12, 0);

        // Lấy doanh thu của các năm trước
        $doanhthucacnamtruoc = Donhang::select(
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('SUM(tongtien) as total')
        )
            ->where('tinhtrang', 'like', '%Hoàn thành%')
            ->whereYear('updated_at', '<', $year)
            ->groupBy('month')
            ->get();

        // Điền dữ liệu doanh thu vào mảng totalSalesPreviousYears
        foreach ($doanhthucacnamtruoc as $dt) {
            $totalSalesPreviousYears[$dt->month] = $dt->total;
        }

        return response()->json([
            'monthlySales' => $monthlySales,
            'trendlineData' => $totalSalesPreviousYears
        ]);
    }



    public function getSanPhamDaBan1(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        // Lấy tất cả chi tiết đơn hàng trong tháng và năm được chỉ định
        $chitietdonhangs = Chitietdonhang::whereHas('donhang', function ($query) use ($year, $month) {
            $query->whereYear('updated_at', $year)
                ->whereMonth('updated_at', $month)
                ->where('tinhtrang', 'like', '%Hoàn thành%');
        })->with('sanpham')->get();

        // Nhóm các chi tiết đơn hàng theo sản phẩm ID và tính tổng số lượng và giá
        $sanphams = $chitietdonhangs->groupBy('sanphamid')->map(function ($group) {
            $total_quantity = $group->sum('soluong');
            $total_price = $group->sum(function ($item) {
                return $item->soluong * $item->gia;
            });
            $sanpham = $group->first()->sanpham; // Lấy thông tin sản phẩm

            return [
                'sanpham_id' => $sanpham->id,
                'ten_sanpham' => $sanpham->ten,
                'total_quantity' => $total_quantity,
                'total_price' => $total_price,
            ];
        });

        return response()->json($sanphams->values());
    }


    public function getSanPhamDaBan(Request $request)
    {
        $year = $request->year;
        $sanphamId = $request->sanphamId;

        $monthlySales = array_fill(1, 12, 0);
        $trendlineData = array_fill(1, 12, 0);

        // Lấy số lượng sản phẩm bán được theo đơn hàng trong năm hiện tại
        $monthlySalesQuery = Donhang::join('chitietdonhang', 'donhang.id', '=', 'chitietdonhang.donhangid')
            ->where('chitietdonhang.sanphamid', $sanphamId)
            ->whereYear('donhang.updated_at', $year)
            ->where('donhang.tinhtrang', 'like', '%Hoàn thành%')
            ->select(
                DB::raw('MONTH(donhang.updated_at) as month'),
                DB::raw('SUM(chitietdonhang.soluong) as total_quantity')
            )
            ->groupBy('month')
            ->get();

        // Điền dữ liệu số lượng sản phẩm vào mảng monthlySales
        foreach ($monthlySalesQuery as $sale) {
            $monthlySales[$sale->month] = $sale->total_quantity;
        }

        // Lấy dữ liệu đường xu hướng từ các năm trước
        $pastSalesQuery = Donhang::join('chitietdonhang', 'donhang.id', '=', 'chitietdonhang.donhangid')
            ->where('chitietdonhang.sanphamid', $sanphamId)
            ->whereYear('donhang.updated_at', '<', $year)
            ->where('donhang.tinhtrang', 'like', '%Hoàn thành%')
            ->select(
                DB::raw('MONTH(donhang.updated_at) as month'),
                DB::raw('SUM(chitietdonhang.soluong) as total_quantity')
            )
            ->groupBy('month')
            ->get();

        // Điền dữ liệu đường xu hướng vào mảng trendlineData
        foreach ($pastSalesQuery as $sale) {
            $trendlineData[$sale->month] = $sale->total_quantity;
        }

        $response = ['monthlySales' => $monthlySales, 'trendlineData' => $trendlineData];

        return response()->json($response);
    }




    public function getDonhang(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $donhangs = Donhang::whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->where('tinhtrang', 'like', '%Hoàn thành%')
            ->with('nguoidung')
            ->get();

        return response()->json($donhangs);
    }



    public function donhang()
    {
        $excludedStatuses = ['Đang xử lý', 'Đã thanh toán', 'Đã xác nhận', 'Hoàn thành', 'Đã hủy'];
        $nguoidungs = Nguoidung::all();
        $danhmucs = Danhmuc::all();
        $pttt = Phuongthucthanhtoan::all();
        $sp = Sanpham::all();
        $dm = Danhmuc::all();
        $donhangdxl = Donhang::where('tinhtrang', 'Đang xử lý')->orWhere('tinhtrang', 'Đã thanh toán')->with(['nguoidung', 'phuongthucthanhtoan', 'chitietdonhangs.sanpham'])->orderByDesc('updated_at')->get();
        $donhangdxn = Donhang::where('tinhtrang', 'Đã xác nhận')->with(['nguoidung', 'phuongthucthanhtoan', 'chitietdonhangs.sanpham'])->orderByDesc('updated_at')->get();
        // $donhangdg = Donhang::whereNotIn('tinhtrang', $excludedStatuses)->with(['nguoidung', 'phuongthucthanhtoan', 'chitietdonhangs.sanpham'])->orderByDesc('updated_at')->get();

        $donhangdg = Donhang::where('tinhtrang', 'Đang giao')->with(['nguoidung', 'phuongthucthanhtoan', 'chitietdonhangs.sanpham'])->orderByDesc('updated_at')->get();


        $donhanght = Donhang::where('tinhtrang', 'Hoàn thành')->with(['nguoidung', 'phuongthucthanhtoan', 'chitietdonhangs.sanpham'])->orderByDesc('updated_at')->get();
        $donhanghuy = Donhang::where('tinhtrang', 'like', 'Đã hủy%')->with(['nguoidung', 'phuongthucthanhtoan', 'chitietdonhangs.sanpham'])->orderByDesc('updated_at')->get();
        $donhangdoitra = Doitra::with(['donhang.nguoidung', 'donhang.phuongthucthanhtoan'])
            ->orderByDesc('updated_at')
            ->where('tinhtrang', 'Yêu cầu đổi trả')->orwhere('tinhtrang', 'like', 'Đã lên đơn mới%')
            ->get();




        return view('admin.pages.donhang', compact('donhangdxl', 'donhangdxn', 'donhangdg', 'donhanght', 'donhanghuy', 'donhangdoitra', 'nguoidungs', 'danhmucs', 'pttt', 'sp', 'dm'));
    }


    public function getOrderDetails($id)
    {
        $orderDetails = Chitietdonhang::with('sanpham')->where('donhangid', $id)->get();
        return response()->json(['details' => $orderDetails]);
    }

    public function capnhattinhtrangdaxacnhan(string $id)
    {
        try {
            $order = Donhang::findOrFail($id);
            $order->tinhtrang = 'Đã xác nhận';
            $order->save();
            return redirect()->back()->with('suc', 'Thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Thất bại' . $e->getMessage());
        }
    }
    public function capnhattinhtrangdanggiao(string $id)
    {
        try {
            $order = Donhang::findOrFail($id);
            $order->tinhtrang = 'Đang giao';
            $order->save();
            return redirect()->back()->with('suc', 'Thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Thất bại' . $e->getMessage());
        }
    }
    public function capnhattinhtranghoanthanh(string $id)
    {
        try {
            $order = Donhang::findOrFail($id);
            $order->tinhtrang = 'Hoàn Thành';
            $order->save();
            return redirect()->back()->with('suc', 'Thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Thất bại' . $e->getMessage());
        }
    }
    public function huydon(Request $request, string $id)
    {
        $lido = $request->lido;
        try {
            $order = Donhang::findOrFail($id);
            $order->tinhtrang = 'Đã hủy với lí do: ' . $lido;
            $order->save();
            return redirect()->back()->with('suc', 'Thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Thất bại' . $e->getMessage());
        }
    }

    public function sendEmail()
    {
        $mail = 'thuantestgame304@gmail.com';
        $details = [
            'message' => 'Đây là thông báo có đơn hàng mới'
        ];
        try {
            Mail::to($mail)->send(new NotifyUser($details));
            return redirect()->back()->with('suc', 'Thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Thất bại: ' . $e->getMessage());
        }
    }

    public function getUserDetails($userId)
    {
        $u = Nguoidung::find($userId);
        if ($u) {
            return response()->json([
                'ten' => $u->ten,
                'sdt' => $u->sodienthoai,
                'diachigiaohang' => $u->diachi . ', ' . $u->xaphuong->name . ', ' . $u->quanhuyen->name . ', ' . $u->thanhpho->name,
            ]);
        } else {
            return response()->json([
                'error' => 'Người dùng không tồn tại'
            ], 404);
        }
    }

    public function getProductPrice($productId)
    {
        // Find the product by its ID
        $product = Sanpham::find($productId);

        // Check if the product exists
        if ($product) {
            return response()->json(['price' => $product->gia], 200);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
    public function admintaodon(Request $request)
    {


        $dc = $request->giaohang == 'cuahang' ? 'Lấy tại cửa hàng' : $request->input('diachigiaohang-hidden');
        try {
            $donhang = Donhang::create([
                'nguoidungid' => $request->nguoidungid,
                'phuongthucthanhtoanid' => $request->thanhtoan,
                'tinhtrang' => 'Đang xử lý',
                'ngaydat' => now(),
                'diachigiaohang' => $dc,
                'tongtien' => $request->tongtien,
            ]);

            $sanphams = $request->sanphamid;
            $soluongs = $request->soluong;




            foreach ($sanphams as $index => $sanphamid) {
                $soluong = $soluongs[$index];
                $sanpham = Sanpham::find($sanphamid);

                if ($sanpham) {
                    Chitietdonhang::create([
                        'donhangid' => $donhang->id,
                        'sanphamid' => $sanphamid,
                        'soluong' => $soluong,
                        'gia' => $sanpham->gia,
                    ]);

                    $sanpham->increment('daban', $soluong);
                    $sanpham->decrement('soluong', $soluong);


                    $currentDate = Carbon::today();

                    foreach ($sanpham->quatangs as $quatang) {
                        if ($quatang->soluong > 0 && Carbon::parse($quatang->ngayketthuc)->gte($currentDate)) {
                            if (Carbon::parse($quatang->ngayketthuc)->gte(Carbon::today())  && $quatang->soluong > 0) {
                                Chitietdonhang::create([
                                    'donhangid' => $donhang->id,
                                    'sanphamid' => $quatang->sanphamidquatang,
                                    'soluong' => 1 * $soluong,
                                    'gia' => 0,
                                ]);
                                $sanphamQuatang = Sanpham::find($quatang->sanphamidquatang);
                                if ($sanphamQuatang) {
                                    $sanphamQuatang->increment('daban', 1 * $soluong);
                                    $sanphamQuatang->decrement('soluong', 1 * $soluong);
                                }
                            }
                        }
                    }
                }
            }

            return redirect()->back()->with('suc', 'Tạo đơn hàng thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    public function spdanggiam()
    {

        $gg = Giamgia::all();
        $gghl = Giamgiahangloat::all();
        return view('admin.pages.spdanggiam', compact('gg', 'gghl'));
    }


    public function deletespdanggiam($id)
    {
        $gg = Giamgia::find($id);
        if ($gg) {
            $gg->delete();
        }
        return redirect()->back()->with('suc', 'Xóa thành công');
    }



    public function updatespdanggiam(Request $request, $id)
    {
        // dd($request->all());

        $gg = Giamgia::find($id);
        if ($gg) {
            try {

                $gg->giagiam = $request->giagiam;
                $gg->ngaybatdau = $request->ngaybatdau;
                $gg->ngayketthuc = $request->ngayketthuc;
                $gg->soluongsanpham = $request->soluongsanpham;

                $gg->save();
                return redirect()->back()->with('suc', 'thành công!');
            } catch (Exception $e) {
                return redirect()->back()->with('err', 'Lỗi' . $e->getMessage());
            }
        }
    }


    public function deletespdanggiamhl($id)
    {
        $gg = Giamgiahangloat::find($id);
        if ($gg) {
            $gg->delete();
        }
        return redirect()->back()->with('suc', 'Xóa thành công');
    }



    public function updatespdanggiamhl(Request $request, $id)
    {
        // dd($request->all());

        $gg = Giamgiahangloat::find($id);
        if ($gg) {
            try {
                $gg->phantramgiamgia = $request->phantramgiamgia;
                $gg->giamtoida = $request->giamtoida;
                $gg->ngaybatdau = $request->ngaybatdau;
                $gg->ngayketthuc = $request->ngayketthuc;
                $gg->soluongsanpham = $request->soluongsanpham;
                $gg->save();
                return redirect()->back()->with('suc', 'thành công!');
            } catch (Exception $e) {
                return redirect()->back()->with('err', 'Lỗi' . $e->getMessage());
            }
        }
    }


    public function taikhoantrongweb()
    {

        $tk = Nguoidung::all();
        return view('admin.pages.taikhoantrongweb', compact('tk'));
    }


    public function updateDonhang(Request $request, $id)
    {
        // Tìm đơn hàng theo ID
        $data = $request->all();
        dd($data); // Để xem toàn bộ dữ liệu gửi lên
        $donhang = Donhang::findOrFail($id);

        // Cập nhật thông tin cơ bản của đơn hàng
        $donhang->nguoidung->email = $request->input('email');
        $donhang->phuongthucthanhtoanid = $request->input('phuongthucthanhtoan');
        $donhang->ngaydat = $request->input('ngaydat');
        $donhang->diachigiaohang = $request->input('giaohang') === 'cuahang' ? 'Lấy tại cửa hàng' : 'Giao hàng';
        $donhang->phiship = $request->input('phiship');
        $donhang->magiamgia = $request->input('magiamgia');
        $donhang->tinhtrang = $request->input('tinhtrang');

        // Cập nhật chi tiết sản phẩm trong đơn hàng
        $donhang->chitietdonhangs()->delete(); // Xóa các chi tiết cũ

        foreach ($request->input('products', []) as $product) {
            $donhang->chitietdonhang()->create([
                'sanpham_id' => $product['sanpham_id'],
                'soluong' => $product['soluong'],
                'gia' => $product['gia'],
            ]);
        }

        // Cập nhật tổng tiền
        $donhang->tongtien = $donhang->chitietdonhang->sum(function ($chitiet) {
            return $chitiet->soluong * $chitiet->gia;
        });

        $donhang->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }
}
