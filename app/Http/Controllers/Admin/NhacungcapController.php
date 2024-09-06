<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nhacungcap;
use Illuminate\Http\Request;

class NhacungcapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ncc = Nhacungcap::all();
        return view("admin.pages.ncc.index", ['ncc' => $ncc]);
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
                $image->move(public_path('/back-end/img/ncc'), $imageName);
                $validatedData['img'] = $imageName;
            } else {
                return redirect()->back()->with('err', 'Tải ảnh không thành công. Vui lòng thử lại.');
            }
            Nhacungcap::create($validatedData);
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
        $ncc = Nhacungcap::find($id);
        return view("admin.pages.ncc.edit", ['ncc' => $ncc]);
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
            $ncc = Nhacungcap::find($id);
            if (!$ncc) {
                return redirect()->route('admin.indexncc')->with('err', 'Không tìm thấy');
            }
            if ($request->hasFile('img')) {
                $imagePath = public_path('back-end/img/ncc/' . $ncc->img);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/back-end/img/ncc'), $imageName);
                $ncc->img = $imageName;
            }
            $ncc->ten = $request->ten;
            $ncc->diachi = $request->diachi;
            $ncc->sodienthoai = $request->sodienthoai;
            $ncc->email = $request->email;
            $ncc->update_at->now();
            $ncc->save();
            return redirect()->route('admin.indexncc')->with('suc', 'Đã cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexncc')->with('err', 'Không thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ncc = Nhacungcap::find($id);
        if (!$ncc) {
            return redirect()->route('admin.indexncc')->with('err', 'Không tìm thấy');
        }

        try {
            if ($ncc->img) {
                $imagePath = public_path('back-end/img/ncc/' . $ncc->img);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $ncc->delete();
            return redirect()->route('admin.indexncc')->with('suc', 'Đã xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.indexncc')->with('err', 'Không thành công!');
        }
    }
}
