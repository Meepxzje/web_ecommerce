<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Danhmuc;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{

    public function index()
    {
        $dm = Danhmuc::all();
        $dmcha = Danhmuc::whereNull('parentid')->get();
        return view("admin.pages.dm.index", compact('dm','dmcha'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:50',
            'dmcha' => 'nullable|exists:danhmuc,id',
        ]);
        try {
            Danhmuc::create([
                'ten' => $validatedData['ten'],
                'parentid' => $validatedData['dmcha'],
            ]);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function edit(string $id)
    {
        $dmcha = Danhmuc::whereNull('parentid')->get();
        $dm = Danhmuc::find($id);
        return view("admin.pages.dm.edit", compact('dm','dmcha'));
    }

    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
            'dmcha' => 'nullable|exists:danhmuc,id',
        ]);
        try {
            $dm = Danhmuc::find($id);
            if (!$dm) {
                return redirect()->route('admin.indexdm')->with('err', 'Không tìm thấy');
            }
            $dm->ten = $request->ten;
            $dm->parentid = $request->dmcha;
            $dm->save();
            return redirect()->route('admin.indexdm')->with('suc', 'Đã cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexdm')->with('err', 'Không thành công!');
        }
    }

    public function destroy(string $id)
    {
        $dm = Danhmuc::find($id);
        if (!$dm) {
            return redirect()->route('admin.indexdm')->with('err', 'Không tìm thấy');
        }
        try {
            $dm->delete();
            return redirect()->route('admin.indexdm')->with('suc', 'Đã xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexdm')->with('suc', 'Xóa không thành công!');
        }
    }
}
