<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Cpu;
use Illuminate\Http\Request;

class CpuController extends Controller
{
    public function index()
    {
        $cpu = Cpu::all();
        return view("admin.pages.subthongso.cpu", compact('cpu'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            Cpu::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $cpu = Cpu::findOrFail($id);
            $cpu->ten = $request->ten;
            $cpu->save();
            return redirect()->route('admin.indexcpu')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexcpu')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $cpu = Cpu::findOrFail($id);
            $cpu->delete();
            return redirect()->route('admin.indexcpu')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexcpu')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
