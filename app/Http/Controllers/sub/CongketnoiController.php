<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Congketnoi;
use Illuminate\Http\Request;

class CongketnoiController extends Controller
{
    public function index()
    {
        $congketnoi = congketnoi::all();
        return view("admin.pages.subthongso.congketnoi", compact('congketnoi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            congketnoi::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $congketnoi = Congketnoi::findOrFail($id);
            $congketnoi->ten = $request->ten;
            $congketnoi->save();
            return redirect()->route('admin.indexcongketnoi')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexcongketnoi')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $congketnoi = congketnoi::findOrFail($id);
            $congketnoi->delete();
            return redirect()->route('admin.indexcongketnoi')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexcongketnoi')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
