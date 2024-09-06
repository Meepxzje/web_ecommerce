<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phuongthucthanhtoan;
use Illuminate\Http\Request;

class PhuongthucthanhtoanController extends Controller
{
    public function index()
    {
        $pttt = Phuongthucthanhtoan::all();
        return view("admin.pages.phuongthucthanhtoan", compact('pttt'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            Phuongthucthanhtoan::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $pttt = Phuongthucthanhtoan::findOrFail($id);
            $pttt->ten = $request->ten;
            $pttt->save();
            return redirect()->route('admin.indexpttt')->with('suc', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexpttt')->with('err', 'Cập nhật sản phẩm thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $pttt = Phuongthucthanhtoan::findOrFail($id);
            $pttt->delete();
            return redirect()->route('admin.indexpttt')->with('suc', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexpttt')->with('err', 'Cập nhật sản phẩm thất bại: ' . $e->getMessage());
        }
    }
}
