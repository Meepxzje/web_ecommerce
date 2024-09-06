@extends('admin.index')
@section('title', 'Sản phẩm đang giảm giá')
@section('spdanggiam')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="toggleOrders('giamtucuahang')">Giảm từ cửa hàng</button>
        <button type="button" class="btn btn-primary" onclick="toggleOrders('giamtuhang')">Giảm từ hãng</button>
    </div>


    <div class="card shadow mb-4" id="giamtucuahang">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Giá giảm</th>
                            <th>Trạng thái</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Số lượng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($gg as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            <td style="max-width:400px;">{{$i->sanphamid}}, {{$i->sanpham->ten}}</td>
                            <td>{{$i->giagiam}}</td>
                            <td>{{$i->danggiam}}</td>
                            <td>{{$i->ngaybatdau}}</td>
                            <td>{{$i->ngayketthuc}}</td>
                            <td>{{$i->soluongsanpham}}</td>
                            <td>
                                <button type="button" class="btn btn-info edit-button" data-toggle="modal" data-target="#editModal" data-id="{{$i->id}}" data-sanphamid="{{$i->sanphamid}}"
                                    data-giamgia="{{$i->giagiam}}" data-danggiam="{{$i->danggiam}}" data-ngaybatdau="{{$i->ngaybatdau}}" data-ngayketthuc="{{$i->ngayketthuc}}" data-soluongsanpham="{{$i->soluongsanpham}}">Sửa</button>
                                <a href="{{ route('admin.deletespdanggiam', ['id' => $i->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4" id="giamtuhang" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Phần trăm giảm giá</th>
                            <th>Giảm tối đa</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($gghl as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            <td style="max-width:400px;">{{$i->sanphamid}}, {{$i->sanpham->ten}}</td>
                            <td>{{number_format($i->phantramgiamgia)}}%</td>
                            <td>{{number_format($i->giamtoida)}}đ</td>
                            <td>{{$i->ngaybatdau}}</td>
                            <td>{{$i->ngayketthuc}}</td>
                            <td>{{$i->soluongsanpham}}</td>
                            <td>{{$i->tinhtrang}}</td>
                            <td>
                                <button type="button" class="btn btn-info edit-buttonhl" data-toggle="modal" data-target="#editModalhl" data-id="{{$i->id}}" data-sanphamid="{{$i->sanphamid}}"
                                    data-phantramgiamgia="{{$i->phantramgiamgia}}" data-giamtoida="{{$i->giamtoida}}" data-ngaybatdau="{{$i->ngaybatdau}}" data-ngayketthuc="{{$i->ngayketthuc}}"
                                    data-soluongsanpham="{{$i->soluongsanpham}}" data-tinhtrang="{{$i->tinhtrang}}">Sửa</button>
                                <a href="{{ route('admin.deletespdanggiamhl', ['id' => $i->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Chỉnh sửa Sản phẩm</h5>
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
                            <label for="edit_sanphamid">ID sản phẩm</label>
                            <input type="text" class="form-control" id="edit_sanphamid" name="sanphamid" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_giagiam">Giá giảm</label>
                            <input type="number" class="form-control" id="edit_giagiam" name="giagiam">
                        </div>

                        <div class="form-group">
                            <label for="edit_ngaybatdau">Ngày băt đầu</label>
                            <input type="date" class="form-control" id="edit_ngaybatdau" name="ngaybatdau">
                        </div>
                        <div class="form-group">
                            <label for="edit_ngayketthuc">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="edit_ngayketthuc" name="ngayketthuc">
                        </div>

                        <div class="form-group">
                            <label for="edit_soluongsanpham">Số lượng sản phẩm còn</label>
                            <input type="text" class="form-control" id="edit_soluongsanpham" name="soluongsanpham">
                        </div>

                        <div class="form-group">
                            <label for="edit_danggiam">Trạng thái</label>
                            <input type="text" class="form-control" id="edit_danggiam" name="danggiam" readonly>
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

    <div class="modal fade" id="editModalhl" tabindex="-1" role="dialog" aria-labelledby="editModalLabelhl" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Chỉnh sửa Sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm1" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_idhl" name="id">
                        <div class="form-group">
                            <label for="edit_sanphamid">ID sản phẩm</label>
                            <input type="text" class="form-control" id="edit_sanphamidhl" name="sanphamid" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_giagiam">Phần trăm giảm giá</label>
                            <input type="number" class="form-control" id="edit_phantramgiamgiahl" name="phantramgiamgia">
                        </div>
                        <div class="form-group">
                            <label for="edit_giagiam">Giảm tối đa</label>
                            <input type="number" class="form-control" id="edit_giamtoidahl" name="giamtoida">
                        </div>

                        <div class="form-group">
                            <label for="edit_ngaybatdau">Ngày băt đầu</label>
                            <input type="date" class="form-control" id="edit_ngaybatdauhl" name="ngaybatdau">
                        </div>
                        <div class="form-group">
                            <label for="edit_ngayketthuc">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="edit_ngayketthuchl" name="ngayketthuc">
                        </div>

                        <div class="form-group">
                            <label for="edit_soluongsanpham">Số lượng sản phẩm còn</label>
                            <input type="text" class="form-control" id="edit_soluongsanphamhl" name="soluongsanpham">
                        </div>

                        <div class="form-group">
                            <label for="edit_danggiam">Trạng thái</label>
                            <input type="text" class="form-control" id="edit_tinhtranghl" name="tinhtrang" readonly>
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
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function toggleDetails(orderId) {
        var detailsRow = document.getElementById('details-row-' + orderId);
        if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
            detailsRow.style.display = 'table-row';
        } else {
            detailsRow.style.display = 'none';
        }
    }

    function toggleOrders(status) {
        var orders = document.querySelectorAll('.card');
        for (var i = 0; i < orders.length; i++) {
            orders[i].style.display = 'none';
        }
        document.getElementById(status).style.display = 'block';
    }
</script>


<script>
    $('.edit-button').on('click', function() {

        var id = $(this).data('id');
        var sanphamid = $(this).data('sanphamid');
        var giamgia = $(this).data('giamgia');
        var danggiam = $(this).data('danggiam');
        var ngaybatdau = $(this).data('ngaybatdau');
        var ngayketthuc = $(this).data('ngayketthuc');
        var soluongsanpham = $(this).data('soluongsanpham');


        $('#edit_id').val(id);
        $('#edit_sanphamid').val(sanphamid);
        $('#edit_giagiam').val(giamgia);
        $('#edit_danggiam').val(danggiam);
        $('#edit_ngaybatdau').val(ngaybatdau);
        $('#edit_ngayketthuc').val(ngayketthuc);
        $('#edit_soluongsanpham').val(soluongsanpham);

        var actionUrl = '{{ route("admin.updatespdanggiam", ":id") }}';
        actionUrl = actionUrl.replace(':id', id);
        $('#editForm').attr('action', actionUrl);
    });


    $('.edit-buttonhl').on('click', function() {

        var id = $(this).data('id');
        var sanphamid = $(this).data('sanphamid');
        var phantramgiamgia = $(this).data('phantramgiamgia');
        var giamtoida = $(this).data('giamtoida');
        var ngaybatdau = $(this).data('ngaybatdau');
        var ngayketthuc = $(this).data('ngayketthuc');
        var soluongsanpham = $(this).data('soluongsanpham');
        var tinhtrang = $(this).data('tinhtrang');



        $('#edit_idhl').val(id);
        $('#edit_sanphamidhl').val(sanphamid);
        $('#edit_phantramgiamgiahl').val(phantramgiamgia);
        $('#edit_giamtoidahl').val(giamtoida);
        $('#edit_ngaybatdauhl').val(ngaybatdau);
        $('#edit_ngayketthuchl').val(ngayketthuc);
        $('#edit_soluongsanphamhl').val(soluongsanpham);
        $('#edit_tinhtranghl').val(tinhtrang);


        var actionUrl = '{{ route("admin.updatespdanggiamhl", ":id") }}';
        actionUrl = actionUrl.replace(':id', id);
        $('#editForm1').attr('action', actionUrl);
    });
</script>



@endsection
