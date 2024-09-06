<?php

namespace App\Http\Controllers;

use App\Models\Chitietdoitra;
use App\Models\Doitra;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoitraController extends Controller
{
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'donhangid' => 'required|exists:donhang,id',
            'sanphamids' => 'required|array',
            'sanphamids.*' => 'exists:sanpham,id',
            'soluong' => 'required|array',
            'soluong.*' => 'integer|min:1',
            'lydo' => 'required|string|max:255',
        ]);

        $u = Auth::user();
        try {
            $doitra = Doitra::create([
                'donhangid' => $request->donhangid,
                'nguoidungid' => $u->id,
                'lydo' => $request->lydo,
                'tinhtrang' => 'Yêu cầu đổi trả',
            ]);

            foreach ($request->sanphamids as $index => $sanphamid) {
                $soluong = $request->soluong[$index] ?? null;
                if ($soluong !== null && $soluong > 0) {
                    Chitietdoitra::create([
                        'doitraid' => $doitra->id,
                        'sanphamid' => $sanphamid,
                        'soluong' => $soluong,
                    ]);
                }
            }
            return redirect()->back()->with('suc', 'Yêu cầu thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Yêu cầu thất bại: ' . $e->getMessage());
        }
    }

}
