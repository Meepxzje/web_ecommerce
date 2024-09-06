@extends('admin.index')
@section('title', 'Phí Vận Chuyển')
@section('pvc')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Phí Vận Chuyển</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm mới
        </button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Tỉnh, Thành phố</th>
                            <th>Phí</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($pvc as $i)
                        <tr>
                            <td>{{ $i->thanhpho->name }}</td>
                            <td>{{ $i->phivanchuyen }}</td>
                            <td>
                                <a href="{{ route('admin.deletepvc', ['id' => $i->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" action="{{ route('admin.storepvc') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="matp">Thành phố:</label>
                        <select class="form-control" id="matp" name="matp">
                            @foreach($thanhphos as $thanhpho)
                            <option value="{{ $thanhpho->matp }}">{{ $thanhpho->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phivanchuyen">Phí Vận Chuyển:</label>
                        <input type="text" class="form-control" id="phivanchuyen" name="phivanchuyen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
