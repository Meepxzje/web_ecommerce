<?php

namespace App\Http\Controllers;

use App\Models\Quatang;
use App\Models\Sanpham;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class QuatangController extends Controller
{

    public function store(Request $request)
    {
        $sanphamidquatang = $request->sanphamidquantang;
        $soluong = $request->soluong;
        $ngaykethuc = $request->ngayketthuc;
        $mota = $request->mota;

        try {
            foreach ($sanphamidquatang as $key => $sanphamid) {
                if ($sanphamid != null) {
                    // Chuyển đổi ngày kết thúc và ngày hiện tại thành đối tượng Carbon
                    $ngayketthucDate = Carbon::parse($ngaykethuc[$key]);
                    $today = Carbon::today();

                    // Kiểm tra nếu ngày kết thúc nhỏ hơn ngày hiện tại
                    if ($ngayketthucDate < $today) {
                        return redirect()->back()->with('err', 'Lỗi: Ngày kết thúc phải lớn hơn hoặc bằng ngày hiện tại.');
                    }

                    Quatang::updateOrCreate(
                        ['sanphamidquatang' => $sanphamid],
                        [
                            'mota' => $mota[$key],
                            'soluong' => $soluong[$key],
                            'sanphamid' => $request->sanphamid,
                            'ngayketthuc' => $ngaykethuc[$key],
                        ]
                    );
                }
            }
            return redirect()->back()->with('suc', 'Quà tặng đã được lưu thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('err', 'Lỗi: ' . $e->getMessage());
        }
    }


    //laydanhsáchquatang
    public function getGifts($id)
    {
        $gifts = Quatang::with('sanpham')->where('sanphamid', $id)->get();
        return response()->json($gifts);
    }

    public function deleteGift(Request $request)
    {
        try {
            $sanphamid = $request->input('sanphamid');
            $sanphamidquatang = $request->input('sanphamidquatang');
            $gift = Quatang::where('sanphamid', $sanphamid)
                ->where('sanphamidquatang', $sanphamidquatang)
                ->firstOrFail();
            $gift->delete();
            return response()->json(['success' => 'Quà tặng đã được xóa.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi xóa quà tặng.'], 500);
        }
    }
}
