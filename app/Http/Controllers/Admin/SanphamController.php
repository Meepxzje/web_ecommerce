<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Busram;
use App\Models\Congketnoi;
use App\Models\Cpu;
use App\Models\Danhmuc;
use App\Models\Dophangiai;
use App\Models\Gpu;
use App\Models\Hinhanhsanpham;
use App\Models\Keycap;
use App\Models\Kieudangbanphim;
use App\Models\Kieutainghe;
use App\Models\Loaibanphim;
use App\Models\Loairam;
use App\Models\Manhinh;
use App\Models\Nhacungcap;
use App\Models\Nhasanxuat;
use App\Models\Quatang;
use App\Models\Ram;
use App\Models\Sanpham;
use App\Models\Ssd;
use App\Models\Tamnen;
use App\Models\Tansoquet;
use App\Models\Thongsohieunang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SanphamController extends Controller
{

    public function index()
    {
        $sp = Sanpham::with(['nhasanxuat', 'nhacungcap', 'danhmuc', 'hinhanhsanphams'])->orderBy('id')->get();
        $nsx = NhaSanXuat::select('id', 'ten')->get();
        $ncc = NhaCungCap::select('id', 'ten')->get();
        $dm = Danhmuc::select('id', 'ten')->get();

        return view("admin.pages.sp.index", ['sp' => $sp, 'ncc' => $ncc, 'nsx' => $nsx, 'dm' => $dm]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string',
            'gia' => 'required|numeric',
            'mota' => 'required|string',
            'soluong' => 'required|numeric',
            'daban' => 'required|numeric',
            'dm' => 'required|numeric',
            'ncc' => 'required|numeric',
            'nsx' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $sp = new Sanpham();
            $sp->ten = $request->ten;
            $sp->gia = $request->gia;
            $sp->mota = $request->mota;
            $sp->soluong = $request->soluong;
            $sp->daban = $request->daban;
            $sp->danhmucid = $request->dm;
            $sp->nhacungcapid = $request->ncc;
            $sp->nhasanxuatid = $request->nsx;
            $sp->save();
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = $image->getClientOriginalName();
                    $image->move(public_path('back-end/img/sp'), $imageName);
                    $hinhanh = new Hinhanhsanpham();
                    $hinhanh->img = $imageName;
                    $sp->hinhanhsanphams()->save($hinhanh);
                }
            }

            return redirect()->route('admin.indexsp')->with('suc', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexsp')->with('err', 'Thêm mới thất bại' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'gia' => 'required|numeric',
            'mota' => 'nullable|string',
            'soluong' => 'required|integer',
            'dm' => 'required|exists:danhmuc,id',
            'ncc' => 'required|exists:nhacungcap,id',
            'nsx' => 'required|exists:nhasanxuat,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $sanpham = SanPham::findOrFail($id);
            $sanpham->ten = $validatedData['ten'];
            $sanpham->gia = $validatedData['gia'];
            $sanpham->mota = $validatedData['mota'];
            $sanpham->soluong = $validatedData['soluong'];
            $sanpham->danhmucid = $validatedData['dm'];
            $sanpham->nhacungcapid = $validatedData['ncc'];
            $sanpham->nhasanxuatid = $validatedData['nsx'];
            $sanpham->save();

            if ($request->hasFile('images')) {
                foreach ($sanpham->hinhanhsanphams as $hinhanh) {
                    Storage::delete('back-end/img/sp/' . $hinhanh->img);
                    $hinhanh->delete();
                }
                foreach ($request->file('images') as $image) {
                    $imageName = $image->getClientOriginalName();
                    $image->move(public_path('back-end/img/sp'), $imageName);
                    $hinhanh = new HinhanhSanpham();
                    $hinhanh->img = $imageName;
                    $hinhanh->sanphamid = $sanpham->id;
                    $hinhanh->save();
                }
            }
            return redirect()->route('admin.indexsp')->with('suc', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexsp')->with('err', 'Cập nhật sản phẩm thất bại: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $sanpham = Sanpham::findOrFail($id);
            foreach ($sanpham->hinhanhsanphams as $hinhanh) {
                Storage::delete('back-end/img/sp/' . $hinhanh->img);
                $hinhanh->delete();
            }
            $sanpham->thongsohieunang()->delete();
            $sanpham->thongsomanhinh()->delete();
            $sanpham->thongsoluutru()->delete();
            $sanpham->thongsoketnoi()->delete();
            $sanpham->thongsomanhinh()->delete();
            $sanpham->thongsopin()->delete();
            $sanpham->thongsotongquat()->delete();
            $sanpham->thongsotruyenthong()->delete();
            $sanpham->delete();
            return redirect()->route('admin.indexsp')->with('suc', 'Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexsp')->with('err', 'Xóa sản phẩm thất bại: ' . $e->getMessage());
        }
    }

    public function thongso(string $id)
    {
        $cpu = Cpu::all();
        $gpu = Gpu::all();
        $ram = Ram::all();
        $ssd = Ssd::all();
        $dophangiai = Dophangiai::all();
        $tamnen = Tamnen::all();
        $tansoquet = Tansoquet::all();
        $manhinh = Manhinh::all();
        $loairam = Loairam::all();
        $busram = Busram::all();
        $loaibanphim = Loaibanphim::all();
        $kieudangbanphim = Kieudangbanphim::all();
        $keycap = Keycap::all();
        $congketnoi = Congketnoi::all();
        $kieutainghe = Kieutainghe::all();
        $sp = SanPham::with('thongsohieunang', 'thongsoketnoi', 'thongsoluutru', 'thongsomanhinh', 'thongsopin', 'thongsotongquat', 'thongsotruyenthong')->findOrFail($id);
        return view('admin.pages.sp.thongso', compact('sp', 'cpu', 'gpu', 'ram', 'ssd', 'manhinh', 'dophangiai', 'tamnen', 'tansoquet', 'loairam', 'busram', 'loaibanphim', 'kieudangbanphim', 'keycap', 'congketnoi', 'kieutainghe'));
    }

    public function getSanphamByDanhmuc($danhmucId)
    {
        $sanphams = Sanpham::where('danhmucid', $danhmucId)->get();
        return response()->json($sanphams);
    }

    public function getQuatang($sanphamId)
    {
        $sanpham = Sanpham::with('quatangs.sanpham')->find($sanphamId);

        if (!$sanpham) {
            return response()->json(['error' => 'Sản phẩm không tồn tại.'], 404);
        }

        $quatangs = [];
        $currentDate = Carbon::today();

        foreach ($sanpham->quatangs as $quatang) {
            if ($quatang->soluong > 0 && Carbon::parse($quatang->ngayketthuc)->gte($currentDate)) {
                $quatangs[] = [
                    'id' => $quatang->sanphamidquatang,
                    'ten' => $quatang->sanpham->ten
                ];
            }
        }

        return response()->json(['quatangs' => $quatangs]);
    }
}
