<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Busram;
use Illuminate\Http\Request;

class BusramController extends Controller
{
    public function index()
    {
        $busram = busram::all();
        return view("admin.pages.subthongso.busram", compact('busram'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            Busram::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $busram = busram::findOrFail($id);
            $busram->ten = $request->ten;
            $busram->save();
            return redirect()->route('admin.indexbusram')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexbusram')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $busram = busram::findOrFail($id);
            $busram->delete();
            return redirect()->route('admin.indexbusram')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexbusram')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
