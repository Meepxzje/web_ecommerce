<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thongsohieunang;
use App\Models\Thongsoketnoi;
use App\Models\Thongsoluutru;
use App\Models\Thongsomanhinh;
use App\Models\Thongsopin;
use App\Models\Thongsopkbanphim;
use App\Models\Thongsopkchuot;
use App\Models\Thongsopkmanhinh;
use App\Models\Thongsopkram;
use App\Models\Thongsopktainghe;
use App\Models\Thongsotongquat;
use App\Models\Thongsotruyenthong;
use Illuminate\Http\Request;

class ThongsoController extends Controller
{
    public function thongsohieunang(Request $request, string $id)
    {
        $request->validate([
            'cpu' => 'required|int',
            'tocdoxungnhipcoban' => 'required|string',
            'tocdoxungnhiptoida' => 'required|string',
            'ram' => 'required|string',
            'loaibonho' => 'required|string',
            'tocdobonho' => 'required|string',
            'khecambonhokhadung' => 'required|string',
            'kieudohoa' => 'required|string',
            'gpu' => 'required|string',
            'gpuroi' => 'nullable|string',
        ]);

        try {
            Thongsohieunang::updateOrCreate(
                ['sanphamid' => $id],
                $request->only([
                    'cpu', 'tocdoxungnhipcoban', 'tocdoxungnhiptoida', 'ram',
                    'loaibonho', 'tocdobonho', 'khecambonhokhadung',
                    'kieudohoa', 'gpu', 'gpuroi'
                ])
            );

            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số thất bại: ' . $e->getMessage());
        }
    }

