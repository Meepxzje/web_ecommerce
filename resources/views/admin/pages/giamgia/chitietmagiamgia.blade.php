@extends('admin.index')
@section('title', 'Quản lý mã giảm giá')
@section('chitietmagiamgia')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chi tiết mã giảm giá</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm từng mã
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal1">
            Thêm hàng loạt
        </button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Mã giảm giá</th>
                            <th>Người dùng</th>
                            <th>Ngày hết hạn</th>
                            <th>Đã sử dụng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($chitietmagiamgia as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->magiamgia->magiamgia }}</td>
                            <td>{{ $item->nguoidung->email }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->ngayhethan)) }}</td>
                            @if($item->dasudung==0)
                            <td>Chưa sử dụng</td>
                            @elseif($item->dasudung==1)
                            <td>Đã sử dụng</td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-info edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $item->id }}" data-magiamgiaid="{{ $item->magiamgiaid }}" data-nguoidungid="{{ $item->nguoidungid }}" data-ngayhethan="{{ $item->ngayhethan }}">Sửa</button>
                                <a href="{{ route('admin.deletechitietmagiamgia', ['id' => $item->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" action="{{ route('admin.storechitietmagiamgia') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nguoidungid">Người dùng</label>
                        <select class="form-control" id="nguoidungid" name="nguoidungid">
                            <option value="">Chọn người dùng</option>
                            @foreach($nd as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="magiamgiaid">Mã giảm giá</label>
                        <select class="form-control" id="magiamgiaid" name="magiamgiaid">
                            <option value="">Chọn mã giảm giá</option>
                            @foreach($mgg as $i)
                            <option value="{{ $i->id }}">{{ $i->magiamgia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ngayhethan">Ngày hết hạn</label>
                        <input type="date" class="form-control" id="ngayhethan" name="ngayhethan" placeholder="Mặc định là 14 ngày">
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




<!-- add modal 1 -->
<div class="modal fade" id="addModal1" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" action="{{ route('admin.storechitietmagiamgiahangloat') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="filter">Chọn gười dùng</label>
                        <select class="form-control" id="" name="nguoidungid">
                            <option value="all">Tất cả người dùng</option>
                            <option value="truocthang6">Người dùng đã tham gia trước tháng 6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="magiamgiaid">Mã giảm giá</label>
                        <select class="form-control" id="magiamgiaid" name="magiamgiaid">
                            <option value="">Chọn mã giảm giá</option>
                            @foreach($mgg as $i)
                            <option value="{{ $i->id }}">{{ $i->magiamgia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ngayhethan">Ngày hết hạn</label>
                        <input type="date" class="form-control" id="ngayhethan" name="ngayhethan" placeholder="Mặc định là 14 ngày">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn muốn thêm mã giảm giá cho tất cả người dùng không?')">Thêm cho tất cả</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="post" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_nguoidungid">Người dùng</label>
                        <select class="form-control" id="edit_nguoidungid" name="nguoidungid">
                            <option value="">Chọn người dùng</option>
                            @foreach($nd as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_magiamgiaid">Mã giảm giá</label>
                        <select class="form-control" id="edit_magiamgiaid" name="magiamgiaid">
                            <option value="">Chọn mã giảm giá</option>
                            @foreach($mgg as $i)
                            <option value="{{ $i->id }}">{{ $i->magiamgia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_ngayhethan">Ngày hết hạn (mặc định 14 ngày)</label>
                        <input type="date" class="form-control" id="edit_ngayhethan" name="ngayhethan" placeholder="Chọn ngày hết hạn">
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

@section('js(indexchitietmagiamgia)')
<script>
    $(document).ready(function() {

        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var magiamgiaid = $(this).data('magiamgiaid');
            var nguoidungid = $(this).data('nguoidungid');
            var ngayhethan = $(this).data('ngayhethan');

            $('#edit_id').val(id);
            $('#edit_magiamgiaid').val(magiamgiaid);
            $('#edit_nguoidungid').val(nguoidungid);
            $('#edit_ngayhethan').val(ngayhethan);

            var actionUrl = '{{ route("admin.updatechitietmagiamgia", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#editForm').attr('action', actionUrl);
        });
    });
</script>
@endsection
