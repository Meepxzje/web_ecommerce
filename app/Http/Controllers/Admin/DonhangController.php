<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Chitietdonhang;
use App\Models\Chitietmagiamgia;
use App\Models\Danhmuc;
use App\Models\Doitra;
use App\Models\Donhang;
use App\Models\Giamgia;
use App\Models\Giamgiahangloat;
use App\Models\Giohang;
use App\Models\Magiamgia;
use App\Models\Nguoidung;
use App\Models\Phivanchuyen;
use App\Models\Phuongthucthanhtoan;
use App\Models\Quatang;
use App\Models\Sanpham;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class DonhangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dms = Danhmuc::all();
        $pttt = Phuongthucthanhtoan::all();
        $giohang = Giohang::where('nguoidungid', Auth::id())->with('chitietgiohangs.sanpham')->first();
        $pvc = Phivanchuyen::where('matp', Auth::user()->matp)->get();
        return view('fe.pages.thanhtoan', compact('giohang', 'dms', 'pttt', 'pvc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        if ($result === false) {
            $error = curl_error($ch);
            dd('cURL Error: ' . $error);
        }
        curl_close($ch);
        return $result;
    }


    public function store(Request $request)
    {

        $tong = $request->tongall;
        $giaohang = $request->input('shipping_method');
        $pttt = $request->input('payment_method');
        $dc = $request->diachi;
        $diachi = $giaohang == 'cuahang' ? "Lấy tại cửa hàng" : $dc;
        $phiship = $diachi == 'Lấy tại cửa hàng' ? 0 : $request->phiship;
        $voucher = $request->session()->has('discount_id') ? session('discount_id') : null;




        if ($pttt == 1) {
            try {
                $donhang = Donhang::create([
                    'nguoidungid' => Auth::user()->id,
                    'phuongthucthanhtoanid' => $pttt,
                    'tinhtrang' => 'Đang xử lý',
                    'ngaydat' => now(),
                    'diachigiaohang' => $diachi,
                    'phiship' => $phiship,
                    'magiamgia' => $voucher,
                    'tongtien' => $request->tongall,
                ]);
                $giohang = Giohang::where('nguoidungid', Auth::id())->with('chitietgiohangs.sanpham')->first();
                foreach ($giohang->chitietgiohangs as $chitiet) {
                    $sanpham = $chitiet->sanpham;
                    $soluong = $chitiet->soluong;
                    $gia_goc = $sanpham->gia;
                    $giamgia = $sanpham->giamgia &&  $sanpham->giamgia->danggiam == 1 && $sanpham->giamgia->soluongsanpham > 0 ? $sanpham->giamgia->giagiam : 0;
                    $phantram_giamgiahangloat = $sanpham->giamgiahangloat ? ($sanpham->giamgiahangloat->phantramgiamgia * $gia_goc / 100) : 0;
                    $giamgiahangloat = $sanpham->giamgiahangloat  && $sanpham->giamgiahangloat->tinhtrang == 1 && $sanpham->giamgiahangloat->soluongsanpham > 0 ? ($phantram_giamgiahangloat > $sanpham->giamgiahangloat->giamtoida ? $sanpham->giamgiahangloat->giamtoida : $phantram_giamgiahangloat) : 0;
                    $soluong_giamgia = $sanpham->giamgia &&  $sanpham->giamgia->danggiam == 1 && $sanpham->giamgia->soluongsanpham > 0 ? ($sanpham->giamgia->soluongsanpham ?? 0) : 0;
                    $soluong_giamgiahangloat = $sanpham->giamgiahangloat && $sanpham->giamgiahangloat->tinhtrang == 1 && $sanpham->giamgiahangloat->soluongsanpham > 0 ? ($sanpham->giamgiahangloat->soluongsanpham ?? 0) : 0;
                    $soluong_cahai = min($soluong, min($soluong_giamgia, $soluong_giamgiahangloat));
                    $soluong_giamgia = max(0, min($soluong - $soluong_cahai, $soluong_giamgia - $soluong_cahai));
                    $soluong_giamgiahangloat = max(0, min($soluong - $soluong_cahai - $soluong_giamgia, $soluong_giamgiahangloat - $soluong_cahai));
                    $soluong_khonggiamgia = $soluong - $soluong_cahai - $soluong_giamgia - $soluong_giamgiahangloat;

                    if ($soluong_cahai > 0) {
                        Chitietdonhang::create([
                            'donhangid' => $donhang->id,
                            'sanphamid' => $chitiet->sanphamid,
                            'soluong' => $soluong_cahai,
                            'gia' => $gia_goc - $giamgia - $giamgiahangloat,
                        ]);
                    }

                    if ($soluong_giamgia > 0) {
                        Chitietdonhang::create([
                            'donhangid' => $donhang->id,
                            'sanphamid' => $chitiet->sanphamid,
                            'soluong' => $soluong_giamgia,
                            'gia' => $gia_goc - $giamgia,
                        ]);
                    }

                    if ($soluong_giamgiahangloat > 0) {
                        Chitietdonhang::create([
                            'donhangid' => $donhang->id,
                            'sanphamid' => $chitiet->sanphamid,
                            'soluong' => $soluong_giamgiahangloat,
                            'gia' => $gia_goc - $giamgiahangloat,
                        ]);
                    }

                    if ($soluong_khonggiamgia > 0) {
                        Chitietdonhang::create([
                            'donhangid' => $donhang->id,
                            'sanphamid' => $chitiet->sanphamid,
                            'soluong' => $soluong_khonggiamgia,
                            'gia' => $gia_goc,
                        ]);
                    }

                    $sanpham = Sanpham::find($chitiet->sanphamid);
                    if ($sanpham) {
                        $sanpham->increment('daban', $chitiet->soluong);
                        $sanpham->decrement('soluong', $chitiet->soluong);
                    }

                    $sanphamgiamgia = Giamgia::where('sanphamid', $chitiet->sanphamid)->first();
                    if ($sanphamgiamgia != null && $sanphamgiamgia->soluongsanpham > 0) {
                        $sanphamgiamgia->soluongsanpham -= ($soluong_cahai + $soluong_giamgia);
                        $sanphamgiamgia->save();
                    }

                    $sanphamgiamgiahl = Giamgiahangloat::where('sanphamid', $chitiet->sanphamid)->first();
                    if ($sanphamgiamgiahl != null && $sanphamgiamgiahl->soluongsanpham > 0) {
                        $sanphamgiamgiahl->soluongsanpham -= ($soluong_cahai + $soluong_giamgiahangloat);
                        $sanphamgiamgiahl->save();
                    }

                    if (count($chitiet->sanpham->quatangs) > 0) {
                        foreach ($chitiet->sanpham->quatangs as $quatang) {
                            if (Carbon::parse($quatang->ngayketthuc)->gte(Carbon::today())  && $quatang->soluong > 0) {
                                $soLuongQuaTang = 1 * $chitiet->soluong;
                                $soluong = $quatang->soluong > $soLuongQuaTang ? $soLuongQuaTang : $quatang->soluong;
                                Chitietdonhang::create([
                                    'donhangid' => $donhang->id,
                                    'sanphamid' => $quatang->sanphamidquatang,
                                    'soluong' => $soluong,
                                    'gia' => 0,
                                ]);

                                $sanphamQuatang = Sanpham::find($quatang->sanphamidquatang);
                                if ($sanphamQuatang) {
                                    $sanphamQuatang->increment('daban', $soLuongQuaTang);
                                    $sanphamQuatang->decrement('soluong', $soLuongQuaTang);
                                }
                                $soluongquatang = Quatang::where('sanphamid', $quatang->sanphamid)->get();
                                if ($soluongquatang) {
                                    foreach ($soluongquatang as $i) {
                                        $i->decrement('soluong', $soLuongQuaTang);
                                    }
                                }
                            }
                        }
                    }
                }
                if ($request->session()->has('discount_id')) {
                    $magg = Chitietmagiamgia::find(session('discount_id'));
                    if ($magg) {
                        $magg->dasudung = 1;
                        $magg->save();
                    }
                    $request->session()->forget('discount_id');
                }
                $giohang->chitietgiohangs()->delete();
                $response = app()->call('App\Http\Controllers\AdminController@sendEmail');
                return redirect()->route('taikhoan')->with('suc', 'Tạo đơn hàng thành công');
            } catch (\Exception $e) {
                return redirect()->route('giohang')->with('err', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $e->getMessage());
            }
        }
        if ($pttt == 2) {

            session([
                'phiship' => $phiship,
                'magiamgia' => $voucher
            ]);
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $tong;
            $orderId = time() . "";
            $redirectUrl = route('momo.return');
            $ipnUrl = route('momo.ipn');
            $extraData = "";
            $requestId = time() . "";

            $requestType = "payWithATM";
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );

            $jsonData = json_encode($data);
            if (json_last_error() !== JSON_ERROR_NONE) {
                dd('JSON Encode Error: ' . json_last_error_msg());
            }
            $result = $this->execPostRequest($endpoint, $jsonData);
            $jsonResult = json_decode($result, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                dd('JSON Decode Error: ' . json_last_error_msg());
            }
            return redirect()->away($jsonResult['payUrl']);
        }
        if ($pttt = 3) {

            session([
                'phiship' => $phiship,
                'magiamgia' => $voucher
            ]);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('vnpay.return');
            $vnp_TmnCode = "HTXUZJID";
            $vnp_HashSecret = "B11YRGSFSPZ78EOFL7J2A9X0UGLS3205";

            $vnp_TxnRef = rand(00, 99999);
            $vnp_OrderInfo = 'Noi dung thanh toan';
            $vnp_OrderType = 'Thanh toán qua VNPay';
            $vnp_Amount = $tong * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = '';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            if (isset($request->redirect)) {
                return redirect($vnp_Url);
            }
            Log::info('VNPay URL created', ['url' => $vnp_Url]);
            return redirect()->away($vnp_Url);
        }
    }


    //     public function xacnhandoitra($id)
    //     {
    //         try {
    //             $doitras = Doitra::where('donhangid', $id)->with('chitietdoitras.sanpham')->get();
    //             dd($doitras);
    //             if ($doitras->isNotEmpty()) {
    //                 $tongtien = 0;
    //                 $donhang = Donhang::create([
    //                     'nguoidungid' => $doitras->first()->nguoidungid,
    //                     'phuongthucthanhtoanid' => $doitras->first()->donhang->phuongthucthanhtoanid,
    //                     'tinhtrang' => 'Đang xử lý',
    //                     'ngaydat' => now(),
    //                     'diachigiaohang' => $doitras->first()->donhang->diachigiaohang,
    //                     'tongtien' => $tongtien,
    //                     'mavandon' => null
    //                 ]);

    //                 foreach ($doitras as $doitra) {
    //                     $chitietdonhang = Chitietdonhang::create([
    //                         'donhangid' => $donhang->id,
    //                         'sanphamid' => $doitra->sanphamid,
    //                         'soluong' => $doitra->soluong,
    //                         'gia' => $doitra->sanpham->gia,
    //                     ]);

    //                     $sp = Sanpham::find($doitra->sanphamid);
    //                     if ($sp) {
    //                         $sp->increment('daban', $chitietdonhang->soluong);
    //                         $sp->decrement('soluong', $chitietdonhang->soluong);
    //                     }

    //                     $doitra->tinhtrang = 'Đã lên đơn mới với mã: ' . $donhang->id;
    //                     $doitra->save();
    //                 }
    //                 return redirect()->back()->with('suc', 'Đã lên đơn mới');
    //             }
    //         } catch (\Exception $e) {
    //             return redirect()->back()->with('err', 'Lỗi: ' . $e->getMessage());
    //         }
    //     }
    public function xacnhandoitra($id)
    {
        try {
            $doitras = Doitra::where('donhangid', $id)->with('chitietdoitras.sanpham')->get();
            if ($doitras->isNotEmpty()) {
                $tongtien = 0;
                $donhang = Donhang::create([
                    'nguoidungid' => $doitras->first()->nguoidungid,
                    'phuongthucthanhtoanid' => $doitras->first()->donhang->phuongthucthanhtoanid,
                    'tinhtrang' => 'Đang xử lý',
                    'ngaydat' => now(),
                    'diachigiaohang' => $doitras->first()->donhang->diachigiaohang,
                    'tongtien' => $tongtien,
                    'mavandon' => null
                ]);
                foreach ($doitras as $doitra) {
                    foreach ($doitra->chitietdoitras as $detail) {
                        $chitietdonhang = Chitietdonhang::create([
                            'donhangid' => $donhang->id,
                            'sanphamid' => $detail->sanphamid,
                            'soluong' => $detail->soluong,
                            'gia' => $detail->sanpham->gia,
                        ]);
                        $sp = Sanpham::find($detail->sanphamid);
                        if ($sp) {
                            $sp->increment('daban', $chitietdonhang->soluong);
                            $sp->decrement('soluong', $chitietdonhang->soluong);
                        }
                    }

                    $doitra->tinhtrang = 'Đã lên đơn mới với mã: ' . $donhang->id;
                    $doitra->save();
                }
                return redirect()->back()->with('suc', 'Đã lên đơn mới');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Lỗi: ' . $e->getMessage());
        }
    }
}
