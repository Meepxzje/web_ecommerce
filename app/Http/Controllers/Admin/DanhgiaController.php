<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Danhgia;
use Illuminate\Http\Request;

class DanhgiaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nguoidungid' => 'required|exists:nguoidung,id',
            'sanphamid' => 'required|exists:sanpham,id',
            'diem' => 'required|integer|min:1|max:5',
            'binhluan' => 'nullable|string',
        ]);
        Danhgia::create($validatedData);

        return redirect()->back()->with('suc', 'Đánh giá của bạn đã được gửi!');
    }
    public function destroy($id)
    {
        $danhgia = Danhgia::findOrFail($id);
        $danhgia->delete();

        return redirect()->back()->with('success', 'Đã xóa đánh giá thành công.');
    }
    public function edit($id)
    {
        $danhgia = Danhgia::findOrFail($id);
        return view('danhgia.edit', compact('danhgia'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'binhluan' => 'required|string|max:255',
            'diem' => 'required|integer|min:1|max:5',
        ]);

        $danhgia = Danhgia::findOrFail($id);
        $danhgia->binhluan = $request->input('binhluan');
        $danhgia->diem = $request->input('diem');
        $danhgia->save();

        return redirect()->route('chitietsp', ['id' => $danhgia->sanphamid])->with('success', 'Đã cập nhật đánh giá thành công.');
    }
}
