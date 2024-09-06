@extends('fe.pages.taikhoan')
@section('dondathang')





<div class="uk-width-1-1 uk-width-expand@m">
    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
        <header class="uk-card-header">
            <h1 class="uk-h2">Đơn đặt hàng</h1>
            <div class="uk-button-group">
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleOrders('donhangdxl')">Đơn hàng mới</button>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleOrders('donhangdxn')">Đơn hàng đã xác nhận</button>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleOrders('donhangdg')">Đơn hàng đang giao</button>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleOrders('donhanght')">Đơn hàng đã hoàn thành</button>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleOrders('donhangdoitra')">Đơn hàng đổi trả</button>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleOrders('donhanghuy')">Đơn hàng đã hủy</button>
            </div>
        </header>

        <div class="uk-card-body" id="donhangdxl">
            @if($donhangdxl->isEmpty())
            <h3>Không có đơn hàng nào</h3>
            @else
            @foreach ($donhangdxl as $i)
            <h3 class="donhang" data-id="{{ $i->id }}">
                <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
                    <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
                </a>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleChiTiet('chitiet-{{ $i->id }}')">Chi tiết đơn hàng</button>
                <button class="uk-button uk-button-danger uk-button-small" onclick="openHuyDonModal('{{ $i->id }}')">Hủy Đơn hàng</button>
            </h3>

            <div id="huyDonModal" class="uk-modal" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title">Hủy Đơn Hàng</h2>
                    <form id="huyDonForm" method="POST" action="{{ route('huydon', ['id' => $i->id]) }}">
                        @csrf
                        <div class="uk-margin">
                            <label for="lydo">Lý do hủy:</label>
                            <textarea class="uk-textarea" id="lydo" name="lido" rows="4" required></textarea>
                        </div>
                        <div class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Đóng</button>
                            <button class="uk-button uk-button-danger" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                <tbody>
                    <tr>
                        <th class="uk-width-medium">Số sản phẩm</th>
                        <td>{{$i->soluongsanpham()}}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Vận chuyển</th>
                        <td>{{ $i->diachigiaohang }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Thanh toán</th>
                        <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tổng</th>
                        <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tình trạng</th>
                        <td><span class="uk-label">{{ $i->tinhtrang }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="chitietdonhang" id="chitiet-{{ $i->id }}" style="display: none;">
                <div style="margin-top:50px;"></div>
                <h4>Mã giảm giá sử dụng: {{$i->chitietmgg->magiamgia->magiamgia??'Không có'}}
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->phantramgiamgia != null)
                    , Giảm {{number_format($i->chitietmgg->magiamgia->phantramgiamgia)}}% (tối đa: {{number_format($i->chitietmgg->magiamgia->sotiengiamgiatoida)}}) cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->giamtructiep != null)
                    , Giảm trực tiếp {{number_format($i->chitietmgg->magiamgia->giamtructiep)}}đ, cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                </h4>
                @if($i->phiship != 0)
                <h4>Phí vận chuyển: {{number_format($i->phiship??0)}}đ</h4>
                @endif
                @if($i->mavandon != null)
                <h4>Chi tiết vận chuyển</h4>
                <div id="shipping-detail-{{ $i->id }}" class="shipping-container"></div>
                @endif
                <h4>Chi tiết sản phẩm</h4>
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($i->chitietdonhangs as $detail)
                        <tr>
                            <td>{{ $detail->sanpham->ten }}</td>
                            <td>{{ $detail->soluong }}</td>
                            <td>{{ number_format($detail->gia) }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
            @endif
        </div>

        <div class="uk-card-body" id="donhangdxn" style="display: none;">
            @if($donhangdxn->isEmpty())
            <h3>Không có đơn hàng nào</h3>
            @else
            @foreach ($donhangdxn as $i)
            <h3 class="donhang" data-id="{{ $i->id }}">
                <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
                    <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
                </a>
                <button class="uk-button uk-button-default uk-button-small" onclick="fetchChiTietDonHang('{{ $i->mavandon }}', 'chitiet-{{ $i->id }}')">Chi tiết đơn hàng</button>
                @if($i->mavandon != null)
                <div>
                    <a href="https://tracking.ghn.dev/?order_code={{$i->mavandon}}" target="_blank">Mã vận đơn: {{$i->mavandon}}</a>
                </div>
                @endif
            </h3>
            <table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                <tbody>
                    <tr>
                        <th class="uk-width-medium">Số sản phẩm</th>
                        <td>{{$i->soluongsanpham()}}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Vận chuyển</th>
                        <td>{{ $i->diachigiaohang }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Thanh toán</th>
                        <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tổng</th>
                        <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tình trạng</th>
                        <td><span class="uk-label">{{ $i->tinhtrang }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="chitietdonhang" id="chitiet-{{ $i->id }}" style="display: none;">
                <div style="margin-top:50px;"></div>
                <h4>Mã giảm giá sử dụng: {{$i->chitietmgg->magiamgia->magiamgia??'Không có'}}
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->phantramgiamgia != null)
                    , Giảm {{number_format($i->chitietmgg->magiamgia->phantramgiamgia)}}% (tối đa: {{number_format($i->chitietmgg->magiamgia->sotiengiamgiatoida)}}) cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->giamtructiep != null)
                    , Giảm trực tiếp {{number_format($i->chitietmgg->magiamgia->giamtructiep)}}đ, cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                </h4>
                @if($i->phiship != 0)
                <h4>Phí vận chuyển: {{number_format($i->phiship??0)}}đ</h4>
                @endif
                @if($i->mavandon != null)
                <h4>Chi tiết vận chuyển</h4>
                <div id="shipping-detail-{{ $i->id }}" class="shipping-container"></div>
                @endif
                <h4>Chi tiết sản phẩm</h4>
                <table class="uk-table uk-table-small uk-table-divider">
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
            </div>
            @endforeach
            @endif
        </div>


        <div class="uk-card-body" id="donhangdg" style="display: none;">
            @if($donhangdg->isEmpty())
            <h3>Không có đơn hàng nào</h3>
            @else
            @foreach ($donhangdg as $i)
            <h3 class="donhang" data-id="{{ $i->id }}">
                <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
                    <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
                </a>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleChiTiet('chitiet-{{ $i->id }}')">Chi tiết đơn hàng</button>
            </h3>
            <table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                <tbody>
                    <tr>
                        <th class="uk-width-medium">Số sản phẩm</th>
                        <td>{{$i->soluongsanpham()}}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Vận chuyển</th>
                        <td>{{ $i->diachigiaohang }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Thanh toán</th>
                        <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tổng</th>
                        <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tình trạng</th>
                        <td><span class="uk-label">{{ $i->tinhtrang }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="chitietdonhang" id="chitiet-{{ $i->id }}" style="display: none;">
                <div style="margin-top:50px;"></div>
                <h4>Mã giảm giá sử dụng: {{$i->chitietmgg->magiamgia->magiamgia??'Không có'}}
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->phantramgiamgia != null)
                    , Giảm {{number_format($i->chitietmgg->magiamgia->phantramgiamgia)}}% (tối đa: {{number_format($i->chitietmgg->magiamgia->sotiengiamgiatoida)}}) cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->giamtructiep != null)
                    , Giảm trực tiếp {{number_format($i->chitietmgg->magiamgia->giamtructiep)}}đ, cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                </h4>
                @if($i->phiship != 0)
                <h4>Phí vận chuyển: {{number_format($i->phiship??0)}}đ</h4>
                @endif
                @if($i->mavandon != null)
                <h4>Chi tiết vận chuyển</h4>
                <div id="shipping-detail-{{ $i->id }}" class="shipping-container"></div>
                @endif
                <h4>Chi tiết sản phẩm</h4>
                <table class="uk-table uk-table-small uk-table-divider">
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
            </div>
            @endforeach
            @endif
        </div>

        <div class="uk-card-body" id="donhanght" style="display: none;">
            @if($donhanght->isEmpty())
            <h3>Không có đơn hàng nào</h3>
            @else
            @foreach ($donhanght as $i)
            <h3 class="donhang" data-id="{{ $i->id }}">
                <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
                    <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
                </a>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleChiTiet('chitiet-{{ $i->id }}')">Chi tiết đơn hàng</button>
                @php
                $requestedForThisOrder = false;
                @endphp
                @if (count($doitra) > 0)
                @foreach ($doitra as $dt)
                @if ($dt->donhangid == $i->id)
                @php
                $requestedForThisOrder = true;
                break;
                @endphp
                @endif
                @endforeach
                @endif
                @if (!$requestedForThisOrder)
                <button class="uk-button uk-button-danger uk-button-small" onclick="openReturnModal(<?php echo $i->id ?>)">Đổi trả hàng hóa</button>
                @endif
            </h3>
            <div id="return-modal-{{ $i->id }}" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title">Chọn sản phẩm để đổi trả</h2>
                    <form action="{{ route('yeucaudoitra') }}" method="POST">
                        @csrf
                        <input type="hidden" name="donhangid" value="{{ $i->id }}">
                        <div class="uk-margin">
                            <label>Chọn sản phẩm:</label>
                            @php
                            // Nhóm sản phẩm theo sanphamid và tính tổng số lượng
                            $groupedDetails = $i->chitietdonhangs->groupBy('sanphamid')->map(function($group) {
                            return [
                            'ten' => $group->first()->sanpham->ten,
                            'soluong' => $group->sum('soluong')
                            ];
                            });
                            @endphp

                            @foreach ($groupedDetails as $sanphamid => $detail)
                            <div class="uk-margin-small">
                                <label>
                                    <input class="uk-checkbox product-checkbox" type="checkbox" name="sanphamids[]" value="{{ $sanphamid }}" data-soluong-id="soluong-{{ $sanphamid }}">
                                    {{ $detail['ten'] }}
                                </label>
                                <label for="soluong-{{ $sanphamid }}">Số lượng</label>
                                <input class="uk-text-default product-quantity" type="number" name="soluong[]" min="1" step="1" max="{{ $detail['soluong'] }}" id="soluong-{{ $sanphamid }}" >
                            </div>
                            @endforeach
                        </div>
                        <div class="uk-margin">
                            <label for="lydo">Lý do:</label>
                            <textarea id="lydo" name="lydo" class="uk-textarea" required></textarea>
                        </div>
                        <button type="submit" class="uk-button uk-button-primary">Gửi yêu cầu</button>
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Hủy</button>
                    </form>
                </div>
            </div>

            <table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                <tbody>
                    <tr>
                        <th class="uk-width-medium">Số sản phẩm</th>
                        <td>{{$i->soluongsanpham()}}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Vận chuyển</th>
                        <td>{{ $i->diachigiaohang }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Thanh toán</th>
                        <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tổng</th>
                        <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tình trạng</th>
                        <td><span class="uk-label">{{ $i->tinhtrang }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="chitietdonhang" id="chitiet-{{ $i->id }}" style="display: none;">
                <div style="margin-top:50px;"></div>
                <h4>Mã giảm giá sử dụng: {{$i->chitietmgg->magiamgia->magiamgia??'Không có'}}
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->phantramgiamgia != null)
                    , Giảm {{number_format($i->chitietmgg->magiamgia->phantramgiamgia)}}% (tối đa: {{number_format($i->chitietmgg->magiamgia->sotiengiamgiatoida)}}) cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->giamtructiep != null)
                    , Giảm trực tiếp {{number_format($i->chitietmgg->magiamgia->giamtructiep)}}đ, cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                </h4>
                @if($i->phiship != 0)
                <h4>Phí vận chuyển: {{number_format($i->phiship??0)}}đ</h4>
                @endif
                @if($i->mavandon != null)
                <h4>Chi tiết vận chuyển</h4>
                <div id="shipping-detail-{{ $i->id }}" class="shipping-container"></div>
                @endif
                <h4>Chi tiết sản phẩm</h4>
                <table class="uk-table uk-table-small uk-table-divider">
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
                            <td><a href="{{route('chitietsp',['id'=>$detail->sanphamid])}}">{{ $detail->sanpham->ten }}</a></td>
                            <td>{{ $detail->soluong }}</td>
                            <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
            @endif
        </div>



        <div class="uk-card-body" id="donhangdoitra" style="display: none;">
            @if($donhangdoitra->isEmpty())
            <h3>Không có đơn hàng đổi trả nào</h3>
            @else
            @foreach ($donhangdoitra as $i)
            <h3 class="donhang" data-id="{{ $i->id }}">
                <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
                    <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
                </a>
                <button class="uk-button uk-button-default uk-button-small" onclick="toggleChiTiet('chitietdoitra-{{ $i->id }}')">Chi tiết đổi trả</button>
            </h3>

            <table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                <tbody>
                    <tr>
                        <th class="uk-width-medium">Đơn hàng</th>
                        <td>{{ '#' . $i->donhangid }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Số sản phẩm</th>
                        <td>{{$i->soluongsanpham()}}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Lý do</th>
                        <td>{{ $i->lydo }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tình trạng</th>
                        <td style="font-size: 15px;"><span class="uk-label-danger">{{ $i->tinhtrang }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="chitietdonhang" id="chitietdoitra-{{ $i->id }}" style="display: none;">
                <h4>Chi tiết sản phẩm đổi trả</h4>
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
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
            </div>
            @endforeach
            @endif
        </div>
        <div class="uk-card-body" id="donhanghuy" style="display: none;">
            @if($donhanghuy->isEmpty())
            <h3>Không có đơn hàng nào</h3>
            @else
            @foreach ($donhanghuy as $i)
            <h3 class="donhang" data-id="{{ $i->id }}">
                <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
                    <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
                </a>
                <button class="uk-button uk-button-default uk-button-small" onclick="fetchChiTietDonHang('{{ $i->mavandon }}', 'chitiet-{{ $i->id }}')">Chi tiết đơn hàng</button>
                <a class="uk-button uk-button-danger uk-button-small" href="{{route('datlai',['id'=>$i->id])}}">Đặt lại</a>
                @if($i->mavandon != null)
                <div>
                    <a href="https://tracking.ghn.dev/?order_code={{$i->mavandon}}" target="_blank">Mã vận đơn: {{$i->mavandon}}</a>
                </div>
                @endif
            </h3>
            <table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                <tbody>
                    <tr>
                        <th class="uk-width-medium">Số sản phẩm</th>
                        <td>{{$i->soluongsanpham()}}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Vận chuyển</th>
                        <td>{{ $i->diachigiaohang }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Thanh toán</th>
                        <td>{{ $i->phuongthucthanhtoan->ten }}</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tổng</th>
                        <td>{{ number_format($i->tongtien, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <th class="uk-width-medium">Tình trạng</th>
                        <td><span class="uk-label-danger">{{ $i->tinhtrang }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="chitietdonhang" id="chitiet-{{ $i->id }}" style="display: none;">
                <div style="margin-top:50px;"></div>
                <h4>Mã giảm giá sử dụng: {{$i->chitietmgg->magiamgia->magiamgia??'Không có'}}
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->phantramgiamgia != null)
                    , Giảm {{number_format($i->chitietmgg->magiamgia->phantramgiamgia)}}% (tối đa: {{number_format($i->chitietmgg->magiamgia->sotiengiamgiatoida)}}) cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                    @if( $i->magiamgia !=null && $i->chitietmgg->magiamgia->giamtructiep != null)
                    , Giảm trực tiếp {{number_format($i->chitietmgg->magiamgia->giamtructiep)}}đ, cho cho đơn hàng {{number_format($i->chitietmgg->magiamgia->giatritoithieudonhang)}}
                    @endif
                </h4>
                @if($i->phiship != 0)
                <h4>Phí vận chuyển: {{number_format($i->phiship??0)}}đ</h4>
                @endif
                @if($i->mavandon !=null)
                <h4>Chi tiết vận chuyển</h4>
                <div id="shipping-detail-{{ $i->id }}"></div>
                @endif
                <h4>Chi tiết sản phẩm</h4>
                <table class="uk-table uk-table-small uk-table-divider">
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
            </div>
            @endforeach
            @endif
        </div>


    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.3/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.3/js/uikit-icons.min.js"></script>
<script>
    function toggleOrders(section) {
        console.log(`Toggling section: ${section}`);
        const sections = ['donhangdxl', 'donhangdxn', 'donhangdg', 'donhanght', 'donhanghuy', 'donhangdoitra'];
        sections.forEach(s => {
            const element = document.getElementById(s);
            if (element) {
                console.log(`Hiding section: ${s}`);
                element.style.display = 'none';
            } else {
                console.log(`Section not found: ${s}`);
            }
        });
        const sectionElement = document.getElementById(section);
        if (sectionElement) {
            console.log(`Showing section: ${section}`);
            sectionElement.style.display = 'block';
        } else {
            console.log(`Section not found: ${section}`);
        }
    }

    function toggleChiTiet(chiTietId) {
        const chiTiet = document.getElementById(chiTietId);
        if (chiTiet) {
            if (chiTiet.style.display === 'block') {
                chiTiet.style.display = 'none';
            } else {
                chiTiet.style.display = 'block';
            }
        } else {
            console.log(`ChiTiet not found: ${chiTietId}`);
        }
    }

    function fetchChiTietDonHang(mavandon, chiTietId) {
        if (!mavandon) {
            toggleChiTiet(chiTietId);
        }

        $.ajax({
            url: "{{ route('donhang.chitiet') }}",
            type: 'POST',
            data: {
                mavandon: mavandon,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    let chiTietHtml = '';
                    if (response.log && response.log.length > 0) {
                        const order_date = new Date(response.order_date).toLocaleString('vi-VN');
                        const leadtime = new Date(response.leadtime).toLocaleString('vi-VN');
                        chiTietHtml += `
                        <p>Thời gian giao hàng dự kiến: ${leadtime}</p>
                        <div style="margin-top:50px;"></div>
                        <div class="shipping-step">
                            <div class="step-content">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p style="font-size:15px">Thời gian: ${order_date}</p>
                                <p style="font-size:15px">Trạng thái: Chờ lấy hàng</p>
                            </div>
                        </div>`;
                        response.log.forEach(function(log, index) {
                            const updated_date = new Date(log.updated_date).toLocaleString('vi-VN');
                            const status = log.status === 'cancel' ? 'Đã hủy' : log.status;
                            const leadtime = new Date(response.leadtime).toLocaleString('vi-VN');
                            chiTietHtml += `
                            <p></p>
                            <div style="margin-top:50px;"></div>
                            <div class="shipping-step">
                                <div class="step-content">
                                    <div class="step-icon">
                                        <i class="fa fa-warning" style="color:red"></i>
                                    </div>
                                    <p style="font-size:15px;">Thời gian: ${updated_date}</p>
                                    <p style="font-size:15px">Trạng thái: ${status}</p>

                                </div>
                                ${index < response.log.length - 1 ? '<div class="step-connector"></div>' : ''}
                            </div>`;
                        });
                    } else {
                        const order_date = new Date(response.order_date).toLocaleString('vi-VN');
                        const leadtime = new Date(response.leadtime).toLocaleString('vi-VN');
                        chiTietHtml += `
                             <p>Thời gian giao hàng dự kiến: ${leadtime}</p>
                             <div style="margin-top:50px;"></div>
                            <div class="shipping-step">
                                <div class="step-content">
                                    <div class="step-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <p>Thời gian: ${order_date}</p>
                                    <p>Trạng thái: Chờ lấy hàng</p>
                                </div>
                            </div>`;
                    }

                    const chiTietElement = document.getElementById('shipping-detail-' + chiTietId.split('-')[1]);
                    if (chiTietElement) {
                        chiTietElement.innerHTML = chiTietHtml;
                        toggleChiTiet(chiTietId);
                    } else {
                        console.log(`ChiTiet element not found: ${chiTietId}`);
                    }
                }
            },
            error: function() {

            }
        });
    }

    function openHuyDonModal(donhangId) {
        UIkit.modal('#huyDonModal').show();
    }
</script>
<script>
    function openReturnModal(donhangId) {
        UIkit.modal('#return-modal-' + donhangId).show();
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var soluongInput = document.getElementById(checkbox.getAttribute('data-soluong-id'));
                if (soluongInput) { // Ensure the input element exists
                    if (checkbox.checked) {
                        soluongInput.value = 1;
                    } else {
                        soluongInput.value = ''; // Clear value when checkbox is unchecked
                    }
                } else {
                    console.error('No input found with ID:', checkbox.getAttribute('data-soluong-id'));
                }
            });
        });
    });
</script>

@endsection
