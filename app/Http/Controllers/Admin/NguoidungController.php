<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chitietdonhang;
use App\Models\Chitietgiohang;
use App\Models\Chitietmagiamgia;
use App\Models\Chitietquantam;
use App\Models\Danhmuc;
use App\Models\Doitra;
use App\Models\Donhang;
use App\Models\Giohang;
use App\Models\Nguoidung;
use App\Models\Phivanchuyen;
use App\Models\Quanhuyen;
use App\Models\Quantam;
use App\Models\Sanpham;
use App\Models\Thanhpho;
use App\Models\Xaphuong;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class NguoidungController extends Controller
{
    public function showRegistrationForm()
    {
        return view('login.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:nguoidung',
            'matkhau' => 'required|string|min:1|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            Nguoidung::create([
                'ten' => $request->ten,
                'email' => $request->email,
                'matkhau' => Hash::make($request->matkhau),
                'sodienthoai' => '',
                'diachi' => '',
                'matp' => '',
                'maqh' => '',
                'xaid' => '',
                'role' => 0, // Default role as customer
            ]);
            return redirect()->route('dangnhap')->with('suc', 'Đăng ký thành công! Bạn có thể đăng nhập bây giờ.');
        } catch (Exception $e) {
            return redirect()->route('dangnhap')->with('err', 'Lỗi');
        }
    }

    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'matkhau');

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['matkhau']])) {
            if (Auth::user()->email_verified_at == null) {
                return redirect()->route('verification.notice');
            }
            if (Auth::user()->role == 1)
            {
                return redirect()->route('admin.index');
            }
            return redirect()->intended('/');
        }
        return redirect()->back()->with('err', 'Sai tài khoản hoặc mật khẩu');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dangnhap');
    }

    public function check()
    {
        if (Auth::check()) {
            return response()->json(['authenticated' => true, 'user' => Auth::user()]);
        }
        return response()->json(['authenticated' => false]);
    }


    public function capnhatnguoidung(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required',
            'sdt' => 'required | phone:AUTO',
            'diachi' => 'required',
            'thanhpho' => 'required',
            'quanhuyen' => 'required',
            'xaphuong' => 'required',
        ], [
            'ten.required' => 'Vui lòng nhập tên.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.phone' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại hợp lệ.',
            'diachi.required' => 'Vui lòng nhập',
            'thanhpho.required' => 'Vui lòng nhập',
            'quanhuyen.required' => 'Vui lòng nhập',
            'xaphuong.required' => 'Vui lòng nhập',
        ]);

        try {
            $nguoidung = Nguoidung::find(Auth::id());
            if ($request->hasFile('img')) {
                if ($nguoidung->img) {
                    $imagePath = public_path('font-end/img/taikhoan/' . $nguoidung->img);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $image = $request->file('img');
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('font-end/img/taikhoan/'), $imageName);
                $nguoidung->img = $imageName;
            }
            $nguoidung->ten = $validatedData['ten'];
            $nguoidung->sodienthoai = $validatedData['sdt'];
            $nguoidung->diachi = $validatedData['diachi'];
            $nguoidung->matp = $validatedData['thanhpho'];
            $nguoidung->maqh = $validatedData['quanhuyen'];
            $nguoidung->xaid = $validatedData['xaphuong'];
            $nguoidung->save();
            return redirect()->back()->with('suc', 'Thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'that bai' . $e->getMessage());
        }
    }
    public function thongtincanhan()
    {
        $dms = Danhmuc::all();
        $u = Auth::user();
        $thanhphos = Thanhpho::all();


        $matp = $u->matp;
        $maqh = $u->maqh;
        $xaid = $u->xaid;


        $quanhuyens = Quanhuyen::where('matp', $matp)->get();
        $xaphuongs = Xaphuong::where('maqh', $maqh)->get();

        return view('fe.pages.taikhoan.thongtincanhan', compact('dms', 'u', 'thanhphos', 'quanhuyens', 'xaphuongs', 'matp', 'maqh', 'xaid'));
    }

    public function dondathang()
    {
        $dms = Danhmuc::all();
        $userId = Auth::id();
        $sl = Donhang::where('nguoidungid', $userId)->withCount('chitietdonhangs')->get();

        $excludedStatuses = ['Đang xử lý', 'Đã thanh toán', 'Đã xác nhận', 'Hoàn thành', 'Đã hủy %'];

        $donhangdxl = DonHang::where('nguoidungid', $userId)
            ->where('tinhtrang', 'Đang xử lý')
            ->with('chitietdonhangs.sanpham')
            ->orderByDesc('updated_at')
            ->get();

        $donhangdxn = DonHang::where('nguoidungid', $userId)
            ->where(function ($query) {
                $query->where('tinhtrang', 'Đã xác nhận')
                    ->orWhere('tinhtrang', 'Đã thanh toán');
            })
            ->with('chitietdonhangs.sanpham')
            ->orderByDesc('updated_at')
            ->get();

        $donhangdg = DonHang::where('nguoidungid', $userId)
            ->whereNotIn('tinhtrang', $excludedStatuses)
            ->with('chitietdonhangs.sanpham')
            ->orderByDesc('updated_at')
            ->get();

        $donhanght = DonHang::where('nguoidungid', $userId)
            ->where('tinhtrang', 'Hoàn thành')
            ->with('chitietdonhangs.sanpham')
            ->orderByDesc('updated_at')
            ->get();

        $donhanghuy = DonHang::where('nguoidungid', $userId)
            ->where('tinhtrang', 'like', 'Đã hủy %')
            ->orwhere('tinhtrang', 'like', 'Đã hủy')
            ->with('chitietdonhangs.sanpham')
            ->orderByDesc('updated_at')
            ->get();

        $donhangdoitra = Doitra::where('nguoidungid', $userId)
            ->where('tinhtrang', 'Yêu cầu đổi trả')
            ->orwhere('tinhtrang', 'like', 'Đã lên đơn mới%')
            ->orderByDesc('updated_at')
            ->get();
        $u = Auth::user();
        $doitra = Doitra::where('nguoidungid', $userId)->get();
        return view('fe.pages.taikhoan.dondathang', compact('dms', 'u', 'donhangdxl', 'donhangdxn', 'donhangdg', 'donhanght', 'sl', 'donhanghuy', 'donhangdoitra', 'doitra'));
    }



    public function caidattaikhoan()
    {
        $dms = Danhmuc::all();
        $u = Auth::user();
        return view('fe.pages.taikhoan.caidattaikhoan', compact('dms', 'u'));
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



    public function datlai($id)
    {
        try {
            $order = Donhang::findOrFail($id);
            $userId = $order->nguoidungid;

            $giohang = Giohang::firstOrCreate(['nguoidungid' => $userId]);

            foreach ($order->chitietdonhangs as $chitiet) {
                $existingItem = Chitietgiohang::where('giohangid', $giohang->id)
                    ->where('sanphamid', $chitiet->sanphamid)
                    ->first();

                if ($existingItem) {
                    $existingItem->update([
                        'soluong' => $existingItem->soluong + $chitiet->soluong
                    ]);
                } else {
                    Chitietgiohang::create([
                        'giohangid' => $giohang->id,
                        'sanphamid' => $chitiet->sanphamid,
                        'soluong' => $chitiet->soluong
                    ]);
                }
            }

            return redirect()->route('giohang')->with('suc', 'Đã thêm sản phẩm từ đơn hàng vào giỏ hàng');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Đặt lại thất bại: ' . $e->getMessage());
        }
    }



    public function getQuanHuyen(Request $request)
    {
        $data = $request->all();

        if ($data['action']) {
            if ($data['action'] == 'thanhpho') {
                $output = '';
                $layquanhuyen = Quanhuyen::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>-- Chọn quận huyện -- </option>';
                foreach ($layquanhuyen as $key => $quanhuyen) {
                    $output .= '<option value="' . $quanhuyen->maqh . '">' . $quanhuyen->name . '</option>';
                }
            } else
            if ($data['action'] == 'quanhuyen') {
                $output = '';
                $layxaphuong = Xaphuong::where('maqh', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>-- Chọn xã phường-- </option>';
                foreach ($layxaphuong as $key => $xaphuong) {
                    $output .= '<option value="' . $xaphuong->xaid . '">' . $xaphuong->name . '</option>';
                }
            }
        }
        echo $output;
    }
    public function doimatkhau(Request $request)
    {
        $user = Nguoidung::find($request->nguoidungid);
        $request->validate([
            'pwcu' => 'required',
            'pwmoi' => 'required|min:1',
            'pwxn' => 'required|same:pwmoi',
        ]);

        if (!Hash::check($request->pwcu, $user->matkhau)) {
            return redirect()->back()->with('err', 'Mật khẩu hiện tại không chính xác.');
        }
        try {
            $user->matkhau = Hash::make($request->pwmoi);
            $user->save();
            return redirect()->back()->with('suc', 'Mật khẩu đã được cập nhật thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Lỗi' . $e->getMessage());
        }
    }


    public function quantam()
    {
        $dms = Danhmuc::all();
        $u = Auth::user();
        $qt = Quantam::where('nguoidungid', Auth::id())->get();
        $sp = Sanpham::all();
        return view('fe.pages.taikhoan.quantam', compact('u', 'dms', 'qt', 'sp'));
    }

    public function addquantam($id)
    {
        $user = Auth::user();
        $sp = Sanpham::findOrFail($id);
        $ctqtExists = Chitietquantam::where('sanphamid', $id)
            ->whereHas('quantam', function ($query) {
                $query->where('nguoidungid', Auth::id());
            })
            ->exists();
        if ($ctqtExists) {
            return redirect()->back()->with('err', 'Bạn đã quan tâm sản phẩm này rồi');
        }

        try {
            $quantam = Quantam::firstOrCreate([
                'nguoidungid' => $user->id,
            ]);
            Chitietquantam::create([
                'quantamid' => $quantam->id,
                'sanphamid' => $id,
            ]);
            return redirect()->back()->with('suc', 'Bạn đã quan tâm sản phẩm ' . $sp->ten);
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Lỗi, không thể thêm vào quan tâm');
        }
    }

    public function removequantam($id)
    {
        $user = Auth::user();
        $quantam = Quantam::where('nguoidungid', $user->id)->first();

        if (!$quantam) {
            return redirect()->back()->with('err', 'Không tìm thấy quan tâm của bạn');
        }
        $chitietquantam = Chitietquantam::where('quantamid', $quantam->id)
            ->where('sanphamid', $id)
            ->first();
        if (!$chitietquantam) {
            return redirect()->back()->with('err', 'Bạn không quan tâm sản phẩm này');
        }

        try {
            $chitietquantam->delete();
            return redirect()->back()->with('suc', 'Bạn đã bỏ quan tâm sản phẩm thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Lỗi, không thể bỏ quan tâm sản phẩm');
        }
    }


    public function sosanh()
    {
        $dms = Danhmuc::all();
        $u = Auth::user();
        $compareProducts = session()->get('compare', []);
        $products = Sanpham::whereIn('id', $compareProducts)->get();
        return view('fe.pages.sosanh', compact('u', 'dms', 'products'));
    }

    public function addToCompare($id)
    {
        $product = Sanpham::findOrFail($id);
        $compare = session()->get('compare', []);
        if (!in_array($id, $compare)) {
            if (count($compare) >= 3) {
                return redirect()->back()->with('err', 'Bạn chỉ có thể so sánh tối đa 3 sản phẩm.');
            }
            foreach ($compare as $compareProductId) {
                $compareProduct = Sanpham::findOrFail($compareProductId);
                if ($compareProduct->danhmucid != $product->danhmucid) {
                    return redirect()->back()->with('err', 'Bạn chỉ có thể so sánh các sản phẩm cùng danh mục.');
                }
            }
            $compare[] = $id;
            session()->put('compare', $compare);
        } else {
            return redirect()->back()->with('err', 'Sản phẩm này đã có trong danh sách so sánh.');
        }

        return redirect()->back()->with('suc', 'Đã thêm sản phẩm vào danh sách so sánh.');
    }

    public function removeFromCompare($id)
    {
        $compare = session()->get('compare', []);
        if (($key = array_search($id, $compare)) !== false) {
            unset($compare[$key]);
            session()->put('compare', $compare);
        }
        return redirect()->back()->with('suc', 'Đã xóa sản phẩm khỏi danh sách so sánh.');
    }
    public function removeAllFromCompare()
    {
        session()->forget('compare');

        return redirect()->back()->with('suc', 'Đã xóa tất cả sản phẩm khỏi danh sách so sánh.');
    }

    public function magiamgia(Request $request)
    {
        $dms = Danhmuc::all();
        $u = Auth::user();
        $sp = Sanpham::all();
        $filter = $request->get('tinhtrang', 'chuasudung');
        if ($filter == 'chuasudung') {
            $mgg = Chitietmagiamgia::where('dasudung', 0)
                ->where('nguoidungid', $u->id)
                ->where('ngayhethan', '>=', Carbon::today())
                ->get();
        } elseif ($filter == 'dasudunghoachethan') {
            $om = Carbon::today()->subMonth();
            $mgg = Chitietmagiamgia::where('nguoidungid', $u->id)
                ->where(function ($query) use ($om) {
                    $query->where('dasudung', 1)
                        ->where('updated_at', '>=', $om)
                        ->orWhere(function ($query) use ($om) {
                            $query->where('ngayhethan', '<', Carbon::today())
                                ->where('ngayhethan', '>=', $om);
                        });
                })
                ->get();
        } else {
            $mgg = Chitietmagiamgia::where('nguoidungid', $u->id)->get();
        }

        return view('fe.pages.taikhoan.magiamgia', compact('u', 'dms', 'mgg', 'sp'));
    }




    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }



    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Nguoidung::where('email', $request->email)->first();

        if ($user) {
            $token = Password::createToken($user);
            $user->notify(new ResetPasswordNotification($token, $request->email));
            return back()->with(['status' => 'Link đặt lại mật khẩu đã được gửi!']);
        }
        return back()->withErrors(['email' => 'Email này không tồn tại trong hệ thống.']);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-pw', ['token' => $token, 'email' => request()->email]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:1|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'matkhau' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('dangnhap')->with('suc', 'Đã thay đổi mật khẩu')
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $name = $googleUser->name;
            $email = $googleUser->email;
            $user = Nguoidung::where('email', $email)->first();
            if ($user) {
                Auth::login($user, true);
                return redirect()->intended('/');
            } else {
                $user = Nguoidung::create([
                    'ten' => $name,
                    'email' => $email,
                    'matkhau' => bcrypt(Str::random(24)),
                    'sodienthoai' => '',
                    'diachi' => '',
                    'matp' => '',
                    'maqh' => '',
                    'xaid' => '',
                    'role' => 0,
                    'email_verified_at' => Carbon::now(),
                ]);
                Auth::login($user, true);
            }
            return redirect()->intended('/');
        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/dangnhap')->with('err', 'Đăng nhập Google không thành công' . $e->getMessage());
        }
    }
}
