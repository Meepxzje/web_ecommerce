<?php

namespace App\Http\Controllers;

use App\Models\Giamgia;
use App\Models\Giamgiahangloat;
use App\Models\Sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GiamgiaController extends Controller
{
    public function addDiscount(Request $request)
    {
        try {
            $sanphamId = $request->sanphamid;
            $giagiam = $request->giagiam;
            $danggiam = $request->danggiam;
            $ngayBatDau = $request->ngaybatdau;
            $ngayKetThuc = $request->ngayketthuc;
            $soLuongSanPham = $request->soluongsanpham;

            $sp = Sanpham::findOrFail($sanphamId);
            if ($ngayBatDau <= $ngayKetThuc) {
                if ($sp->gia > $giagiam) {
                    Giamgia::updateOrCreate(
                        ['sanphamid' => $sanphamId],
                        [
                            'giagiam' => $giagiam,
                            'danggiam' => $danggiam,
                            'ngaybatdau' => $ngayBatDau,
                            'ngayketthuc' => $ngayKetThuc,
                            'soluongsanpham' => $soLuongSanPham
                        ]
                    );
                    return response()->json(['success' => true, 'message' => 'Giảm giá thành công.']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Giá giảm lớn hơn giá sản phẩm']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Ngày kết thúc nhỏ hơn ngày bắt đầu!']);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi thêm giảm giá: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function getDiscount(Request $request, $id)
    {
        try {
            $giamgia = Giamgia::where('sanphamid', $id)->first();
            $giamgiahangloat = GiamgiaHangloat::where('sanphamid', $id)->first();
            return response()->json([
                'success' => true,
                'data' => [
                    'giamgia' => $giamgia,
                    'giamgiahangloat' => $giamgiahangloat
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi lấy thông tin giảm giá: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

    public function addBulkDiscount(Request $request)
    {
        try {
            $nsx = $request->nsx;
            $danhmuc = $request->danhmuc;
            $phantramgiamgia = $request->phantramgiamgia;
            $giamtoida = $request->giamtoida;
            $ngaybatdau = $request->ngaybatdau;
            $ngayketthuc = $request->ngayketthuc;
            $soluongsanpham = $request->soluongsanpham;

            $sanphams = Sanpham::where('nhasanxuatid', $nsx)
                ->where('danhmucid', $danhmuc)
                ->get();
            if ($ngaybatdau <= $ngayketthuc) {


                foreach ($sanphams as $sp) {
                    GiamgiaHangloat::updateOrCreate(
                        ['sanphamid' => $sp->id],
                        [
                            'phantramgiamgia' => $phantramgiamgia,
                            'giamtoida' => $giamtoida,
                            'ngaybatdau' => $ngaybatdau,
                            'ngayketthuc' => $ngayketthuc,
                            'soluongsanpham' => $soluongsanpham
                        ]
                    );
                }
                return response()->json(['success' => true, 'message' => 'Giảm giá hàng loạt thành công.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Ngày kết thúc nhỏ hớn ngày bắt đầu!']);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi thêm giảm giá hàng loạt: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
}
