<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Ssd;
use Illuminate\Http\Request;

class SsdController extends Controller
{
    public function index()
    {
        $ssd = Ssd::all();
        return view("admin.pages.subthongso.ssd", compact('ssd'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            ssd::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $ssd = ssd::findOrFail($id);
            $ssd->ten = $request->ten;
            $ssd->save();
            return redirect()->route('admin.indexssd')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexssd')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $ssd = ssd::findOrFail($id);
            $ssd->delete();
            return redirect()->route('admin.indexssd')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexssd')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
