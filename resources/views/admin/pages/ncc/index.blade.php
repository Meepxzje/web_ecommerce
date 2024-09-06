@extends('admin.index')
@section('title', 'Nhà Cung Cấp')
@section('ncc(index)')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h1 mb-2 text-gray-800">Nhà Cung Cấp</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm mới
        </button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID Nhà Cung Cấp</th>
                            <th>Tên Nhà Cung Cấp</th>
                            <th>Địa chỉ</th>
                            <th>Số điện Thoại</th>
                            <th>Email</th>
                            <th>Hình ảnh (logo)</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($ncc as $ncc)
                        <tr>
                            <td>{{$ncc->id}}</td>
                            <td>{{$ncc->ten}}</td>
                            <td>{{$ncc->diachi}}</td>
                            <td>{{$ncc->sodienthoai}}</td>
                            <td>{{$ncc->email}}</td>
                            <td><img src="{{ asset('back-end/img/ncc/' . $ncc->img) }}" alt="Image" width="50"></td>
                            <td>
                                <a href="{{ route('admin.editncc', ['id' => $ncc->id]) }}" class="btn btn-info">Sửa</a>
                                <a href="{{ route('admin.deletencc', ['id' => $ncc->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới Nhà cung cấp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" action="{{ route('admin.storencc') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ten">Tên Nhà cung cấp:</label>
                        <input type="text" class="form-control" id="ten" name="ten">
                    </div>
                    <div class="form-group">
                        <label for="diachi">Địa chỉ:</label>
                        <input type="text" class="form-control" id="diachi" name="diachi">
                    </div>
                    <div class="form-group">
                        <label for="sodienthoai">Số điện thoại:</label>
                        <input type="text" class="form-control" id="sodienthoai" name="sodienthoai">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="img">Hình ảnh (logo):</label>
                        <input type="file" class="form-control-file" id="img" name="img">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('suc'))
<div id="alertBox" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    {{ session('suc') }}
</div>

<script>
    setTimeout(function() {
        $('#alertBox').alert('close');
    }, 5000);
</script>
@php
session()->forget('suc');
@endphp
@endif
@if(session('err'))
<div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    {{ session('err') }}
</div>
<script>
    setTimeout(function() {
        $('#alertBox').alert('close');
    }, 5000);
</script>
@php
session()->forget('err');
@endphp
@endif
@endsection
