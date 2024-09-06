<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Loairam;
use Illuminate\Http\Request;

class LoairamController extends Controller
{
    public function index()
    {
        $loairam = loairam::all();
        return view("admin.pages.subthongso.loairam", compact('loairam'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            loairam::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $loairam = Loairam::findOrFail($id);
            $loairam->ten = $request->ten;
            $loairam->save();
            return redirect()->route('admin.indexloairam')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexloairam')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $loairam = loairam::findOrFail($id);
            $loairam->delete();
            return redirect()->route('admin.indexloairam')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexloairam')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
