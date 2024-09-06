<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phivanchuyen;
use App\Models\Thanhpho;
use Exception;
use Illuminate\Http\Request;

class VanchuyenController extends Controller
{
    public function index()
    {
        $pvc = Phivanchuyen::with('thanhpho')->get();
        $thanhphos = Thanhpho::all();
        return view('admin.pages.phivanchuyen', compact('pvc', 'thanhphos'));
    }

    public function store(Request $request)
    {
        try
        {
            Phivanchuyen::updateOrCreate(
                ['matp' => $request->matp],
                ['phivanchuyen' => $request->phivanchuyen]
            );

            return redirect()->back()->with('suc', 'Phí vận chuyển đã được lưu thành công.');
        }
        catch(Exception $e)
        {
            return redirect()->back()->with('err', 'Lỗi');
        }
    }

    public function destroy($id)
    {
        $pvc = Phivanchuyen::findOrFail($id);
        $pvc->delete();

        return redirect()->back()->with('suc', 'Phí vận chuyển đã được xóa thành công.');
    }



}
