@extends('admin.index')
@section('title', 'Sản Phẩm')
@section('sp(index)')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Sản Phẩm</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm mới
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBulkDiscountModal">
            Giảm giá hàng loạt
        </button>
        <a href="{{route('admin.spdanggiam')}}">Sản phẩm đang giảm</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <!-- <th>Mô tả</th> -->
                            <th>Danh mục</th>
                            <th>Nhà cung cấp</th>
                            <th>Nhà sản xuất</th>
                            <th>Số lượng trong kho</th>
                            <th>Đã bán</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($sp as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            <td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"> <a href="{{ route('chitietsp', ['id' => $i->id]) }}" style="color: black;" target="_blank">{{$i->ten}}</a></td>
                            <td style="max-width:170px;overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                @if($i->giamgiahangloat !=null && $i->giamgiahangloat->tinhtrang==1)
                                @php
                                $a = $i->giamgiahangloat->phantramgiamgia * $i->gia / 100;
                                $giam = $a > $i->giamgiahangloat->giamtoida ? $i->giamgiahangloat->giamtoida : $a;
                                @endphp
                                @endif
                                @if (($i->giamgia !=null && $i->giamgiahangloat !=null) && $i->giamgia->danggiam == 1 && $i->giamgiahangloat->tinhtrang==1 && $i->giamgia->soluongsanpham >0  && $i->giamgiahangloat->soluongsanpham >0 )
                                <span style="text-decoration: line-through">{{number_format($i->gia)}}</span><br>
                                <span>-{{ number_format($i->giamgia->giagiam)}} (từ cửa hàng)</span><br>
                                <span>-{{ number_format($giam)}} (ưu đãi nsx)</span><br>
                                <span style="color: red;">{{ number_format($i->gia - $i->giamgia->giagiam - $giam) }}</span>
                                @elseif($i->giamgia && $i->giamgia->danggiam == 1 && $i->giamgia->soluongsanpham >0 )
                                <span style="text-decoration: line-through">{{ number_format($i->gia) }}</span><br>
                                <span>-{{ number_format($i->giamgia->giagiam)}} (từ cửa hàng)</span><br>
                                <span style="color: red;">{{ number_format($i->gia - $i->giamgia->giagiam ) }}</span>
                                @elseif($i->giamgiahangloat && $i->giamgiahangloat->tinhtrang==1 && $i->giamgiahangloat->soluongsanpham >0)
                                <span style="text-decoration: line-through">{{ number_format($i->gia) }}</span><br>
                                <span>-{{ number_format($giam)}} (ưu đãi nsx)</span><br>
                                <span style="color: red;">{{ number_format($i->gia - $giam) }}</span>
                                @else
                                {{ number_format($i->gia) }}
                                @endif
                            </td>
                            <!-- <td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$i->mota}}</td> -->
                            <td>{{$i->danhmuc->ten}}</td>
                            <td>{{$i->nhacungcap->ten}}</td>
                            <td>{{$i->nhasanxuat->ten}}</td>
                            <td>{{$i->soluong}}</td>
                            <td>{{$i->daban}}</td>
                            <td>
                                @if($i->hinhanhsanphams)
                                @foreach($i->hinhanhsanphams as $hinhanh)
                                <img src="{{ asset('back-end/img/sp/' . $hinhanh->img) }}" alt="Image" width="50">
                                @endforeach
                                @endif
                            </td>
                            <td style="max-width:200px;">
                                <button type="button" class="btn btn-info edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $i->id }}" data-ten="{{ $i->ten }}" data-gia="{{ $i->gia }}" data-mota="{{ $i->mota }}" data-soluong="{{ $i->soluong }}" data-daban="{{ $i->daban }}" data-dm="{{ $i->danhmucid }}" data-ncc="{{ $i->nhacungcapid }}" data-nsx="{{ $i->nhasanxuatid }}" data-images='@json($i->hinhanhsanphams)'>Sửa</button>
                                <a href="{{ route('admin.deletesp', ['id' => $i->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                                <a href="{{ route('admin.thongsosp', ['id' => $i->id]) }}" class="btn btn-success">Cập nhật thông số</a>
                                <button type="button" class="btn btn-info add-gift-button" data-toggle="modal" data-target="#addGiftModal" data-id="{{ $i->id }}" data-ten="{{ $i->ten }}">Thêm Quà Tặng</button>
                                <button type="button" class="btn btn-info add-discount-button" data-toggle="modal" data-target="#addDiscountModal" data-id="{{ $i->id }}" data-ten="{{ $i->ten }}">Giảm giá sản phẩm</button>

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
                <h5 class="modal-title" id="addModalLabel">Thêm mới Sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" action="{{ route('admin.storesp') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ten">Tên Sản phẩm:</label>
                        <input type="text" class="form-control" id="ten" name="ten">
                    </div>
                    <div class="form-group">
                        <label for="gia">Giá</label>
                        <input type="number" class="form-control" id="gia" name="gia">
                    </div>
                    <div class="form-group">
                        <label for="mota">Mô tả</label>
                        <input type="text" class="form-control" id="mota" name="mota">
                    </div>
                    <div class="form-group">
                        <label for="soluong">Số lượng</label>
                        <input type="text" class="form-control" id="soluong" name="soluong">
                    </div>
                    <input type="hidden" class="form-control" id="daban" name="daban" value="0">
                    <div class="mb-3">
                        <label for="danhmuc" class="form-label">Danh mục:</label>
                        <select name="dm" class="form-control form-control-sm" style="width: 500px;">
                            @foreach($dm as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nhacungcap" class="form-label">Nhà Cung Cấp:</label>
                        <select name="ncc" class="form-control form-control-sm" style="width: 500px;">
                            @foreach($ncc as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nhasanxuat" class="form-label">Nhà Sản Xuất:</label>
                        <select name="nsx" class="form-control form-control-sm" style="width: 500px;">
                            @foreach($nsx as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="imageContainer">
                        <label for="image1">Chọn ảnh:</label>
                        <input type="file" class="form-control-file" id="image1" name="images[]">
                    </div>
                    <button type="button" class="btn btn-primary" id="addImageButton">Thêm ảnh</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
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
                        <label for="edit_ten">Tên Sản phẩm:</label>
                        <input type="text" class="form-control" id="edit_ten" name="ten">
                    </div>
                    <div class="form-group">
                        <label for="edit_gia">Giá</label>
                        <input type="number" class="form-control" id="edit_gia" name="gia">
                    </div>
                    <div class="form-group">
                        <label for="edit_mota">Mô tả</label>
                        <input type="text" class="form-control" id="edit_mota" name="mota">
                    </div>
                    <div class="form-group">
                        <label for="edit_soluong">Số lượng</label>
                        <input type="text" class="form-control" id="edit_soluong" name="soluong">
                    </div>
                    <input type="hidden" id="edit_daban" name="daban">
                    <div class="mb-3">
                        <label for="edit_dm" class="form-label">Danh mục:</label>
                        <select name="dm" class="form-control form-control-sm" id="edit_dm" style="width: 500px;">
                            @foreach($dm as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_ncc" class="form-label">Nhà Cung Cấp:</label>
                        <select name="ncc" class="form-control form-control-sm" id="edit_ncc" style="width: 500px;">
                            @foreach($ncc as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nsx" class="form-label">Nhà Sản Xuất:</label>
                        <select name="nsx" class="form-control form-control-sm" id="edit_nsx" style="width: 500px;">
                            @foreach($nsx as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh hiện tại:</label>
                        <div id="current_images" class="d-flex flex-wrap"></div>
                    </div>
                    <div class="form-group" id="imageContainerEdit">
                        <label for="image1Edit">Chọn ảnh mới:</label>
                        <input type="file" class="form-control-file" id="image1Edit" name="images[]">
                    </div>
                    <button type="button" class="btn btn-primary" id="addImageButtonEdit">Thêm ảnh</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Gift Modal -->
<!-- Modal -->
<div class="modal fade" id="addGiftModal" tabindex="-1" role="dialog" aria-labelledby="addGiftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGiftModalLabel">Thêm Quà Tặng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addGiftForm" action="{{ route('saveGift') }}" method="POST">
                    @csrf
                    <input type="hidden" id="sanphamid" name="sanphamid">
                    <div id="giftOptions"></div>
                    <div id="additionalGifts"></div>

                    <button type="button" class="btn btn-info" id="addGiftButton">Thêm quà tặng</button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Discount Modal -->
<div class="modal fade" id="addDiscountModal" tabindex="-1" role="dialog" aria-labelledby="addDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDiscountModalLabel">Thêm Giảm Giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary active" id="discount-tab">
                        <input type="radio" name="options" autocomplete="off" checked> Giảm Giá
                    </label>
                    <label class="btn btn-secondary" id="bulk-discount-tab">
                        <input type="radio" name="options" autocomplete="off"> Ưu Đãi
                    </label>
                </div>
                <form id="addDiscountForm" action="{{ route('sanpham.addDiscount') }}" method="POST">
                    @csrf
                    <input type="hidden" id="sanphamId" name="sanphamid">
                    <div class="form-group">
                        <label for="giagiam">Giá Giảm</label>
                        <input type="number" class="form-control" id="giagiam" name="giagiam" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaybatdau">Ngày Bắt Đầu</label>
                        <input type="date" class="form-control" id="ngaybatdau" name="ngaybatdau">
                    </div>
                    <div class="form-group">
                        <label for="ngayketthuc">Ngày Kết Thúc</label>
                        <input type="date" class="form-control" id="ngayketthuc" name="ngayketthuc">
                    </div>
                    <div class="form-group">
                        <label for="soluongsanpham">Số Lượng Sản Phẩm</label>
                        <input type="number" class="form-control" id="soluongsanpham" name="soluongsanpham">
                    </div>
                    <div class="form-group">
                        <label for="danggiam">Đang Giảm Giá</label>
                        <select class="form-control" id="danggiam" name="danggiam" disabled>
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                            <option value="2">Sắp giảm</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>


                <form id="addBulkDiscountForm1" action="" method="POST" style="display: none;">
                    @csrf
                    <div class="form-group">
                        <label for="phantramgiamgia">Phần Trăm Giảm Giá</label>
                        <input type="number" class="form-control" id="phantramgiamgia" name="phantramgiamgia" min="0" max="100" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="giamtoida">Giảm Tối Đa</label>
                        <input type="number" class="form-control" id="giamtoida" name="giamtoida" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="ngaybatdau">Ngày Bắt Đầu</label>
                        <input type="date" class="form-control" id="ngaybatdau_bulk" name="ngaybatdau" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="ngayketthuc">Ngày Kết Thúc</label>
                        <input type="date" class="form-control" id="ngayketthuc_bulk" name="ngayketthuc" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="soluongsanpham">Số Lượng Sản Phẩm</label>
                        <input type="number" class="form-control" id="soluongsanpham_bulk" name="soluongsanpham" required readonly>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addBulkDiscountModal" tabindex="-1" role="dialog" aria-labelledby="addBulkDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBulkDiscountModalLabel">Thêm Giảm Giá Hàng Loạt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBulkDiscountForm" action="{{ route('sanpham.addBulkDiscount') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nsx">Nhà sản xuất</label>
                        <select name="nsx" id="nsx" class="form-control" required>
                            @foreach($nsx as $i)
                            <option value="{{ $i->id }}">{{ $i->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="danhmuc">Danh mục</label>
                        <select name="danhmuc" id="danhmuc" class="form-control" required>
                            @foreach($dm as $i)
                            <option value="{{ $i->id }}">{{ $i->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phantramgiamgia">Phần Trăm Giảm Giá</label>
                        <input type="number" class="form-control" id="phantramgiamgia" name="phantramgiamgia" min="0" max="100" required>
                    </div>
                    <div class="form-group">
                        <label for="giamtoida">Giảm Tối Đa</label>
                        <input type="number" class="form-control" id="giamtoida" name="giamtoida" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaybatdau">Ngày Bắt Đầu</label>
                        <input type="date" class="form-control" id="ngaybatdau" name="ngaybatdau" required>
                    </div>
                    <div class="form-group">
                        <label for="ngayketthuc">Ngày Kết Thúc</label>
                        <input type="date" class="form-control" id="ngayketthuc" name="ngayketthuc" required>
                    </div>
                    <div class="form-group">
                        <label for="soluongsanpham">Số Lượng Sản Phẩm</label>
                        <input type="number" class="form-control" id="soluongsanpham" name="soluongsanpham" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>









@endsection


@section('js(indexsp)')
<script>
    $(document).ready(function() {
        var imageCount = 1;
        $('#addImageButton').click(function() {
            imageCount++;
            var newInput = '<div class="form-group"><label for="image' + imageCount + '">Chọn ảnh:</label><input type="file" class="form-control-file" id="image' + imageCount + '" name="images[]"></div>';
            $('#imageContainer').append(newInput);
        });

        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var ten = $(this).data('ten');
            var gia = $(this).data('gia');
            var mota = $(this).data('mota');
            var soluong = $(this).data('soluong');
            var daban = $(this).data('daban');
            var dm = $(this).data('dm');
            var ncc = $(this).data('ncc');
            var nsx = $(this).data('nsx');
            var images = $(this).data('images');

            $('#edit_id').val(id);
            $('#edit_ten').val(ten);
            $('#edit_gia').val(gia);
            $('#edit_mota').val(mota);
            $('#edit_soluong').val(soluong);
            $('#edit_daban').val(daban);
            $('#edit_dm').val(dm);
            $('#edit_ncc').val(ncc);
            $('#edit_nsx').val(nsx);

            $('#current_images').empty();
            images.forEach(function(image) {
                var imgElement = '<div class="mr-2"><img src="{{asset("back-end/img/sp")}}/' + image.img + '" alt="Current Image" width="50"></div>';
                $('#current_images').append(imgElement);
            });
            var actionUrl = '{{ route("admin.updatesp", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#editForm').attr('action', actionUrl);
        });

        $('#addImageButtonEdit').click(function() {
            var newInput = '<div class="form-group"><label for="image1Edit">Chọn ảnh:</label><input type="file" class="form-control-file" name="images[]"></div>';
            $('#imageContainerEdit').append(newInput);
        });
    });
</script>

<!-- quatang -->
<script>
    $(document).ready(function() {
        function getCsrfToken() {
            return $('meta[name="csrf-token"]').attr('content');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': getCsrfToken()
            }
        });

        $('.add-gift-button').on('click', function() {
            var id = $(this).data('id');
            var ten = $(this).data('ten');

            $('#sanphamid').val(id);
            $('.modal-title').text('Thêm Quà Tặng cho ' + ten);

            $.ajax({
                url: '/getGifts/' + id,
                type: 'GET',
                success: function(data) {
                    $('#giftOptions').empty();
                    if (data.length > 0) {
                        data.forEach(function(gift, index) {
                            var ngayketthuc = new Date(gift.ngayketthuc).toISOString().split('T')[0];
                            var newGift = `
                            <div class="gift-option" data-id="${gift.id}" data-sanphamid="${gift.sanphamid}" data-sanphamidquatang="${gift.sanphamidquatang}">
                                <div class="form-row align-items-center mt-3">
                                    <div class="col">
                                        <label for="sanpham">Sản phẩm</label>
                                        <input type="text" class="form-control" name="sanphamidquantang[]" value="${gift.sanphamidquatang}">
                                        <input type="text" class="form-control" name="tensanphamidquantang" value="${gift.sanpham.ten}">
                                    </div>
                                    <div class="col">
                                        <label for="soluong">Số lượng</label>
                                        <input type="number" class="form-control" name="soluong[]" min="1" placeholder="Số lượng" value="${gift.soluong}">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-danger remove-gift-button">Xóa</button>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="mota">Ngày kết thúc</label>
                                    <input type="date" class="form-control" name="ngayketthuc[]" value="${ngayketthuc}">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="mota">Mô tả</label>
                                    <textarea class="form-control" name="mota[]" rows="3">${gift.mota}</textarea>
                                </div>
                            </div>`;
                            $('#giftOptions').append(newGift);
                        });
                    } else {
                        $('#giftOptions').html('<p>Không có quà tặng cho sản phẩm này.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi lấy danh sách quà tặng:', error);
                }
            });
        });

        $(document).on('click', '.remove-gift-button', function() {
            var giftOption = $(this).closest('.gift-option');
            var sanphamid = giftOption.data('sanphamid');
            var sanphamidquatang = giftOption.data('sanphamidquatang');

            if (confirm('Bạn có chắc chắn muốn xóa quà tặng này?')) {
                $.ajax({
                    url: '/deleteGift',
                    type: 'DELETE',
                    data: {
                        sanphamid: sanphamid,
                        sanphamidquatang: sanphamidquatang,
                        _token: getCsrfToken()
                    },
                    success: function(result) {
                        giftOption.remove();
                        alert('Quà tặng đã được xóa thành công.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi khi xóa quà tặng:', error);
                        alert('Lỗi khi xóa quà tặng.');
                    }
                });
            }
        });

        function updateSanphamList(danhmucElement, sanphamElement) {
            var danhmucId = danhmucElement.val();
            if (danhmucId) {
                $.ajax({
                    url: '/getSanphamByDanhmuc/' + danhmucId,
                    type: 'GET',
                    success: function(data) {
                        sanphamElement.empty();
                        sanphamElement.append('<option value="">Chọn sản phẩm</option>');
                        $.each(data, function(key, value) {
                            sanphamElement.append('<option value="' + value.id + '">' + value.ten + '</option>');
                        });
                    }
                });
            } else {
                sanphamElement.empty();
                sanphamElement.append('<option value="">Chọn sản phẩm</option>');
            }
        }

        $('#danhmuc').change(function() {
            updateSanphamList($(this), $('#sanpham'));
        });

        $('#addGiftButton').click(function() {
            var newGift = `
                    <div class="form-row align-items-center mt-3">
                        <div class="col-md-4">
                            <label for="danhmuc">Danh mục sản phẩm</label>
                            <select class="form-control danhmuc" name="danhmuc[]">
                                <option value="">Chọn danh mục</option>
                                @foreach($dm as $i)
                                    <option value="{{ $i->id }}">{{ $i->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sanpham">Sản phẩm</label>
                            <select class="form-control sanpham" name="sanphamidquantang[]">
                                <option value="">Chọn sản phẩm</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="soluong">Số lượng</label>
                            <input type="number" class="form-control" name="soluong[]" min="1" placeholder="Số lượng">
                        </div>
                    </div>
                       <div class="form-group mt-3">
                                    <label for="mota">Ngày kết thúc</label>
                                    <input type="date" class="form-control" name="ngayketthuc[]" rows="3" >
                                </div>
                    <div class="form-group mt-3">
                        <label for="mota">Mô tả</label>
                        <textarea class="form-control" name="mota[]" rows="3"></textarea>
                    </div>
                `;
            $('#additionalGifts').append(newGift);

            // Attach change event for new category combobox
            $('#additionalGifts .danhmuc').last().change(function() {
                var danhmucElement = $(this);
                var sanphamElement = danhmucElement.closest('.form-row').find('.sanpham');
                updateSanphamList(danhmucElement, sanphamElement);
            });
        });

        // Attach change event for pre-existing category comboboxes
        $('#additionalGifts').on('change', '.danhmuc', function() {
            var danhmucElement = $(this);
            var sanphamElement = danhmucElement.closest('.form-row').find('.sanpham');
            updateSanphamList(danhmucElement, sanphamElement);
        });
    });
</script>




<script>
    $(document).ready(function() {
        $('#discount-tab').click(function() {
            $('#addDiscountForm').show();
            $('#addBulkDiscountForm1').hide();
        });

        $('#bulk-discount-tab').click(function() {
            $('#addDiscountForm').hide();
            $('#addBulkDiscountForm1').show();
        });

        $(document).on('click', '.add-discount-button', function() {
            var sanphamId = $(this).data('id');
            $('#sanphamId').val(sanphamId);

            $.ajax({
                type: 'GET',
                url: '/sanpham/laygiamgia/' + sanphamId,
                success: function(response) {
                    if (response.success) {
                        var giamgia = response.data.giamgia;
                        var giamgiahangloat = response.data.giamgiahangloat;

                        if (giamgia) {
                            $('#giagiam').val(giamgia.giagiam);
                            $('#danggiam').val(giamgia.danggiam);
                            $('#ngaybatdau').val(giamgia.ngaybatdau);
                            $('#ngayketthuc').val(giamgia.ngayketthuc);
                            $('#soluongsanpham').val(giamgia.soluongsanpham);
                        } else {
                            $('#giagiam').val('');
                            $('#danggiam').val('0');
                            $('#ngaybatdau').val('');
                            $('#ngayketthuc').val('');
                            $('#soluongsanpham').val('');
                        }

                        if (giamgiahangloat) {
                            $('#phantramgiamgia').val(giamgiahangloat.phantramgiamgia);
                            $('#giamtoida').val(giamgiahangloat.giamtoida);
                            $('#ngaybatdau_bulk').val(giamgiahangloat.ngaybatdau);
                            $('#ngayketthuc_bulk').val(giamgiahangloat.ngayketthuc);
                            $('#soluongsanpham_bulk').val(giamgiahangloat.soluongsanpham);
                        } else {
                            $('#phantramgiamgia').val('');
                            $('#giamtoida').val('');
                            $('#ngaybatdau_bulk').val('');
                            $('#ngayketthuc_bulk').val('');
                            $('#soluongsanpham_bulk').val('');
                        }

                        $('#addDiscountModal').modal('show');
                    }
                },
                error: function(response) {
                    alert('Đã có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });

        $('#addDiscountForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Đã có lỗi xảy ra, vui lòng thử lại.'
                    });
                }
            });
        });


        $('#addBulkDiscountForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Đã có lỗi xảy ra, vui lòng thử lại.'
                    });
                }
            });
        });
    });
</script>




@endsection
