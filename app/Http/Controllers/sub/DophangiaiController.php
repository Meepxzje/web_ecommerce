<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Dophangiai;
use Illuminate\Http\Request;

class DophangiaiController extends Controller
{
    public function index()
    {
        $dophangiai = Dophangiai::all();
        return view("admin.pages.subthongso.dophangiai", compact('dophangiai'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            dophangiai::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $dophangiai = dophangiai::findOrFail($id);
            $dophangiai->ten = $request->ten;
            $dophangiai->save();
            return redirect()->route('admin.indexdophangiai')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexdophangiai')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $dophangiai = dophangiai::findOrFail($id);
            $dophangiai->delete();
            return redirect()->route('admin.indexdophangiai')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexdophangiai')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
