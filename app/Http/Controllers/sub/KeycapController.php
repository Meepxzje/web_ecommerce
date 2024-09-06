<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Keycap;
use Illuminate\Http\Request;

class KeycapController extends Controller
{
    public function index()
    {
        $keycap = keycap::all();
        return view("admin.pages.subthongso.keycap", compact('keycap'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            keycap::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $keycap = Keycap::findOrFail($id);
            $keycap->ten = $request->ten;
            $keycap->save();
            return redirect()->route('admin.indexkeycap')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexkeycap')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $keycap = keycap::findOrFail($id);
            $keycap->delete();
            return redirect()->route('admin.indexkeycap')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexkeycap')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
