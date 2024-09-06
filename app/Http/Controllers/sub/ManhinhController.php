<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Manhinh;
use Illuminate\Http\Request;

class ManhinhController extends Controller
{
    public function index()
    {
        $manhinh = Manhinh::all();
        return view("admin.pages.subthongso.manhinh", compact('manhinh'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            Manhinh::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $manhinh = Manhinh::findOrFail($id);
            $manhinh->ten = $request->ten;
            $manhinh->save();
            return redirect()->route('admin.indexmanhinh')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexmanhinh')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $manhinh = Manhinh::findOrFail($id);
            $manhinh->delete();
            return redirect()->route('admin.indexmanhinh')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexmanhinh')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
