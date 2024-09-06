<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Giohang;
use App\Models\Chitietgiohang;
use App\Models\Chitietmagiamgia;
use App\Models\Danhmuc;
use App\Models\Magiamgia;
use App\Models\Quatang;
use App\Models\Sanpham;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class GiohangController extends Controller
{
    public function index()
    {
        session()->forget('discount_amount');
        $dms = Danhmuc::all();
        $quatangs = Quatang::all();
        $quatangTrongGioHang = '';
        if (Auth::check()) {
            $giohang = Giohang::where('nguoidungid', Auth::id())->with('chitietgiohangs.sanpham')->first();
            $mgg = Chitietmagiamgia::where('nguoidungid', Auth::id())->orderBy('id', 'asc')->get();
        } else {
            $giohang = session()->get('giohang', []);
            $mgg = '';
        }
        return view('fe.pages.giohang', compact('giohang', 'dms', 'mgg'));
    }

    public function addToCart(Request $request)
    {
        $sanphamid = $request->input('sanphamid');
        $soluong = $request->input('soluong', 1);
        $gia = $request->input('gia');

        $sp = Sanpham::find($sanphamid);
        if($sp->soluong <=0)
        {
            return redirect()->back()->with('err', 'Hết hàng');
        }
        if (Auth::check()) {
            $giohang = Giohang::firstOrCreate(['nguoidungid' => Auth::id()]);

            $chitiet = Chitietgiohang::updateOrCreate(
                ['giohangid' => $giohang->id, 'sanphamid' => $sanphamid],
                ['soluong' => DB::raw("soluong + $soluong")]
            );
            return redirect()->back()->with('suc', 'Sản phẩm đã được thêm vào giỏ hàng');
        } else {
            $giohang = session()->get('giohang', []);
            if (isset($giohang[$sanphamid])) {
                $giohang[$sanphamid]['soluong'] += $soluong;
            } else {
                $giohang[$sanphamid] = [
                    'soluong' => $soluong,
                    'gia' => $gia
                ];
            }
            session()->put('giohang', $giohang);

            return redirect()->back()->with('suc', 'Sản phẩm đã được thêm vào giỏ hàng tạm');
        }
    }

    public function addToCartSP(Request $request)
    {
        $sanphamid = $request->input('sanphamid');
        $soluong = $request->input('soluong');
        $gia = $request->input('gia');

        $sanphamid = $request->input('sanphamid');
        $soluong = $request->input('soluong', 1);
        $gia = $request->input('gia');

        if (Auth::check()) {

            $giohang = Giohang::firstOrCreate(['nguoidungid' => Auth::id()]);

            $chitiet = Chitietgiohang::updateOrCreate(
                ['giohangid' => $giohang->id, 'sanphamid' => $sanphamid],
                ['soluong' => DB::raw("soluong + $soluong")]
            );
            return redirect()->back()->with('suc', 'Sản phẩm đã được thêm vào giỏ hàng');
        } else {
            $giohang = session()->get('giohang', []);
            if (isset($giohang[$sanphamid])) {
                $giohang[$sanphamid]['soluong'] += $soluong;
            } else {
                $giohang[$sanphamid] = [
                    'soluong' => $soluong,
                    'gia' => $gia
                ];
            }
            session()->put('giohang', $giohang);
            return redirect()->back()->with('suc', 'Sản phẩm đã được thêm vào giỏ hàng tạm');
        }
    }

    public function syncSessionToDatabase()
    {
        if (Auth::check()) {
            $sessionGiohang = session()->get('giohang', []);

            if (!empty($sessionGiohang)) {
                $giohang = Giohang::firstOrCreate(['nguoidungid' => Auth::id()]);

                foreach ($sessionGiohang as $sanphamid => $details) {
                    Chitietgiohang::updateOrCreate(
                        ['giohangid' => $giohang->id, 'sanphamid' => $sanphamid],
                        ['soluong' => DB::raw("soluong + {$details['soluong']}"), 'gia' => $details['gia']]
                    );
                }
                session()->forget('giohang');
            }
        }
    }

    public function removeFromCart($id)
    {
        $chitietgiohang = Chitietgiohang::find($id);
        if ($chitietgiohang && $chitietgiohang->giohang->nguoidungid == Auth::id()) {
            $chitietgiohang->delete();
        }
        return redirect()->route('giohang');
    }
    public function removess(Request $request, $sanphamid)
    {
        $giohang = session()->get('giohang', []);

        if (isset($giohang[$sanphamid])) {
            unset($giohang[$sanphamid]);
        }
        session()->put('giohang', $giohang);
        return redirect()->route('giohang')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }


    public function updateQuantity(Request $request)
    {

        try {
            $giohangId = $request->input('giohangId');
            $productId = $request->input('productId');
            $quantity = $request->input('quantity');
            if (Auth::check()) {
                $cartItem = Chitietgiohang::where('giohangid', $giohangId)
                    ->where('sanphamid', $productId)
                    ->first();

                if ($cartItem) {
                    $cartItem->soluong = $quantity;
                    $cartItem->save();
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
                }
            } else {

                $giohang = session()->get('giohang', []);
                if (isset($giohang[$productId])) {
                    $giohang[$productId]['soluong'] = $quantity;
                    session()->put('giohang', $giohang);
                }
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating quantity'], 500);
        }
    }

    public function saveDiscount(Request $request)
    {
        $discountCode = $request->input('discount_code');
        $discountAmount = $request->input('discount_amount');
        $discountId = $request->input('discount_id');

        session([
            'discount_code' => $discountCode,
            'discount_amount' => $discountAmount,
            'discount_id' => $discountId,
        ]);
        return response()->json(['success' => true]);
    }
}
