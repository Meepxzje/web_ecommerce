@extends('admin.index')
@section('title', 'Sửa Nhà Cung Cấp')
@section('ncc(edit)')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h1 mb-2 text-gray-800">Sửa Nhà Cung Cấp</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="editForm" method="POST" action="{{ route('admin.updatencc', ['id' => $ncc->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="ten">Tên Nhà Sản Xuất</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="{{ $ncc->ten }}">
                </div>

                <div class="form-group">
                    <label for="diachi">Địa Chỉ</label>
                    <input type="text" class="form-control" id="diachi" name="diachi" value="{{ $ncc->diachi }}">
                </div>

                <div class="form-group">
                    <label for="sodienthoai">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="sodienthoai" name="sodienthoai" value="{{ $ncc->sodienthoai }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $ncc->email }}">
                </div>

                <div class="form-group">
                    <label for="imgncc">Hình Ảnh (Logo)</label>
                    <input type="file" class="form-control-file" id="img" name="img">
                </div>
                @if($ncc->img)
                <div class="form-group">
                    <label for="current_imgncc">Hình Ảnh Hiện Tại</label>
                    <img src="{{ asset('back-end/img/ncc/' . $ncc->img) }}" alt="Hình Ảnh ncc" style="max-width: 200px;">
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</div>

@endsection
