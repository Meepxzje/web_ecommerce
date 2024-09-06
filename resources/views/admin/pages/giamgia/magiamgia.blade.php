@extends('admin.index')
@section('title', 'Quản lý mã giảm giá')
@section('magiamgia')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Mã giảm giá</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm mới
        </button>
    </div>
    <div class="mb-3">
        <a href="/admin/chitietmagiamgia">Thêm mã giảm giá cho khách hàng</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Mã giảm giá</th>
                            <th>Giảm giá</th>
                            <th>Số tiền giảm giá tối đa</th>
                            <th>Giá trị tối thiểu đơn hàng</th>
                            <th>Số lượng</th>
                            <th>Tình trạng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($magiamgia as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->magiamgia }}</td>
                            <td>
                                @if ($item->phantramgiamgia)
                                {{ number_format($item->phantramgiamgia)}}%
                                @elseif($item->giamtructiep)
                                {{ number_format($item->giamtructiep)}}VNĐ
                                @endif
                            </td>
                            <td>
                                @if ($item->sotiengiamgiatoida)
                                {{ number_format($item->sotiengiamgiatoida) }} VNĐ
                                @elseif($item->giamtructiep)
                                {{ number_format($item->giamtructiep)}}VNĐ
                                @endif
                            </td>
                            <td>
                                @if ($item->giatritoithieudonhang)
                                {{ number_format($item->giatritoithieudonhang) }} VNĐ
                                @endif
                            </td>
                            <td>{{ $item->soluong }}</td>
                            <td>{{ $item->tinhtrang }}</td>

                            <td>
                                <button type="button" class="btn btn-info edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $item->id }}" data-magiamgia="{{ $item->magiamgia }}" data-phantram="{{ $item->phantramgiamgia }}" data-sotien="{{ $item->sotiengiamgiatoida }}" data-donhang="{{ $item->giatritoithieudonhang }}" data-soluong="{{ $item->soluong }}" data-tinhtrang="{{ $item->tinhtrang }}">Sửa</button>
                                <a href="{{ route('admin.deletemagiamgia', ['id' => $item->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
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
            <form id="addForm" method="post" action="{{ route('admin.storemagiamgia') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="magiamgia">Mã giảm giá</label>
                        <input type="text" class="form-control" id="magiamgia" name="magiamgia">
                    </div>
                    <div class="form-group">
                        <label>Loại giảm giá</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="phantramCheck" name="phantramCheck" value="1">
                            <label class="form-check-label" for="phantramCheck">Phần trăm (%)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="tienGiamCheck" name="tienGiamCheck" value="1">
                            <label class="form-check-label" for="tienGiamCheck">Giảm trực tiếp (VNĐ)</label>
                        </div>
                    </div>
                    <div class="form-group" id="phantramGroup" style="display: none;">
                        <label for="phantramgiamgia">Phần trăm giảm giá</label>
                        <input type="number" class="form-control" id="phantramgiamgia" name="phantramgiamgia" min="0" max="100">
                    </div>
                    <div class="form-group" id="tienGiamGroup" style="display: none;">
                        <label for="tientruclamgiam">Giảm giá trực tiếp (VNĐ)</label>
                        <input type="number" class="form-control" id="tientruclamgiam" name="tientruclamgiam" min="0" max="500000000">
                    </div>
                    <div class="form-group">
                        <label for="sotiengiamgiatoida">Số tiền giảm giá tối đa</label>
                        <input type="number" class="form-control" id="sotiengiamgiatoida" name="sotiengiamgiatoida" disabled>
                    </div>
                    <div class="form-group">
                        <label for="giatritoithieudonhang">Giá trị tối thiểu đơn hàng</label>
                        <input type="number" class="form-control" id="giatritoithieudonhang" name="giatritoithieudonhang">
                    </div>
                    <div class="form-group">
                        <label for="soluong">Số lượng</label>
                        <input type="number" min="1" step="1" class="form-control" id="soluong" name="soluong">
                    </div>
                    <div class="mb-3">
                        <label for="tinhtrang" class="form-label">Tình trạng</label>
                        <select name="tinhtrang" class="form-control form-control-sm" style="width: 500px;">
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                        </select>
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
                        <label for="edit_magiamgia">Mã giảm giá</label>
                        <input type="text" class="form-control" id="edit_magiamgia" name="magiamgia">
                    </div>
                    <div class="form-group">
                        <label for="edit_phantram">Phần trăm giảm giá</label>
                        <input type="number" class="form-control" id="edit_phantram" name="phantramgiamgia" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="edit_sotien">Số tiền giảm giá tối đa</label>
                        <input type="number" class="form-control" id="edit_sotien" name="sotiengiamgiatoida">
                    </div>
                    <div class="form-group">
                        <label for="edit_donhang">Giá trị tối thiểu đơn hàng</label>
                        <input type="number" class="form-control" id="edit_donhang" name="giatritoithieudonhang">
                    </div>
                    <div class="form-group">
                        <label for="soluong">Số lượng</label>
                        <input type="number" min="1" step="1" class="form-control" id="edit_soluong" name="soluong">
                    </div>
                    <div class="mb-3">
                        <label for="tinhtrang" class="form-label">Tình trạng</label>
                        <select name="tinhtrang" id="edit_tinhtrang" class="form-control form-control-sm" style="width: 500px;">
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                        </select>
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

