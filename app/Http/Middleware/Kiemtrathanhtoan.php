<?php

namespace App\Http\Middleware;

use App\Models\Chitietgiohang;
use App\Models\Giohang;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Kiemtrathanhtoan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $giohang = Giohang::where('nguoidungid', $user->id)->first();
        $chitiet = Chitietgiohang::where('giohangid', $giohang->id)->get();
        if (Auth::user()->matp == null || Auth::user()->maqh == null || Auth::user()->xaid == null) {
            return redirect()->route('taikhoan')->with('err', 'Vui lòng nhập đầy đủ thông tin');
        }
        if ($chitiet == null) {
            return redirect()->route('index')->with('err', 'Vui lòng chọn sản phẩm để thanh toán');
        }
        foreach($chitiet as $i)
        {
            if($i->sanpham->soluong <=0)
            {
                return redirect()->route('giohang')->with('err', 'Vui lòng kiểm tra lại sản phẩm');
            }
        }
        return $next($request);
    }
}
