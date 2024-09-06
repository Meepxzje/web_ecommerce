<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Loaibanphim;
use Illuminate\Http\Request;

class LoaibanphimController extends Controller
{
    public function index()
    {
        $loaibanphim = loaibanphim::all();
        return view("admin.pages.subthongso.loaibanphim", compact('loaibanphim'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            loaibanphim::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $loaibanphim = Loaibanphim::findOrFail($id);
            $loaibanphim->ten = $request->ten;
            $loaibanphim->save();
            return redirect()->route('admin.indexloaibanphim')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexloaibanphim')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $loaibanphim = loaibanphim::findOrFail($id);
            $loaibanphim->delete();
            return redirect()->route('admin.indexloaibanphim')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexloaibanphim')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
