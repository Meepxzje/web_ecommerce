<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chitietmagiamgia;
use App\Models\Magiamgia;
use App\Models\Nguoidung;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChitietmagiamgiaController extends Controller
{
    public function index()
    {
        $mgg = Magiamgia::where('tinhtrang','private')->get();
        $nd = Nguoidung::all();
        $chitietmagiamgia = Chitietmagiamgia::orderBy('id', 'asc')->get();
        return view("admin.pages.giamgia.chitietmagiamgia", compact('chitietmagiamgia', 'mgg', 'nd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nguoidungid' => 'required|exists:nguoidung,id',
            'magiamgiaid' => 'required|exists:magiamgias,id',
        ]);
        if ($request->ngayhethan) {
            $ngayhethan = Carbon::parse($request->ngayhethan);
            $today = Carbon::today();

            if ($ngayhethan->lessThan($today)) {
                return redirect()->route('admin.indexchitietmagiamgia')->with('err', 'Ngày hết hạn không được nhỏ hơn ngày hiện tại');
            }
        }
        $nhh = $request->ngayhethan == null ? now()->addDays(14) : $request->ngayhethan;


        try {
            $chitietmagiamgia = new ChitietMagiamgia();
            $chitietmagiamgia->nguoidungid = $request->nguoidungid;
            $chitietmagiamgia->magiamgiaid = $request->magiamgiaid;
            $chitietmagiamgia->ngayhethan = $nhh;
            $chitietmagiamgia->save();

            return redirect()->route('admin.indexchitietmagiamgia')->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexchitietmagiamgia')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nguoidungid' => 'required|exists:nguoidung,id',
            'magiamgiaid' => 'required|exists:magiamgias,id',
        ]);


        if ($request->ngayhethan) {
            $ngayhethan = Carbon::parse($request->ngayhethan);
            $today = Carbon::today();

            if ($ngayhethan->lessThan($today)) {
                return redirect()->route('admin.indexchitietmagiamgia')->with('err', 'Ngày hết hạn không được nhỏ hơn ngày hiện tại');
            }
        }
        $nhh = $request->ngayhethan == null ? now()->addDays(14) : $request->ngayhethan;

        try {
            $chitietmagiamgia = ChitietMagiamgia::findOrFail($id);
            $chitietmagiamgia->nguoidungid = $request->nguoidungid;
            $chitietmagiamgia->magiamgiaid = $request->magiamgiaid;
            $chitietmagiamgia->ngayhethan = $nhh;
            $chitietmagiamgia->save();

            return redirect()->route('admin.indexchitietmagiamgia')->with('suc', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexchitietmagiamgia')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $chitietmagiamgia = chitietmagiamgia::findOrFail($id);
            $chitietmagiamgia->delete();
            return redirect()->route('admin.indexchitietmagiamgia')->with('suc', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexchitietmagiamgia')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function storehangloat(Request $request)
    {
        $request->validate([
            'nguoidungid' => 'required',
            'magiamgiaid' => 'required|exists:magiamgias,id',
            'ngayhethan' => 'nullable|date_format:Y-m-d',
        ]);

        if ($request->ngayhethan) {
            $ngayhethan = Carbon::parse($request->ngayhethan);
            $today = Carbon::today();

            if ($ngayhethan->lessThan($today)) {
                return redirect()->route('admin.indexchitietmagiamgia')->with('err', 'Ngày hết hạn không được nhỏ hơn ngày hiện tại');
            }
        }

        $users = [];

        if ($request->nguoidungid === 'all') {
            $users = Nguoidung::all();
        } elseif ($request->nguoidungid === 'truocthang6') {
            $users = Nguoidung::whereMonth('created_at', '<', 6)->get();
        }

        foreach ($users as $user) {
            $chitietmagiamgia = new ChitietMagiamgia();
            $chitietmagiamgia->nguoidungid = $user->id;
            $chitietmagiamgia->magiamgiaid = $request->magiamgiaid;
            $chitietmagiamgia->ngayhethan = $request->ngayhethan ?? now()->addDays(14);
            $chitietmagiamgia->save();
        }

        return redirect()->route('admin.indexchitietmagiamgia')->with('suc', 'Thêm mới thành công!');
    }
}
