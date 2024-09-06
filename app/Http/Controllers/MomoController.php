<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Donhang;
use App\Models\Giohang;
use App\Models\Chitietdonhang;
use App\Models\Chitietmagiamgia;
use App\Models\Giamgia;
use App\Models\Giamgiahangloat;
use App\Models\Magiamgia;
use App\Models\Quatang;
use App\Models\Sanpham;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class MomoController extends Controller
{
    public function ipnHandler(Request $request)
    {
        Log::info('MoMo IPN Received: ', $request->all());
        $data = $request->all();
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $data['amount'] . "&extraData=" . $data['extraData'] . "&message=" . $data['message'] . "&orderId=" . $data['orderId'] . "&orderInfo=" . $data['orderInfo'] . "&orderType=" . $data['orderType'] . "&partnerCode=" . $data['partnerCode'] . "&payType=" . $data['payType'] . "&requestId=" . $data['requestId'] . "&responseTime=" . $data['responseTime'] . "&resultCode=" . $data['resultCode'] . "&transId=" . $data['transId'];
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($signature == $data['signature']) {
            if ($data['resultCode'] == 0) {
                $orderId = $data['orderId'];
                $order = Donhang::where('id', $orderId)->first();
                if ($order) {
                    $order->tinhtrang = 'Đã xác nhận';
                    $order->save();
                }
                return response()->json(['message' => 'IPN received and processed'], 200);
            } else {
                return response()->json(['message' => 'Payment failed'], 400);
            }
        } else {
            return response()->json(['message' => 'Invalid signature'], 400);
        }
    }

    public function returnHandler(Request $request)
    {
        $data = $request->all();
        if ($data['resultCode'] == 0) {
            $data = $request->all();
            if ($data['resultCode'] == 0) {
                try {
                    $donhang = Donhang::create([
                        'nguoidungid' => Auth::user()->id,
                        'phuongthucthanhtoanid' => 2,
                        'tinhtrang' => 'Đã thanh toán',
                        'ngaydat' => now(),
                        'diachigiaohang' => Auth::user()->diachi . ', ' . Auth::user()->xaphuong->name . ', ' . Auth::user()->quanhuyen->name . ', ' . Auth::user()->thanhpho->name,
                        'phiship' => session('phiship'),
                        'magiamgia' => session('magiamgia'),
                        'tongtien' => $data['amount'],
                    ]);


                    $request->session()->forget('phiship');
                    $request->session()->forget('magiamgia');

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
                                $soLuongQuaTang = 1 * $chitiet->soluong;
                                $soluong = $quatang->soluong > $soLuongQuaTang ? $soLuongQuaTang : $quatang->soluong;
                                if (Carbon::parse($quatang->ngayketthuc)->gte(Carbon::today())  && $quatang->soluong > 0) {
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
            } else {
                return redirect()->route('taikhoan')->with('err', 'Thanh toán thất bại');
            }
        }
    }
}
