<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Tamnen;
use Illuminate\Http\Request;

class TamnenController extends Controller
{
    public function index()
    {
        $tamnen = tamnen::all();
        return view("admin.pages.subthongso.tamnen", compact('tamnen'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            tamnen::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $tamnen = Tamnen::findOrFail($id);
            $tamnen->ten = $request->ten;
            $tamnen->save();
            return redirect()->route('admin.indextamnen')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indextamnen')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $tamnen = tamnen::findOrFail($id);
            $tamnen->delete();
            return redirect()->route('admin.indextamnen')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indextamnen')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
