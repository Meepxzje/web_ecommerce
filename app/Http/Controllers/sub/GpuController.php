<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Gpu;
use Illuminate\Http\Request;

class GpuController extends Controller
{
    public function index()
    {
        $gpu = Gpu::all();
        return view("admin.pages.subthongso.gpu", compact('gpu'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            Gpu::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $gpu = Gpu::findOrFail($id);
            $gpu->ten = $request->ten;
            $gpu->save();
            return redirect()->route('admin.indexgpu')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexgpu')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $gpu = Gpu::findOrFail($id);
            $gpu->delete();
            return redirect()->route('admin.indexgpu')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexgpu')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
