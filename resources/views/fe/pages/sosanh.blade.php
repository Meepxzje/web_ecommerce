@extends('fe.index')
@section('title', 'So sánh')
@section('sosanh')

<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="/">Trang chủ</a></li>
                        <li><span>So sánh</span></li>
                    </ul>
                    <h1 class="uk-margin-small-top uk-margin-remove-bottom">So sánh</h1>
                    @if(isset($products)&&count($products)>0)
                    <form action="{{ route('removeAllFromCompare') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('Post')
                        <button type="submit" class="uk-text-small uk-text-danger" style="border: none; background: none;">
                            <span uk-icon="icon: close; ratio: .75;"></span>
                            <span class="uk-margin-xsmall-left tm-pseudo">Xóa tất cả</span>
                        </button>
                    </form>
                    @endif
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-overflow-auto tm-ignore-container">
                        <table class="uk-table uk-table-divider tm-compare-table">
                            @if(isset($products)&&count($products)>0)
                            <thead>
                                <tr class="uk-child-width-1-4">
                                    <td class="uk-table-middle uk-text-center tm-compare-column">
                                        <input class="tm-checkbox" id="show-difference" type="checkbox">
                                        <label for="show-difference">Chỉ hiển thị sự khác biệt</label>
                                    </td>
                                    @foreach($products as $i)
                                    <td class="tm-compare-table-column" id="product-{{ $i->id }}">
                                        <div class="uk-height-1-1">
                                            <div class="uk-grid-small uk-child-width-1-1 uk-height-1-1" uk-grid>
                                                <form action="{{ route('removeFromCompare', $i->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('Post')
                                                    <button type="submit" class="uk-text-small uk-text-danger" style="border: none; background: none;">
                                                        <span uk-icon="icon: close; ratio: .75;"></span>
                                                        <span class="uk-margin-xsmall-left tm-pseudo">Xóa</span>
                                                    </button>
                                                </form>
                                                <div>
                                                    <div class="uk-grid-small uk-height-1-1" uk-grid="uk-grid">
                                                        <div class="uk-width-1-3">
                                                            <div class="tm-ratio tm-ratio-4-3">
                                                                <a class="tm-media-box" href="{{route('chitietsp',['id'=>$i->id])}}">
                                                                    <figure class="tm-media-box-wrap">
                                                                        @if($i->hinhanhsanphams->isNotEmpty())
                                                                        <img src="{{ asset('back-end/img/sp/' . $i->hinhanhsanphams->first()->img) }}" alt='anh' />
                                                                        @endif
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-expand">
                                                            <div class="tm-product-card-body uk-padding-remove uk-height-1-1">
                                                                <div class="tm-product-card-info">
                                                                    <div class="uk-text-meta uk-margin-xsmall-bottom" style="font-size: 15px;">{{$i->danhmuc->ten}}/{{$i->nhasanxuat->ten}}</div>
                                                                    <a class="tm-product-card-title" href="{{route('chitietsp',['id'=>$i->id])}}">{{$i->ten}}</a>
                                                                </div>
                                                                <div class="tm-product-card-shop">
                                                                    <div class="tm-product-card-prices">
                                                                        <div class="tm-product-card-price">{{number_format($i->gia)}}</div>
                                                                    </div>
                                                                    <div class="tm-product-card-add">
                                                                        <div>
                                                                            <form action="{{ route('giohang.addToCart') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="sanphamid" value="{{ $i->id }}">
                                                                                <input type="hidden" name="gia" value="{{ $i->gia }}">
                                                                                <button class="uk-button uk-button-primary tm-product-card-add-button tm-shine js-add-to-cart" type="submit">
                                                                                    <span class="tm-product-card-add-button-icon" uk-icon="cart"></span><span class="tm-product-card-add-button-text">Thêm vào giỏ hàng</span>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>
                            </thead>
                            @if($products->first()->danhmucid==1)
                            <tbody id="hieu-nang">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Hiệu năng</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hiệu năng</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->cpus->ten ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tốc độ xung nhịp cơ bản</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->tocdoxungnhipcoban ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tốc độ tăng tối đa</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->tocdoxungnhiptoida ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tổng bộ nhớ được cài đặt</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->rams->ten ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại bộ nhớ</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->loaibonho ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tốc độ bộ nhớ</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->tocdobonho ?? '—' }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Khe cắm bộ nhớ khả dụng</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->khecambonhokhadung ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kiểu đồ họa</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->kieudohoa ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>GPU</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->gpu ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>GPU - Rời</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsohieunang->gpurois->ten ?? '—' }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tbody id="man-hinh">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Màn hình</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Loại panel</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->loaipanel ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kích thước</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->kichthuocs->ten ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tỷ lệ khung hình</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->tylekhunghinh ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Độ phân giải gốc</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->dophangiai ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Màn hình cảm ứng</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->manhinhcamung ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Chất liệu</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->bemat ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Độ sáng</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsomanhinh->dosang ?? '—' }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tbody id="o-dia">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Ổ đĩa</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Các khe có sẵn</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoluutru->khecamkhadung ?? "-"}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tổng dung lượng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoluutru->tongdungluongs->ten ?? '-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Lưu trữ</th>
                                    @foreach($products as $i)
                                    <td> {{$i->thongsoluutru->luutru ?? '-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Ổ đĩa</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoluutru->odia ?? '-'}}</td>
                                    @endforeach
                                </tr>

                            </tbody>
                            <tbody id="cong">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Cổng kết nối input/output</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Cổng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoketnoi->soluongcong ??'-'}} × {{$i->thongsoketnoi->cong ??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Màn hình</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoketnoi->soluongconghienthi ??'-'}} × {{$i->thongsoketnoi->hienthi??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Âm thanh</th>
                                    @foreach($products as $i)
                                    <td>
                                        1 × {{$i->thongsoketnoi->amthanh1 ?? '-'}}
                                        <br>
                                        2 × {{$i->thongsoketnoi->amthanh2 ??'-'}}
                                        <br>
                                        3 × {{$i->thongsoketnoi->amthanh3??'-'}}
                                    </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Khe cắm mở rộng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoketnoi->khecaidatmorong??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Khe cắm thẻ nhớ</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsoketnoi->docthenho??'-'}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tbody id="truyen-thong">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Truyền thông</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Kết nối mạng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->ketnoimang ??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Modem</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->modem ??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Wi-Fi</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->wifi??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Bluetooth</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->bluetooth??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Băng thông di động</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->bangthongdidong??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>GPS</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->gps??'-'}}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>NFC</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->nfc??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Webcam</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotruyenthong->webcam??'-'}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tbody id="pin">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Pin</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Pin</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopin->pin ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsopin->loai ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Thời gian hoạt động (tối đa)</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopin->thoigiansudungtoida ?? '-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Yêu cầu năng lượng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopin->yeucaunangluong ?? '-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Cung cấp năng lượng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopin->cungcapnangluong??'-'}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tbody id="tong-quat">
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Thông số tổng quát</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hệ điều hành</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotongquat->hedieuhanh??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Bảo mật</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotongquat->anninh??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Bàn phím</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotongquat->banphim??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Thiết bị trỏ</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsotongquat->thietbidiem??'-'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kích thước (D x R x C)</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsotongquat->kichthuoc ?? '—' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Trọng lượng</th>
                                    @foreach($products as $i)
                                    <td>{{ $i->thongsotongquat->trongluong ?? '—' }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @elseif($products->first()->danhmucid==2)
                            <tbody>
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Thông số của bàn phím</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hãng sản xuất</th>
                                    @foreach($products as $i)
                                    <td>{{$i->nhasanxuat->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại bàn Phím</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->loaibanphims->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Cổng kết nối</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->congketnoi}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kiểu dáng bàn phím</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->kieudangbanphims->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại Keycap</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->keycaps->ten}} {{$i->thongsopkbanphim?->motakeycap}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Switch</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->switch}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Dung lượng Pin (nếu có)</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->pin}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kích thước</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->kichthuoc}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Phụ kiện</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkbanphim?->phukien}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @elseif($products->first()->danhmucid==3)
                            <tbody>
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Thông số của ram</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hãng sản xuất</th>
                                    @foreach($products as $i)
                                    <td>{{$i->nhasanxuat->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Dung lượng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkram?->dungluongs->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tốc độ BUS</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkram?->tocdobuss->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại RAM</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkram?->loairams->ten}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @elseif($products->first()->danhmucid==4)
                            <tbody>
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Thông số của ram</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hãng sản xuất</th>
                                    @foreach($products as $i)
                                    <td>{{$i->nhasanxuat->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kích Thước</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->kichthuocs->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Độ phân giải</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->dophangiais->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tấm nền</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->tamnens->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tần số quét</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->tansoquets->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Độ sáng</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->dosang}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Độ tương phản</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->dotuongphan}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Cổng kết nối</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkmanhinh?->congketnoi}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @elseif($products->first()->danhmucid==5)
                            <tbody>
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Thông số của Tai nghe</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hãng sản xuất</th>
                                    @foreach($products as $i)
                                    <td>{{$i->nhasanxuat->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại kết nối</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->loaiketnois->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kiểu tai nghe</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->kieutainghes->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Cổng kết nối</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->congketnois->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Màu sắc</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->mausac}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Micro</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->micro}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Chiều dài dây (nếu có)</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->day}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Tương thích</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->tuongthich}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Cách âm</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopktainghe?->cacham}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @elseif($products->first()->danhmucid==7)
                            <tbody>
                                <tr>
                                    <th colspan="{{ count($products) + 1 }}">
                                        <h3 class="uk-margin-remove">Thông số của Chuột</h3>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Hãng sản xuất</th>
                                    @foreach($products as $i)
                                    <td>{{$i->nhasanxuat->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Loại kết nối</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkchuot?->loaiketnois->ten}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Kiểu kết nối</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkchuot?->kieuketnoi}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Màu sắc</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkchuot?->mausac}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>LED</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkchuot?->led}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Độ nhạy</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkchuot?->donhay}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Phụ kiện</th>
                                    @foreach($products as $i)
                                    <td>{{$i->thongsopkchuot?->phukien}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @else
                            Lỗi
                            @endif
                            @else
                            <div class="uk-card-body">
                                <div class="uk-text-center">
                                    <p>So sánh của bạn đang trống.</p>
                                    <a href="{{route('danhsachdanhmuc',['id'=>1])}}">Xem sản phẩm ngay</a>
                                </div>
                            </div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.getElementById('show-difference').addEventListener('change', function() {
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let hideRow = true;

            if (cells.length > 1) {
                const firstCellContent = cells[0].innerHTML.trim();

                for (let i = 1; i < cells.length; i++) {
                    if (cells[i].innerHTML.trim() !== firstCellContent) {
                        hideRow = false;
                        break;
                    }
                }
            } else {
                hideRow = false;
            }

            if (this.checked) {
                if (hideRow) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            } else {
                row.style.display = '';
            }
        });
    });
</script>

@endsection
