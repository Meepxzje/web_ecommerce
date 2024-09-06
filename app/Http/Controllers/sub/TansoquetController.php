<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Tansoquet;
use Illuminate\Http\Request;

class TansoquetController extends Controller
{
    public function index()
    {
        $tansoquet = tansoquet::all();
        return view("admin.pages.subthongso.tansoquet", compact('tansoquet'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            tansoquet::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $tansoquet = Tansoquet::findOrFail($id);
            $tansoquet->ten = $request->ten;
            $tansoquet->save();
            return redirect()->route('admin.indextansoquet')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indextansoquet')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $tansoquet = tansoquet::findOrFail($id);
            $tansoquet->delete();
            return redirect()->route('admin.indextansoquet')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indextansoquet')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