    public function thongsoketnoi(Request $request, string $id)
    {
        $request->validate([
            'cong' => 'required|string',
            'soluongcong' => 'required|integer',
            'hienthi' => 'required|string',
            'soluongconghienthi' => 'required|integer',
            'amthanh1' => 'required|string',
            'amthanh2' => 'required|string',
            'amthanh3' => 'required|string',
            'khecaidatmorong' => 'required|string',
            'docthenho' => 'required|string',
        ]);

        try {
            Thongsoketnoi::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'cong' => $request->cong,
                    'soluongcong' => $request->soluongcong,
                    'hienthi' => $request->hienthi,
                    'soluongconghienthi' => $request->soluongconghienthi,
                    'amthanh1' => $request->amthanh1,
                    'amthanh2' => $request->amthanh2,
                    'amthanh3' => $request->amthanh3,
                    'khecaidatmorong' => $request->khecaidatmorong,
                    'docthenho' => $request->docthenho,
                ]
            );
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số kết nối thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số thất bại: ' . $e->getMessage());
        }
    }

    public function thongsoluutru(Request $request, string $id)
    {
        $request->validate([
            'khecamkhadung' => 'required|string',
            'tongdungluong' => 'required|string',
            'luutru' => 'required|string',
            'odia' => 'required|string',
        ]);

        try {
            Thongsoluutru::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'khecamkhadung' => $request->khecamkhadung,
                    'tongdungluong' => $request->tongdungluong,
                    'luutru' => $request->luutru,
                    'odia' => $request->odia,
                ]
            );

            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số lưu trữ thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số thất bại: ' . $e->getMessage());
        }
    }

    public function thongsomanhinh(Request $request, string $id)
    {
        $request->validate([
            'loaipanel' => 'required|string',
            'kichthuoc' => 'required|string',
            'tylekhunghinh' => 'required|string',
            'dophangiai' => 'required|string',
            'manhinhcamung' => 'required|string',
            'bemat' => 'required|string',
            'dosang' => 'required|string',
        ]);

        try {
            Thongsomanhinh::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'loaipanel' => $request->loaipanel,
                    'kichthuoc' => $request->kichthuoc,
                    'tylekhunghinh' => $request->tylekhunghinh,
                    'dophangiai' => $request->dophangiai,
                    'manhinhcamung' => $request->manhinhcamung,
                    'bemat' => $request->bemat,
                    'dosang' => $request->dosang,
                ]
            );
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số màn hình thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số màn hình thất bại: ' . $e->getMessage());
        }
    }

    public function thongsopin(Request $request, string $id)
    {
        $request->validate([
            'pin' => 'required|string',
            'loai' => 'required|string',
            'thoigiansudungtoida' => 'required|string',
            'yeucaunangluong' => 'required|string',
            'cungcapnangluong' => 'required|string',
        ]);

        try {
            Thongsopin::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'pin' => $request->pin,
                    'loai' => $request->loai,
                    'thoigiansudungtoida' => $request->thoigiansudungtoida,
                    'yeucaunangluong' => $request->yeucaunangluong,
                    'cungcapnangluong' => $request->cungcapnangluong,
                ]
            );

            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Thông số pin đã được cập nhật hoặc thêm mới.');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Không thể cập nhật thông số pin: ' . $e->getMessage());
        }
    }

    public function thongsotongquat(Request $request, string $id)
    {
        $request->validate([
            'hedieuhanh' => 'required|string',
            'anninh' => 'required|string',
            'banphim' => 'required|string',
            'thietbidiem' => 'required|string',
            'kichthuoc' => 'required|string',
            'trongluong' => 'required|string',
        ]);

        try {
            Thongsotongquat::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'hedieuhanh' => $request->hedieuhanh,
                    'anninh' => $request->anninh,
                    'banphim' => $request->banphim,
                    'thietbidiem' => $request->thietbidiem,
                    'kichthuoc' => $request->kichthuoc,
                    'trongluong' => $request->trongluong,
                ]
            );

            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Thông số tổng quát đã được cập nhật hoặc thêm mới.');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Không thể cập nhật thông số tổng quát: ' . $e->getMessage());
        }
    }

    public function thongsotruyenthong(Request $request, string $id)
    {
        $request->validate([
            'ketnoimang' => 'required|string',
            'modem' => 'required|string',
            'wifi' => 'required|string',
            'bluetooth' => 'required|string',
            'bangthongdidong' => 'required|string',
            'gps' => 'required|string',
            'nfc' => 'required|string',
            'webcam' => 'required|string',
        ]);

        try {
            Thongsotruyenthong::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'ketnoimang' => $request->ketnoimang,
                    'modem' => $request->modem,
                    'wifi' => $request->wifi,
                    'bluetooth' => $request->bluetooth,
                    'bangthongdidong' => $request->bangthongdidong,
                    'gps' => $request->gps,
                    'nfc' => $request->nfc,
                    'webcam' => $request->webcam,
                ]
            );

            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Thông số truyền thông đã được cập nhật hoặc thêm mới.');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Không thể cập nhật thông số truyền thông: ' . $e->getMessage());
        }
    }


    public function thongsopkmanhinh(Request $request, string $id)
    {
        $request->validate([
            'kichthuoc' => 'required|string',
            'dophangiai' => 'required|string',
            'tamnen' => 'required|string',
            'tansoquet' => 'required|string',
            'dosang' => 'required|string',
            'dotuongphan' => 'required|string',
            'congketnoi' => 'required|string',
        ]);

        try {
            Thongsopkmanhinh::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'kichthuoc' => $request->kichthuoc,
                    'dophangiai' => $request->dophangiai,
                    'tamnen' => $request->tamnen,
                    'tansoquet' => $request->tansoquet,
                    'dosang' => $request->dosang,
                    'dotuongphan' => $request->dosang,
                    'congketnoi' => $request->dosang,
                ]
            );
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số màn hình thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số màn hình thất bại: ' . $e->getMessage());
        }
    }

    public function thongsopkram(Request $request, string $id)
    {
        $request->validate([
            'dungluong' => 'required|string',
            'loairam' => 'required|string',
            'tocdobus' => 'required|string',
        ]);

        try {
            Thongsopkram::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'dungluong' => $request->dungluong,
                    'loairam' => $request->loairam,
                    'tocdobus' => $request->tocdobus,
                ]
            );
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số màn hình thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số màn hình thất bại: ' . $e->getMessage());
        }
    }
    public function thongsopkbanphim(Request $request, string $id)
    {
        $request->validate([
            'loaibanphim' => 'required|string',
            'congketnoi' => 'required|string',
            'kieudangbanphim' => 'required|string',
            'kichthuoc' => 'required|string',
            'keycap' => 'required|string',
            'motakeycap' => 'required|string',
            'switch' => 'required|string',
            'pin' => 'required|string',
            'phukien' => 'required|string',
        ]);

        try {
            Thongsopkbanphim::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'loaibanphim' => $request->loaibanphim,
                    'congketnoi' => $request->congketnoi,
                    'kieudangbanphim' => $request->kieudangbanphim,
                    'kichthuoc' => $request->kichthuoc,
                    'keycap' => $request->keycap,
                    'motakeycap' => $request->motakeycap,
                    'switch' => $request->switch,
                    'pin' => $request->pin,
                    'phukien' => $request->phukien,
                ]
            );
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số thất bại: ' . $e->getMessage());
        }
    }


    public function thongsopkchuot(Request $request, $id)
    {
        $request->validate([
            'loaiketnoi' => 'required|string',
            'kieuketnoi' => 'required|string',
            'mausac' => 'required|string',
            'led' => 'required|string',
            'donhay' => 'required|string',
            'phukien' => 'required|string',
        ]);

        try {
            Thongsopkchuot::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'loaiketnoi' => $request->loaiketnoi,
                    'kieuketnoi' => $request->kieuketnoi,
                    'mausac' => $request->mausac,
                    'led' => $request->led,
                    'donhay' => $request->donhay,
                    'phukien' => $request->phukien,
                ]
            );

            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số chuột thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số chuột thất bại: ' . $e->getMessage());
        }
    }



    public function thongsopktainghe(Request $request, $id)
    {
        $request->validate([
            'loaiketnoi' => 'required|integer',
            'kieutainghe' => 'required|integer',
            'congketnoi' => 'required|integer',
            'mausac' => 'required|string',
            'micro' => 'required|string',
            'day' => 'required|string',
            'tuongthich' => 'required|string',
            'cacham' => 'required|string',
        ]);

        try {
            Thongsopktainghe::updateOrCreate(
                ['sanphamid' => $id],
                [
                    'loaiketnoi' => $request->loaiketnoi,
                    'kieutainghe' => $request->kieutainghe,
                    'congketnoi' => $request->congketnoi,
                    'mausac' => $request->mausac,
                    'micro' => $request->micro,
                    'day' => $request->day,
                    'tuongthich' => $request->tuongthich,
                    'cacham' => $request->cacham,
                ]
            );
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('suc', 'Lưu thông số tai nghe thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.thongsosp', ['id' => $id])->with('err', 'Lưu thông số tai nghe thất bại: ' . $e->getMessage());
        }
    }

}
