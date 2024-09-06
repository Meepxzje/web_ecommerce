<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nhasanxuat;
use Illuminate\Http\Request;

class NhasanxuatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nsx = Nhasanxuat::all();
        return view("admin.pages.nsx.index", ['nsx' => $nsx]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
            'diachi' => 'required|string|max:191',
            'sodienthoai' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            // 'img' => 'required|image|mimes:jpeg,PNG,jpg,gif,svg|max:2048',
        ]);
        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $originalName = $image->getClientOriginalName();
                $filteredName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                $extension = $image->getClientOriginalExtension();
                $imageName = $filteredName . '.' . $extension;
                $image->move(public_path('/back-end/img/nsx'), $imageName);
                $validatedData['img'] = $imageName;
            } else {
                return redirect()->back()->with('err', 'Tải ảnh không thành công. Vui lòng thử lại.');
            }
            Nhasanxuat::create($validatedData);
            return redirect()->back()->with('suc', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('err', 'Đã có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nsx = Nhasanxuat::find($id);
        return view("admin.pages.nsx.edit", ['nsx' => $nsx]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:191',
            'diachi' => 'required|string|max:191',
            'sodienthoai' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $nsx = Nhasanxuat::find($id);
            if (!$nsx) {
                return redirect()->route('admin.indexnsx')->with('err', 'Không tìm thấy');
            }
            if ($request->hasFile('img')) {
                $imagePath = public_path('back-end/img/nsx/' . $nsx->img);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/back-end/img/nsx'), $imageName);
                $nsx->img = $imageName;
            }
            $nsx->ten = $request->ten;
            $nsx->diachi = $request->diachi;
            $nsx->sodienthoai = $request->sodienthoai;
            $nsx->email = $request->email;
            $nsx->save();
            return redirect()->route('admin.indexnsx')->with('suc', 'Đã cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexnsx')->with('err', 'Không thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nsx = Nhasanxuat::find($id);
        if (!$nsx) {
            return redirect()->route('admin.indexnsx')->with('err', 'Không tìm thấy');
        }

        try {
            if ($nsx->img) {
                $imagePath = public_path('back-end/img/nsx/' . $nsx->img);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $nsx->delete();
            return redirect()->route('admin.indexnsx')->with('suc', 'Đã xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexnsx')->with('err', 'Không thành công!');
        }
    }
}
