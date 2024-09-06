@extends('admin.index')
@section('title', 'Quản lý tài khoản')
@section('qltaikhoan')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tài khoản</h1>
    <div class="mb-3">
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm mới
        </button> -->
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>SDT</th>
                            <th>Địa chỉ</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($tk as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            <td>{{$i->ten}}</td>
                            <td>{{$i->email}}</td>
                            <td>{{$i->sodienthoai}}</td>
                            <td>{{$i->diachi}}, {{$i->xaphuong->name??0}}, {{$i->quanhuyen->name??0}}, {{$i->thanhpho->name??0}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
