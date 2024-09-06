@extends('admin.index')
@section('title', 'Quản Lý đơn hàng')
@section('qldonhang')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>

    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="toggleOrders('donhangdxl')">Đơn hàng mới</button>
        <button type="button" class="btn btn-primary" onclick="toggleOrders('donhangdxn')">Đơn hàng đã lên đơn</button>
        <button type="button" class="btn btn-primary" onclick="toggleOrders('donhangdg')">Đơn hàng đang giao</button>
        <button type="button" class="btn btn-primary" onclick="toggleOrders('donhanght')">Đơn hàng đã hoàn thành</button>
        <button type="button" class="btn btn-primary" onclick="toggleOrders('donhanghuy')">Đơn hàng đã hủy</button>
        <button type="button" class="btn btn-primary" onclick="toggleOrders('donhangdoitra')">Đơn hàng đổi trả</button>
    </div>
    <div class="mb-3">
        <form action="{{route('capnhattrangthai')}}" method="post">
            @csrf
            <button class="btn btn-primary" type="submit">Cập nhật đê</button>
        </form>
    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createOrderModal">Tạo đơn hàng</button>
    </div>

    <div class="card shadow mb-4" id="donhangdxl">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Email người đặt</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ giao nhận</th>
                            <th>Phí giao hàng</th>
                            <th>Mã giảm giá</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach($donhangdxl as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->nguoidung->email }}</td>
                            <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->ngaydat)) }}</td>
                            <td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ $i->diachigiaohang }}</td>
                            <td>{{number_format($i->phiship)}}</td>
                            <td>
                                {{ optional(optional($i->chitietmgg)->magiamgia)->magiamgia ?? 'Không' }}
                                <span style="color: red;">-
                                    @if(optional($i->chitietmgg)->magiamgia)
                                    @if(optional($i->chitietmgg->magiamgia)->phantramgiamgia)
                                    {{ number_format($i->chitietmgg->magiamgia->phantramgiamgia) }}%
                                    @else
                                    {{ number_format($i->chitietmgg->magiamgia->giamtructiep) }}
                                    @endif
                                    @endif
                                </span>
                            </td>

                            <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                            <td>{{ $i->tinhtrang }}</td>
                            <td style="max-width:200px;">
                                <button type="button" class="btn btn-danger edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $i->id }}">Hủy đơn</button>
                                <button class="btn btn-info" onclick="toggleDetails('{{$i->id}}')">Chi tiết</button>
                                <!-- <a href="{{route('admin.donhang.capnhattinhtrangdaxacnhan',['id' => $i->id])}}" class="btn btn-success" onclick="return confirm('Bạn có chắc muốn xác nhận không')">Xác nhận</a> -->
                                <form action="{{ route('createghn', ['id' => $i->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Tạo GHN</button>
                                </form>

                                <button type="button" class="btn btn-warning edit-button1"
                                    data-toggle="modal"
                                    data-target="#suadonhang"
                                    data-id="{{ $i->id }}"
                                    data-email="{{ $i->nguoidung->email }}"
                                    data-phuongthucthanhtoan="{{ $i->phuongthucthanhtoanid }}"
                                    data-ngaydat="{{$i->ngaydat }}"
                                    data-diachigiaohang="{{ $i->diachigiaohang }}"
                                    data-phiship="{{ number_format($i->phiship) }}"
                                    data-magiamgia="{{ optional(optional($i->chitietmgg)->magiamgia)->magiamgia ?? 'Không' }}"
                                    data-tongtien="{{ number_format($i->tongtien, 0, ',', '.') }}"
                                    data-tinhtrang="{{ $i->tinhtrang }}">
                                    Sửa đơn hàng
                                </button>
                            </td>


                            <div class="modal fade" id="suadonhang" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Sửa đơn</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editForm1" method="post" action="{{ route('admin.suadonhang', ['id' => $i->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" id="edit_id1" name="id">

                                                        <div class="form-group">
                                                            <label for="edit_email1">Email người đặt:</label>
                                                            <input type="text" class="form-control" id="edit_email1" name="email">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="hinhthucthanhtoan">Hình thức thanh toán</label>
                                                            <select class="form-control" id="edit_phuongthucthanhtoan1" name="phuongthucthanhtoan">
                                                                @foreach($pttt as $pt)
                                                                <option value="{{ $pt->id }}">{{ $pt->ten }}</option>
                                                                @endforeach
                                                                <option value="giaolai">Giao lại</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_ngaydat1">Ngày đặt:</label>
                                                            <input type="date" class="form-control" id="edit_ngaydat1" name="ngaydat">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="hinhthucthanhtoan">Hình thức nhận hàng</label>
                                                            <select class="form-control" id="edit_diachigiaohang1" name="giaohang">
                                                                <option value="cuahang">Lấy tại của hàng</option>
                                                                <option value="giaohang">Giao hàng</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_phiship1">Phí giao hàng:</label>
                                                            <input type="text" class="form-control" id="edit_phiship1" name="phiship">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_magiamgia1">Mã giảm giá:</label>
                                                            <input type="text" class="form-control" id="edit_magiamgia1" name="magiamgia">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_tongtien1">Tổng tiền:</label>
                                                            <input type="text" class="form-control" id="edit_tongtien1" name="tongtien" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="edit_tinhtrang1">Tình trạng:</label>
                                                            <input type="text" class="form-control" id="edit_tinhtrang1" name="tinhtrang" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Chi tiết sản phẩm</h4>
                                                        <div id="orderDetails">
                                                        </div>
                                                    </div>

                                                    <button type="button" id="addProductButton" class="btn btn-primary">Thêm sản phẩm</button>
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
                        </tr>
                        <tr class="details-row" id="details-row-{{ $i->id }}" style="display: none;">
                            <td colspan="7">
                                <h4>Chi tiết sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>KL</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->chitietdonhangs as $detail)
                                        <tr>
                                            <td>{{ $detail->sanpham->ten }}</td>
                                            <td>{{ $detail->soluong }}</td>
                                            <td>{{ $detail->sanpham->thongsotongquat?->trongluong }}</td>
                                            <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4" id="donhangdxn" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Mã vận đơn</th>
                            <th>Email người đặt</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ giao nhận</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($donhangdxn as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td><a href="https://tracking.ghn.dev/?order_code={{$i->mavandon}}" target="_blank">{{$i->mavandon}}</a></td>
                            <td>{{ $i->nguoidung->email }}</td>
                            <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->ngaydat)) }}</td>
                            <td style="max-width: 50px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ $i->diachigiaohang }}</td>
                            <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                            <td>{{ $i->tinhtrang }}</td>
                            <td style="max-width:200px;">
                                <button type="button" class="btn btn-danger edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $i->id }}">Hủy đơn</button>
                                <button class="btn btn-info" onclick="toggleDetails('{{$i->id}}')">Chi tiết</button>
                                <!-- <a href="{{route('admin.donhang.capnhattinhtrangdanggiao',['id' => $i->id])}}" class="btn btn-success" onclick="return confirm('Bạn có chắc muốn xác nhận đang giao không')">Xác nhận</a> -->
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-{{ $i->id }}" style="display: none;">
                            <td colspan="7">
                                <h4>Chi tiết sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->chitietdonhangs as $detail)
                                        <tr>
                                            <td>{{ $detail->sanpham->ten }}</td>
                                            <td>{{ $detail->soluong }}</td>
                                            <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4" id="donhangdg" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Email người đặt</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ giao nhận</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($donhangdg as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->nguoidung->email }}</td>
                            <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->ngaydat)) }}</td>
                            <td>{{ $i->diachigiaohang }}</td>
                            <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                            <td>{{ $i->tinhtrang }}</td>
                            <td style="max-width:200px;">
                                <button class="btn btn-info" onclick="toggleDetails('{{$i->id}}')">Chi tiết</button>
                                <!-- <a href="{{route('admin.donhang.capnhattinhtranghoanthanh',['id' => $i->id])}}" class="btn btn-success" onclick="return confirm('Bạn có chắc muốn xác nhận đã hoàn thành không')">Xác nhận</a> -->
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-{{ $i->id }}" style="display: none;">
                            <td colspan="7">
                                <h4>Chi tiết sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->chitietdonhangs as $detail)
                                        <tr>
                                            <td>{{ $detail->sanpham->ten }}</td>
                                            <td>{{ $detail->soluong }}</td>
                                            <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4" id="donhanght" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Email người đặt</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ giao nhận</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($donhanght as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->nguoidung->email }}</td>
                            <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->ngaydat)) }}</td>
                            <td>{{ $i->diachigiaohang }}</td>
                            <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                            <td>{{ $i->tinhtrang }}</td>
                            <td style="max-width:200px;">
                                <button class="btn btn-info" onclick="toggleDetails('{{$i->id}}')">Chi tiết</button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-{{ $i->id }}" style="display: none;">
                            <td colspan="7">
                                <h4>Chi tiết sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->chitietdonhangs as $detail)
                                        <tr>
                                            <td>{{ $detail->sanpham->ten }}</td>
                                            <td>{{ $detail->soluong }}</td>
                                            <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4" id="donhanghuy" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Email người đặt</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ giao nhận</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($donhanghuy as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->nguoidung->email }}</td>
                            <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->ngaydat)) }}</td>
                            <td>{{ $i->diachigiaohang }}</td>
                            <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                            <td>{{ $i->tinhtrang }}</td>
                            <td style="max-width:200px;">
                                <button class="btn btn-info" onclick="toggleDetails('{{$i->id}}')">Chi tiết</button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-{{ $i->id }}" style="display: none;">
                            <td colspan="7">
                                <h4>Chi tiết sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->chitietdonhangs as $detail)
                                        <tr>
                                            <td>{{ $detail->sanpham->ten }}</td>
                                            <td>{{ $detail->soluong }}</td>
                                            <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4" id="donhangdoitra" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Email người đặt</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày yêu cầu</th>
                            <th>Địa chỉ giao nhận</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($donhangdoitra as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->nguoidung->email }}</td>
                            <td>{{ $i->donhang->phuongthucthanhtoan->ten }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->created_at)) }}</td>
                            <td>{{ $i->donhang->diachigiaohang }}</td>
                            <td>{{ number_format($i->donhang->tongtien) }}đ</td>
                            <td>{{ $i->tinhtrang }}</td>
                            <td style="max-width:200px;">
                                <button class="btn btn-info" onclick="toggleDetails('doitra{{ $i->id }}')">Chi tiết</button>
                                @if( $i->tinhtrang == 'Yêu cầu đổi trả')
                                <a href="{{ route('xacnhandoitra', ['id' => $i->donhangid]) }}" class="btn btn-success">Xác nhận đổi trả</a>
                                @endif
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-doitra{{ $i->id }}" style="display: none;">
                            <td colspan="8">
                                <h4>Chi tiết sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->chitietdoitras as $detail)
                                        <tr>
                                            <td>{{ $detail->sanpham->ten }}</td>
                                            <td>{{ $detail->soluong }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-labelledby="createOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOrderModalLabel">Tạo đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createOrderForm" method="post" action="{{ route('admin.donhang.admintaodon') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nguoidungid">Người dùng:</label>
                                <select class="form-control" id="nguoidungid" name="nguoidungid">
                                    <option value="">Chọn người dùng</option>
                                    @foreach($nguoidungs as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row" id="user-details" style="display:none;">
                            <div class="form-group col-md-3">
                                <label for="nguoidungten">Tên:</label>
                                <p id="nguoidungten"></p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nguoidungsdt">SDT:</label>
                                <p id="nguoidungsdt"></p>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="diachigiaohang">Địa chỉ giao hàng:</label>
                                <p id="diachigiaohang"></p>
                                <input type="hidden" id="diachigiaohang-hidden" name="diachigiaohang-hidden">
                            </div>
                        </div>
                        <div id="product-container">
                            <div class="product-item">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="danhmucid">Danh mục:</label>
                                        <select class="form-control danhmucid" name="danhmucid[]">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($danhmucs as $category)
                                            <option value="{{ $category->id }}">{{ $category->ten }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sanphamid">Sản phẩm:</label>
                                        <select class="form-control sanphamid" name="sanphamid[]">
                                            <option value="">Chọn sản phẩm</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="soluong">Số lượng:</label>
                                        <input type="number" class="form-control soluong" name="soluong[]" min="1" value="1">
                                    </div>
                                    <div class="form-group total-container">
                                        <p class="total-price" id="tam-tinh-0">Tạm tính: 0</p>
                                    </div>
                                </div>
                                <div class="form-group quatang-container" style="display:none;">
                                    <label for="quatang">Quà tặng:</label>
                                    <input type="hidden" class="quatang-id" name="quatang-id[]">
                                    <div class="quatang"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="hinhthucthanhtoan">Hình thức thanh toán</label>
                                <select class="form-control" id="thanhtoan" name="thanhtoan">
                                    @foreach($pttt as $i)
                                    <option value="{{ $i->id }}">{{ $i->ten }}</option>
                                    @endforeach
                                    <option value="giaolai">Giao lại</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hinhthucthanhtoan">Hình thức nhận hàng</label>
                                <select class="form-control" id="giaohang" name="giaohang">
                                    <option value="cuahang">Lấy tại của hàng</option>
                                    <option value="giaohang">Giao hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group total-container">
                                <p class="total-price" style="color: red;" id="tong-tien">Tổng tiền: 0</p>
                                <input type="hidden" id="tongtien" name="tongtien" value="0">
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" id="addProduct">Thêm sản phẩm</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Hủy đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_ten">Lí do:</label>
                            <input type="text" class="form-control" id="lido" name="lido">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                </form>
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
        $(document).ready(function() {

            // Function to update user details based on selected user ID
            function updateUserDetails(userId) {
                if (userId) {
                    $.ajax({
                        url: '/getUserDetails/' + userId,
                        type: 'GET',
                        success: function(data) {
                            if (data) {
                                $('#nguoidungten').text(data.ten);
                                $('#nguoidungsdt').text(data.sdt);
                                $('#diachigiaohang').text(data.diachigiaohang);
                                $('#diachigiaohang-hidden').val(data.diachigiaohang);
                                $('#user-details').show();
                            } else {
                                $('#nguoidungten').text('');
                                $('#nguoidungsdt').text('');
                                $('#diachigiaohang').text('');
                                $('#diachigiaohang-hidden').val('');
                                $('#user-details').hide();
                            }
                        },
                        error: function() {
                            $('#nguoidungten').text('không có');
                            $('#nguoidungsdt').text('không có');
                            $('#diachigiaohang').text('không có');
                            $('#diachigiaohang-hidden').val('');
                            $('#user-details').hide();
                        }
                    });
                } else {
                    $('#nguoidungten').text('không có');
                    $('#nguoidungsdt').text('không có');
                    $('#diachigiaohang').text('không có');
                    $('#diachigiaohang-hidden').val('');
                    $('#user-details').hide();
                }
            }

            // Event listener for user selection change
            $('#nguoidungid').change(function() {
                var userId = $(this).val();
                updateUserDetails(userId);
            });

            // Function to update product options based on category
            function updateSanphamOptions(danhmucidElement, sanphamidElement) {
                var danhmucId = danhmucidElement.val();
                if (danhmucId) {
                    $.ajax({
                        url: '/getSanphamByDanhmuc/' + danhmucId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Chọn sản phẩm</option>';
                            $.each(data, function(key, sanpham) {
                                options += '<option value="' + sanpham.id + '">' + sanpham.id + ': ' + sanpham.ten + '</option>';
                            });
                            sanphamidElement.html(options);
                        }
                    });
                } else {
                    sanphamidElement.html('<option value="">Chọn sản phẩm</option>');
                }
            }


            $(document).on('change', '.danhmucid', function() {
                var sanphamidElement = $(this).closest('.product-item').find('.sanphamid');
                updateSanphamOptions($(this), sanphamidElement);
            });

            function updateTotalPrice(productItem) {
                var productId = productItem.find('.sanphamid').val();
                var quantity = productItem.find('.soluong').val();

                if (productId && quantity) {
                    $.ajax({
                        url: '/getProductPrice/' + productId,
                        type: 'GET',
                        success: function(data) {
                            if (data && data.price) {
                                var totalPrice = data.price * quantity;
                                productItem.find('.total-price').text('Tạm tính: ' + totalPrice.toLocaleString() + ' VND');
                                productItem.find('.total-price').attr('id', 'tam-tinh-' + productId); // Set unique ID for each subtotal
                                calculateTotalAmount(); // Calculate total amount after updating this subtotal only
                            } else {
                                productItem.find('.total-price').text('Tạm tính: 0');
                            }
                        }
                    });
                } else {
                    productItem.find('.total-price').text('Tạm tính: 0');
                }
            }


            $(document).on('input', '.soluong', function() {
                var productItem = $(this).closest('.product-item');
                updateTotalPrice(productItem);
            });


            // Event listener for product selection change
            $(document).on('change', '.sanphamid', function() {
                var productItem = $(this).closest('.product-item');
                updateTotalPrice(productItem);
            });

            function calculateTotalAmount() {
                var totalAmount = 0;
                $('.product-item').each(function() {
                    var totalPriceElement = $(this).find('.total-price');
                    var priceStr = totalPriceElement.text().replace(/\./g, '').replace(/[^\d.-]/g, '');
                    var price = parseFloat(priceStr);
                    if (!isNaN(price)) {
                        totalAmount += price;
                    }
                });
                $('#tong-tien').text('Tổng tiền: ' + totalAmount.toLocaleString() + ' VND');
                $('#tongtien').val(totalAmount);
            }


            // Event listener for adding product button
            $('#addProduct').click(function() {
                var productItemHtml = `
        <div class="product-item">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="danhmucid">Danh mục:</label>
                    <select class="form-control danhmucid" name="danhmucid[]">
                        <option value="">Chọn danh mục</option>
                        @foreach($danhmucs as $category)
                        <option value="{{ $category->id }}">{{ $category->ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="sanphamid">Sản phẩm:</label>
                    <select class="form-control sanphamid" name="sanphamid[]">
                        <option value="">Chọn sản phẩm</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="soluong">Số lượng:</label>
                    <input type="number" class="form-control soluong" name="soluong[]" min="1" value="1">
                </div>
                <div class="form-group total-container">
                    <p class="total-price">Tạm tính: 0</p>
                </div>
            </div>
            <div class="form-group quatang-container" style="display:none;">
                <label for="quatang">Quà tặng:</label>
                <input type="hidden" class="quatang-id" name="quatang-id[]">
                <div class="quatang"></div>
            </div>
        </div>`;
                $('#product-container').append(productItemHtml);
            });

            function updateQuatangOptions(sanphamidElement, quatangContainer, quatangElement) {
                var sanphamId = sanphamidElement.val();
                if (sanphamId) {
                    $.ajax({
                        url: '/getQuatang/' + sanphamId,
                        type: 'GET',
                        success: function(data) {
                            var quatangHtml = '';
                            if (data.quatangs && data.quatangs.length > 0) {
                                $.each(data.quatangs, function(key, quatang) {
                                    quatangHtml += '<p style="color: green;">' + quatang.ten + ' (ID: ' + quatang.id + ')</p>';
                                });
                                quatangElement.html(quatangHtml);
                                quatangContainer.show();
                            } else {
                                quatangElement.html('');
                                quatangContainer.hide();
                            }
                        }

                    });
                } else {
                    quatangElement.html('');
                    quatangContainer.hide();
                }
            }

            // Event listener for product selection change
            $(document).on('change', '.sanphamid', function() {
                var sanphamidElement = $(this);
                var quatangContainer = sanphamidElement.closest('.product-item').find('.quatang-container');
                var quatangElement = quatangContainer.find('.quatang');
                updateQuatangOptions(sanphamidElement, quatangContainer, quatangElement);
                var productItem = sanphamidElement.closest('.product-item');
                updateTotalPrice(productItem); // Update total price after changing product
            });
            calculateTotalAmount();
        });
    </script>




    <script>
        // Khi nhấn vào nút chỉnh sửa
        $(document).on('click', '.edit-button1', function() {
            var id = $(this).data('id');
            var email = $(this).data('email');
            var phuongthucthanhtoan = $(this).data('phuongthucthanhtoan');
            var ngaydat = $(this).data('ngaydat');
            var diachigiaohang = $(this).data('diachigiaohang');
            var phiship = $(this).data('phiship');
            var magiamgia = $(this).data('magiamgia');
            var tongtien = $(this).data('tongtien');
            var tinhtrang = $(this).data('tinhtrang');

            var dc = diachigiaohang === 'Lấy tại cửa hàng' ? 'cuahang' : 'giaohang';

            // Đặt giá trị cho các trường trong form
            $('#edit_id1').val(id);
            $('#edit_email1').val(email);
            $('#edit_phuongthucthanhtoan1').val(phuongthucthanhtoan);
            $('#edit_ngaydat1').val(ngaydat);
            $('#edit_diachigiaohang1').val(dc);
            $('#edit_phiship1').val(phiship);
            $('#edit_magiamgia1').val(magiamgia);
            $('#edit_tongtien1').val(tongtien);
            $('#edit_tinhtrang1').val(tinhtrang);

            // Gọi AJAX để lấy chi tiết đơn hàng
            $.ajax({
                url: '/get-order-details/' + id,
                type: 'GET',
                success: function(data) {
                    var orderDetailsHtml = '<div class="row">';
                    data.details.forEach(function(detail, index) {
                        orderDetailsHtml += '<div class="col-md-12 form-group product-item" data-index="' + index + '">';
                        orderDetailsHtml += '<label>Sản phẩm:</label><input type="text" class="form-control" value="' + detail.sanpham.ten + '" readonly>';
                        orderDetailsHtml += '<input type="hidden" name="products[' + index + '][sanpham_id]" value="' + detail.sanpham.id + '">';
                        orderDetailsHtml += '<label>Số lượng:</label><input type="text" class="form-control" name="products[' + index + '][soluong]" value="' + detail.soluong + '">';
                        orderDetailsHtml += '<label>Giá:</label><input type="text" class="form-control" name="products[' + index + '][gia]" value="' + detail.gia + '">';
                        orderDetailsHtml += '<button type="button" class="btn btn-danger remove-product">Xóa</button>';
                        orderDetailsHtml += '</div><div class="col-md-12 mb-2"></div>'; // Tạo khoảng cách giữa các sản phẩm
                    });
                    orderDetailsHtml += '</div>';
                    $('#orderDetails').html(orderDetailsHtml);
                },
                error: function(error) {
                    console.error("Đã xảy ra lỗi khi lấy chi tiết đơn hàng:", error);
                    $('#orderDetails').html('<p>Không thể tải chi tiết đơn hàng.</p>');
                }
            });
        });

        // Xử lý xóa sản phẩm
        $(document).on('click', '.remove-product', function() {
            $(this).closest('.product-item').remove();
            // Cập nhật lại index cho các sản phẩm còn lại
            $('#orderDetails .product-item').each(function(index) {
                $(this).attr('data-index', index);
                $(this).find('.product-category').attr('data-index', index);
                $(this).find('select.product-select').attr('name', 'products[' + index + '][sanpham_id]');
                $(this).find('input[name$="[soluong]"]').attr('name', 'products[' + index + '][soluong]');
                $(this).find('input[name$="[gia]"]').attr('name', 'products[' + index + '][gia]');
            });
        });


        // Xử lý thêm sản phẩm mới
        $('#addProductButton').on('click', function() {
            var newIndex = $('#orderDetails .product-item').length;
            var newProductHtml = '<div class="col-md-12 form-group product-item" data-index="' + newIndex + '">';
            newProductHtml += '<label>Danh mục:</label><select class="form-control product-category" data-index="' + newIndex + '"><option value="">Chọn danh mục</option>@foreach($dm as $d)<option value="{{ $d->id }}">{{ $d->ten }}</option>@endforeach</select>';
            newProductHtml += '<label>Sản phẩm:</label><select class="form-control product-select" name="products[][sanpham_id]"><option value="">Chọn sản phẩm</option></select>';
            newProductHtml += '<label>Số lượng:</label><input type="text" class="form-control" name="products[][soluong]" value="1">';
            newProductHtml += '<label>Giá:</label><input type="text" class="form-control" name="products[][gia]" value="0">';
            newProductHtml += '<button type="button" class="btn btn-danger remove-product">Xóa</button>';
            newProductHtml += '</div><div class="col-md-12 mb-2"></div>';
            $('#orderDetails').append(newProductHtml);
        });



        // Xử lý khi chọn danh mục sản phẩm
        $(document).on('change', '.product-category', function() {
            var index = $(this).data('index');
            var danhmucId = $(this).val();
            var productSelect = $(this).closest('.product-item').find('.product-select');

            if (danhmucId) {
                $.ajax({
                    url: '/getSanphamByDanhmuc/' + danhmucId,
                    type: 'GET',
                    success: function(data) {
                        productSelect.empty().append('<option value="">Chọn sản phẩm</option>');
                        data.forEach(function(sanpham) {
                            productSelect.append('<option value="' + sanpham.id + '">' + sanpham.ten + '</option>');
                        });
                        productSelect.prop('disabled', false);
                    },
                    error: function(error) {
                        console.error("Đã xảy ra lỗi khi lấy sản phẩm:", error);
                        productSelect.prop('disabled', true);
                    }
                });
            } else {
                productSelect.empty().append('<option value="">Chọn sản phẩm</option>').prop('disabled', true);
            }
        });
    </script>




    @endsection
    @section('js(donhang)')
    <script>
        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            $('#edit_id').val(id);
            var actionUrl = '{{ route("admin.donhang.huydon", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#editForm').attr('action', actionUrl);
        });
    </script>





    @endsection
