<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chitietmagiamgia;
use App\Models\Magiamgia;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagiamgiaController extends Controller
{
    public function index()
    {
        $magiamgia = Magiamgia::all();
        return view("admin.pages.giamgia.magiamgia", compact('magiamgia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'magiamgia' => 'required|unique:magiamgias,magiamgia',
            'phantramgiamgia' => 'nullable|numeric|min:0|max:100',
            'sotiengiamgiatoida' => 'nullable|numeric|min:0',
            'giatritoithieudonhang' => 'nullable|numeric|min:0',
            'soluong' => 'nullable|numeric|min:1',
        ]);

        $magiamgiaData = [
            'magiamgia' => $request->magiamgia,
            'tinhtrang' => $request->tinhtrang,
            'soluong' =>  $request->soluong,
        ];
        if ($request->phantramCheck) {
            $magiamgiaData['phantramgiamgia'] = $request->phantramgiamgia;
            $magiamgiaData['sotiengiamgiatoida'] = $request->sotiengiamgiatoida;
        } elseif ($request->tienGiamCheck) {
            $magiamgiaData['giamtructiep'] = $request->tientruclamgiam;
        }
        if ($request->giatritoithieudonhang) {
            $magiamgiaData['giatritoithieudonhang'] = $request->giatritoithieudonhang;
        }

        try {
            Magiamgia::create($magiamgiaData);
            return redirect()->route('admin.indexmagiamgia')->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexmagiamgia')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'magiamgia' => 'required|unique:magiamgias,magiamgia,' . $id,
            'phantramgiamgia' => 'nullable|numeric|min:0|max:100',
            'sotiengiamgiatoida' => 'nullable|numeric|min:0',
            'giatritoithieudonhang' => 'nullable|numeric|min:0',
            'soluong' => 'nullable|numeric|min:1',
            'tinhtrang' => 'nullable|max:100',
        ]);
        try {
            $magiamgia = Magiamgia::findOrFail($id);
            $magiamgia->update($validatedData);
            return redirect()->route('admin.indexmagiamgia')->with('suc', 'Sửa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexmagiamgia')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $magiamgia = Magiamgia::findOrFail($id);
            $magiamgia->delete();
            return redirect()->route('admin.indexmagiamgia')->with('suc', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexmagiamgia')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function nhanmgg($id)
    {
        $u = Auth::user();
        try{
            Chitietmagiamgia::create([
                'nguoidungid' => $u->id,
                'magiamgiaid' => $id,
                'ngayhethan' => Carbon::today()->addDay(7),
                'dasudung' => 0,
            ]);

            $mgg = Magiamgia::find($id);

            if($mgg)
            {
                $mgg->decrement('soluong',1);

            }
            return redirect()->route('index')->with('suc', 'Đã nhận');
        }
        catch(Exception $e)
        {
            return redirect()->route('index')->with('err', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }



}
