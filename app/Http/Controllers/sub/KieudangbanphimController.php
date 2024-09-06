<?php

namespace App\Http\Controllers\sub;

use App\Http\Controllers\Controller;
use App\Models\Kieudangbanphim;
use Illuminate\Http\Request;

class KieudangbanphimController extends Controller
{
    public function index()
    {
        $kieudangbanphim = kieudangbanphim::all();
        return view("admin.pages.subthongso.kieudangbanphim", compact('kieudangbanphim'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
        ]);
        try {
            kieudangbanphim::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $kieudangbanphim = Kieudangbanphim::findOrFail($id);
            $kieudangbanphim->ten = $request->ten;
            $kieudangbanphim->save();
            return redirect()->route('admin.indexkieudangbanphim')->with('suc', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexkieudangbanphim')->with('err', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $kieudangbanphim = kieudangbanphim::findOrFail($id);
            $kieudangbanphim->delete();
            return redirect()->route('admin.indexkieudangbanphim')->with('suc', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexkieudangbanphim')->with('err', 'Xóa thất bại: ' . $e->getMessage());
        }
    }
}
