@extends('admin.index')
@section('title', 'Sửa Nhà sản xuất')
@section('nsx(edit)')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h1 mb-2 text-gray-800">Sửa Nhà sản xuất</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="editForm" method="POST" action="{{ route('admin.updatensx', ['id' => $nsx->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="ten">Tên Nhà Sản Xuất</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="{{ $nsx->ten }}">
                </div>

                <div class="form-group">
                    <label for="diachi">Địa Chỉ</label>
                    <input type="text" class="form-control" id="diachi" name="diachi" value="{{ $nsx->diachi }}">
                </div>

                <div class="form-group">
                    <label for="sodienthoai">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="sodienthoai" name="sodienthoai" value="{{ $nsx->sodienthoai }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $nsx->email }}">
                </div>

                <div class="form-group">
                    <label for="imgnsx">Hình Ảnh (Logo)</label>
                    <input type="file" class="form-control-file" id="img" name="img">
                </div>
                @if($nsx->img)
                <div class="form-group">
                    <label for="current_imgnsx">Hình Ảnh Hiện Tại</label>
                    <img src="{{ asset('back-end/img/nsx/' . $nsx->img) }}" alt="Hình Ảnh nsx" style="max-width: 200px;">
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</div>

@endsection