<script>

</script>



@endsection

@section('js(indexmagiamgia)')
<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var magiamgia = $(this).data('magiamgia');
            var phantram = $(this).data('phantram');
            var sotien = $(this).data('sotien');
            var donhang = $(this).data('donhang');
            var soluong = $(this).data('soluong')
            var tinhtrang = $(this).data('tinhtrang')
            $('#edit_id').val(id);
            $('#edit_magiamgia').val(magiamgia);
            $('#edit_phantram').val(phantram);
            $('#edit_sotien').val(sotien);
            $('#edit_donhang').val(donhang);
            $('#edit_soluong').val(soluong);
            $('#edit_tinhtrang').val(tinhtrang);
            var actionUrl = '{{ route("admin.updatemagiamgia", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#editForm').attr('action', actionUrl);
        });


        $('#phantramCheck').change(function() {
            if ($(this).is(':checked')) {
                $('#tienGiamCheck').prop('checked', false);
                $('#tienGiamGroup').hide();
                $('#tientruclamgiam').prop('disabled', true).val('').attr('placeholder', '');
                $('#phantramGroup').show();
                $('#phantramgiamgia').prop('disabled', false).attr('placeholder', 'Nhập % giảm giá');
                $('#sotiengiamgiatoidaGroup').show();
                $('#sotiengiamgiatoida').prop('disabled', false).attr('placeholder', 'Nhập số tiền giảm giá tối đa');
            } else {
                $('#phantramGroup').hide();
                $('#phantramgiamgia').prop('disabled', true).val('').attr('placeholder', '');
                $('#sotiengiamgiatoidaGroup').hide();
                $('#sotiengiamgiatoida').prop('disabled', true).val('').attr('placeholder', '');
            }
        });

        $('#tienGiamCheck').change(function() {
            if ($(this).is(':checked')) {
                $('#phantramCheck').prop('checked', false);
                $('#phantramGroup').hide();
                $('#phantramgiamgia').prop('disabled', true).val('').attr('placeholder', '');
                $('#sotiengiamgiatoidaGroup').hide();
                $('#sotiengiamgiatoida').prop('disabled', true).val('').attr('placeholder', '');
                $('#tienGiamGroup').show();
                $('#tientruclamgiam').prop('disabled', false).attr('placeholder', 'Nhập số tiền giảm trực tiếp (VNĐ)');
            } else {
                $('#tienGiamGroup').hide();
                $('#tientruclamgiam').prop('disabled', true).val('').attr('placeholder', '');
            }
        });
    });
</script>
@endsection
