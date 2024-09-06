<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Kieutainghe;
use Illuminate\Http\Request;

class KieutaingheController extends Controller
{
    public function index()
    {
        $kieutainghe = kieutainghe::all();
        return view("admin.pages.subthongso.kieutainghe", compact('kieutainghe'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            kieutainghe::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $kieutainghe = Kieutainghe::findOrFail($id);
            $kieutainghe->ten = $request->ten;
            $kieutainghe->save();
            return redirect()->route('admin.indexkieutainghe')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexkieutainghe')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $kieutainghe = kieutainghe::findOrFail($id);
            $kieutainghe->delete();
            return redirect()->route('admin.indexkieutainghe')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexkieutainghe')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
