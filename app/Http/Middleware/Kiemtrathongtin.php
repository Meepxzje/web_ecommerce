<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Kiemtrathongtin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->matp == null || Auth::user()->maqh == null || Auth::user()->xaid == null)
        {
            return redirect()->route('taikhoan')->with('err','Vui lòng nhập đầy đủ thông tin');
        }
        return $next($request);
    }
}
