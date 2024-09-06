@extends('admin.index')
@section('title', 'kieudangbanphim')
@section('kieudangbanphim')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">kieudangbanphim</h1>
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
                            <th>ID</th>
                            <th>Tên kieudangbanphim</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kieudangbanphim as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            <td>{{$i->ten}}</td>
                            <td>
                                <button type="button" class="btn btn-info edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $i->id }}" data-ten="{{ $i->ten }}">Sửa</button>
                                <a href="{{ route('admin.deletekieudangbanphim', ['id' => $i->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
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
            <form id="addForm" method="post" action="{{ route('admin.storekieudangbanphim') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ten">Tên kieudangbanphim</label>
                        <input type="text" class="form-control" id="ten" name="ten">
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

<!-- Edit Modal -->
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
                        <label for="edit_ten">Tên kieudangbanphim</label>
                        <input type="text" class="form-control" id="edit_ten" name="ten">
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

@section('js(indexkieudangbanphim)')
<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var ten = $(this).data('ten');
            $('#edit_id').val(id);
            $('#edit_ten').val(ten);
            var actionUrl = '{{ route("admin.updatekieudangbanphim", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#editForm').attr('action', actionUrl);
        });
    });
</script>
@endsection
