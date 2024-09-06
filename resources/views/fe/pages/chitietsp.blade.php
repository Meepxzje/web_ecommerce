@extends('fe.index')
@section('title', 'Sản Phẩm')
@section('chitietsp')

<main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><a href="{{route('danhsachdanhmuc',['id'=>$sp->danhmucid])}}">{{$sp->danhmuc->ten}}</a></li>
                        <li><span>{{$sp->nhasanxuat->ten}}</span></li>
                        <li><span>{{$sp->ten}}</span></li>
                    </ul>
                    <h1 class="heading-lv2">{{$sp->ten}}
                </div>
                <div>
                    <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                        <div>
                            <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                <div class="uk-grid-small uk-grid-collapse uk-grid-match" uk-grid>
                                    <div class="uk-width-1-1 uk-width-expand@m">
                                        <div class="uk-grid-collapse uk-child-width-1-1" uk-slideshow="finite: true; ratio: 4:3;" uk-grid>
                                            <div>
                                                <ul class="uk-slideshow-items" uk-lightbox>
                                                    @if($sp->hinhanhsanphams->isNotEmpty())
                                                    @foreach($sp->hinhanhsanphams as $hinhanh)
                                                    <li>
                                                        <figure class="tm-media-box-wrap"> <img src="{{ asset('back-end/img/sp/' . $hinhanh->img) }}" alt="anh" />
                                                        </figure>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div>
                                                <div class="uk-card-body uk-flex uk-flex-center">
                                                    <div class="uk-width-1-2 uk-visible@s">
                                                        <div uk-slider="finite: true">
                                                            <div class="uk-position-relative">
                                                                <div class="uk-slider-container">
                                                                    <ul class="tm-slider-items uk-slider-items uk-child-width-1-4 uk-grid uk-grid-small">
                                                                        @if($sp->hinhanhsanphams->isNotEmpty())
                                                                        @foreach($sp->hinhanhsanphams as $hinhanh)
                                                                        <li uk-slideshow-item="{{$hinhanh->id}}">
                                                                            <div class="tm-ratio tm-ratio-1-1">
                                                                                <a class="tm-media-box tm-media-box-frame">
                                                                                    <figure class="tm-media-box-wrap"> <img src="{{ asset('back-end/img/sp/' . $hinhanh->img) }}" alt="anh" />
                                                                                    </figure>
                                                                                </a>
                                                                            </div>
                                                                        </li>
                                                                        @endforeach
                                                                        @endif
                                                                    </ul>
                                                                    <div><a class="uk-position-center-left-out uk-position-small" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="uk-position-center-right-out uk-position-small" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="uk-slideshow-nav uk-dotnav uk-hidden@s"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1 uk-width-1-3@m tm-product-info">
                                        <div class="uk-card-body">
                                            <div><a href="#"><img src="{{ asset('back-end/img/nsx/' . $sp->nhasanxuat->img) }}" alt="Apple" style="height: 40px;"></a></div>
                                            <div class="uk-margin">
                                                <div class="uk-grid-small" uk-grid>
                                                    <div class="uk-flex uk-flex-middle">
                                                        <ul class="uk-iconnav uk-margin-xsmall-bottom tm-rating">
                                                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$diemtb) <li>
                                                                <span class="uk-text-warning" uk-icon="star"></span>
                                                                </li>
                                                                @else
                                                                <li>
                                                                    <span class="uk-text-muted" uk-icon="star"></span>
                                                                </li>
                                                                @endif
                                                                @endfor
                                                        </ul>

                                                    </div>
                                                    <!-- <div><span class="uk-label uk-label-warning uk-margin-xsmall-right">Bán
                                                            chạy nhất</span><span class="uk-label uk-label-danger uk-margin-xsmall-right">trade-in</span>
                                                    </div> -->
                                                </div>
                                            </div>
                                            @if($sp->danhmuc->id == 1)
                                            <div class="uk-margin">
                                                <div class="uk-grid-medium" uk-grid>
                                                    <div>
                                                        <div class="uk-text-small uk-margin-xsmall-bottom">Bộ Nhớ
                                                            SSD
                                                        </div>
                                                        <ul class="uk-subnav uk-subnav-pill tm-variations" uk-switcher>
                                                            <li><a>{{$sp->thongsohieunang->rams->ten}}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="uk-margin">
                                                <div class="uk-padding-small uk-background-primary-lighten uk-border-rounded">
                                                    <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                        <div>
                                                            @if ($sp->giamgia && $sp->giamgia->danggiam == 1 )
                                                            <del class="uk-text-meta">{{ number_format($sp->gia) }}</del>
                                                            <div class="tm-product-price" style="color: red;">{{ number_format($sp->gia - $sp->giamgia->giagiam) }} đ</div>
                                                            @else
                                                            <div class="tm-product-price">{{ number_format($sp->gia) }}đ</div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <div class="uk-grid-small" uk-grid>
                                                                <div style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                                                                    <form action="{{ route('giohang.addtocartsp') }}" method="POST">
                                                                        @csrf
                                                                        <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 10px;">
                                                                            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                                                                <a onclick="increment(-1, 'product-1')" uk-icon="icon: minus; ratio: .75" style="margin-right: 5px;"></a>
                                                                                <input class="uk-input tm-quantity-input" name="soluong" id="product-1" type="number" value="1" max="{{$sp->soluong}}" readonly style="width: 80px; text-align: center; margin-right: 5px;" />
                                                                                <a onclick="increment(+1, 'product-1')" uk-icon="icon: plus; ratio: .75" style="margin-right: 10px;"></a>
                                                                            </div>
                                                                            <input type="hidden" name="sanphamid" value="{{ $sp->id }}">
                                                                            <input type="hidden" name="gia" value="{{ $sp->gia }}">
                                                                            @if($sp->soluong>=0)
                                                                            <button type="submit" class="uk-button uk-button-primary tm-product-add-button tm-shine js-add-to-cart" style="margin-bottom: 10px;">
                                                                                Thêm vào giỏ hàng
                                                                            </button>
                                                                            @else
                                                                            <button class="uk-button uk-button-primary tm-product-add-button tm-shine js-add-to-cart" style="margin-bottom: 10px;" disabled>
                                                                                Hết hàng
                                                                            </button>
                                                                            @endif
                                                                        </div>
                                                                    </form>
                                                                    <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                                        <a href="{{route('addquantam',['id'=>$sp->id])}}" class="tm-product-card-action js-add-to js-add-to-favorites tm-action-button-active js-added-to" title="Quan tâm">
                                                                            <span uk-icon="icon: heart; ratio: .75;"></span>
                                                                        </a>
                                                                        <a href="" onclick="event.preventDefault(); document.getElementById('add-to-compare-{{ $sp->id }}').submit();" class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" title="So sánh">
                                                                            <span uk-icon="icon: copy; ratio: .75;"></span>
                                                                        </a>
                                                                        <form id="add-to-compare-{{ $sp->id }}" action="{{ route('addToCompare', $sp->id) }}" method="POST" style="display: none;">
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <div class="uk-padding-small uk-background-muted uk-border-rounded">
                                                    <div class="uk-grid-small uk-child-width-1-1 uk-text-small" uk-grid>
                                                        <div>
                                                            <div class="uk-grid-collapse" uk-grid><span class="uk-margin-xsmall-right" uk-icon="cart"></span>
                                                                <div>
                                                                    <div class="nav">Giao hàng</div>
                                                                    @if($sp->soluong >= 1)
                                                                    <div class="uk-text-xsmall uk-text-muted">Còn
                                                                        {{$sp->soluong}} sản phẩm
                                                                    </div>
                                                                    @else
                                                                    <div class="uk-text-xsmall uk-text-muted">Hết hàng
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-grid-collapse" uk-grid><span class="uk-margin-xsmall-right" uk-icon="location"></span>
                                                                <div>
                                                                    <div class="uk-text-bolder">Nhận tại cửa hàng
                                                                    </div>
                                                                    @if($sp->soluong >= 1)
                                                                    <div class="uk-text-xsmall uk-text-muted">Còn
                                                                        hàng</div>
                                                                    @else
                                                                    <div class="uk-text-xsmall uk-text-muted">Hết hàng
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($sp->danhmuc->ten == 'Laptop' || ($sp->danhmuc->parent && $sp->danhmuc->parent->ten == 'Laptop'))
                                            <div class="uk-margin">
                                                <ul class="uk-list uk-text-small uk-margin-remove">
                                                    <li><span class="uk-text-muted">Màn hình:
                                                        </span><span>{{$sp->thongsomanhinh->kichthuocs->ten}}</span></li>
                                                    <li><span class="uk-text-muted">CPU:
                                                        </span><span>{{$sp->thongsohieunang->cpus->ten}}</span></li>
                                                    <li><span class="uk-text-muted">RAM:
                                                        </span><span>{{$sp->thongsohieunang->rams->ten}}</span></li>
                                                    <li><span class="uk-text-muted">Card màn hình: </span><span> {{$sp->thongsohieunang->gpurois->ten}}</span></li>
                                                </ul>
                                                <div class="uk-margin-small-top"><a class="uk-link-heading js-scroll-to-description" href="#description" onclick="UIkit.switcher('.js-product-switcher').show(1);"><span class="tm-pseudo">Chi tiết kỹ thuật</span><span class="uk-margin-xsmall-left" uk-icon="icon: chevron-down; ratio: .75;"></span></a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1 tm-product-description" id="description">
                                        <header>
                                            <nav class="tm-product-nav" uk-sticky="offset: 60; bottom: #description; cls-active: tm-product-nav-fixed;">
                                                <ul class="uk-subnav uk-subnav-pill js-product-switcher" uk-switcher="connect: .js-tabs">
                                                    <li><a class="js-scroll-to-description" href="#description">Tổng quan</a></li>
                                                    <li><a class="js-scroll-to-description" href="#description">Thông số kỹ thuật</a></li>
                                                    <li><a class="js-scroll-to-description" href="#description">Đánh giá
                                                    <li><a class="js-scroll-to-description" href="#description">Quà tặng kèm theo
                                                            <!-- <span>(2)</span></a></li> -->
                                                    <li><a class="js-scroll-to-description" href="#description">Q&A</a></li>
                                                </ul>
                                            </nav>
                                        </header>
                                        <div class="uk-card-body">
                                            <div class="uk-switcher js-product-switcher js-tabs">
                                                <section>
                                                    <article class="uk-article">
                                                        <div class="heading-lv3">
                                                            <h2>{{$sp->mota}}</h2>
                                                            <blockquote cite="#">
                                                                <footer>VinnMeepShop</footer>
                                                            </blockquote>
                                                        </div>
                                                    </article>
                                                </section>
                                                @if($sp->danhmuc->ten == 'Laptop' || ($sp->danhmuc->parent && $sp->danhmuc->parent->ten == 'Laptop'))
                                                <section>
                                                    <h2>Hiệu năng</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Chip xử lý</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->cpus->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tốc độ xung nhịp cơ bản</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->tocdoxungnhipcoban}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tốc độ xung nhịp tối đa</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->tocdoxungnhiptoida}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">RAM
                                                            </th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->rams->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại bộ nhớ</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->loaibonho}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tốc độ bộ nhớ</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->tocdobonho}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Khe cắm bộ nhớ khả dụng
                                                            </th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->khecambonhokhadung}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kiểu đồ họa</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->kieudohoa}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">GPU</th>
                                                            <td class="uk-table-expand">{{$sp->thongsohieunang->gpu}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Card đồ họa</th>
                                                            <td class="uk-table-expand">
                                                                {{$sp->thongsohieunang->gpurois->ten}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <h2>Màn hình</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Loại panel</th>
                                                            <td class="uk-table-expand">{{$sp->thongsomanhinh->loaipanel}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Size</th>
                                                            <td class="uk-table-expand">{{$sp->thongsomanhinh->kichthuocs->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tỷ lệ khung hình</th>
                                                            <td class="uk-table-expand">{{$sp->thongsomanhinh->tylekhunghinh}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Độ phân giải</th>
                                                            <td class="uk-table-expand">{{$sp->thongsomanhinh->dophangiai}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Màn hình cảm ứng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsomanhinh->manhinhcamung}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Bề mặt</th>
                                                            <td class="uk-table-expand">{{$sp->thongsomanhinh->bemat}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Độ sáng</th>
                                                            <td class="uk-table-expand">
                                                                {{$sp->thongsomanhinh->dosang}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <h2>Ổ đĩa</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Các khe có sẵn</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoluutru->khecamkhadung}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tổng dung lượng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoluutru->tongdungluongs->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Lưu trữ</th>
                                                            <td class="uk-table-expand">
                                                                {{$sp->thongsoluutru->luutru}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Ổ đĩa</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoluutru->odia}}</td>
                                                        </tr>
                                                    </table>
                                                    <h2>Cổng kết nối input/output</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Cổng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoketnoi->soluongcong}} × {{$sp->thongsoketnoi->cong}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Màn hình</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoketnoi->soluongconghienthi}} × {{$sp->thongsoketnoi->hienthi}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Âm thanh</th>
                                                            <td class="uk-table-expand">1 × {{$sp->thongsoketnoi->amthanh1}}

                                                                <br>
                                                                2 × {{$sp->thongsoketnoi->amthanh2}}
                                                                <br>
                                                                3 × {{$sp->thongsoketnoi->amthanh3}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Khe cắm mở rộng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoketnoi->khecaidatmorong}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Khe cắm thẻ nhớ</th>
                                                            <td class="uk-table-expand">{{$sp->thongsoketnoi->docthenho}}</td>
                                                        </tr>
                                                    </table>
                                                    <h2>Truyền thông</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Kết nối mạng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->ketnoimang}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Modem</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->modem}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Wi-Fi</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->wifi}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Bluetooth</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->bluetooth}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Băng thông di động</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->bangthongdidong}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">GPS</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->gps}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">NFC</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->nfc}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Webcam</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotruyenthong->webcam}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <h2>Pin</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Pin</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopin->pin}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại</th>
                                                            <td class="uk-table-expand">
                                                                {{$sp->thongsopin->loai}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Thời gian dùng tối đa</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopin->thoigiansudungtoida}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Yêu cầu năng lượng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopin->yeucaunangluong}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Cung cấp năng lượng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopin->cungcapnangluong}}</td>
                                                        </tr>
                                                    </table>
                                                    <h2>Tổng quát</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Hệ điều hành</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotongquat->hedieuhanh}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">An ninh</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotongquat->anninh}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Bàn phím</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotongquat->banphim}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Thiết bị trỏ</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotongquat->thietbidiem}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kích thước</th>
                                                            <td class="uk-table-expand">{{$sp->thongsotongquat->kichthuoc}}
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Trọng lượng</th>
                                                            <td class="uk-table-expand">
                                                                {{$sp->thongsotongquat->trongluong}}
                                                        </tr>
                                                    </table>

                                                </section>
                                                @elseif($sp->danhmucid == 2)
                                                <section>
                                                    <h2>Thông số của bàn phím</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Hãng sản xuất</th>
                                                            <td class="uk-table-expand">{{$sp->nhasanxuat->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại bàn Phím</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->loaibanphims->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Cổng kết nối</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->congketnoi}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kiểu dáng bàn phím</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->kieudangbanphims->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại Keycap</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->keycaps->ten}} {{$sp->thongsopkbanphim?->motakeycap}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Switch</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->switch}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Dung lượng Pin (nếu có)</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->pin}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kích thước</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->kichthuoc}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Phụ kiện</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkbanphim?->phukien}}</td>
                                                        </tr>
                                                    </table>
                                                </section>
                                                @elseif($sp->danhmucid == 3)
                                                <section>
                                                    <h2>Thông số của ram</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Hãng sản xuất</th>
                                                            <td class="uk-table-expand">{{$sp->nhasanxuat->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Dung lượng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkram?->dungluongs->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tốc độ BUS</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkram?->tocdobuss->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại RAM</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkram?->loairams->ten}}</td>
                                                        </tr>
                                                    </table>
                                                </section>
                                                @elseif($sp->danhmucid == 4)
                                                <section>
                                                    <h2>Thông số của màn hình</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Hãng sản xuất</th>
                                                            <td class="uk-table-expand">{{$sp->nhasanxuat->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kích Thước</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->kichthuocs->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Độ phân giải</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->dophangiais->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tấm nền</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->tamnens->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tần số quét</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->tansoquets->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Độ sáng</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->dosang}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Độ tương phản</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->dotuongphan}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Cổng kết nối</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkmanhinh?->congketnoi}}</td>
                                                        </tr>
                                                    </table>
                                                </section>
                                                @elseif($sp->danhmucid == 5)
                                                <section>
                                                    <h2>Thông số của Tai nghe</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Hãng sản xuất</th>
                                                            <td class="uk-table-expand">{{$sp->nhasanxuat->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại kết nối</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->loaiketnois->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kiểu tai nghe</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->kieutainghes->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Cổng kết nối</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->congketnois->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Màu sắc</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->mausac}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Micro</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->micro}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Chiều dài dây (nếu có)</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->day}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tương thích</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->tuongthich}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Cách âm</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopktainghe?->cacham}}</td>
                                                        </tr>
                                                    </table>
                                                </section>
                                                @elseif($sp->danhmucid == 7)
                                                <section>
                                                    <h2>Thông số của Chuột</h2>
                                                    <table class="uk-table uk-table-divider uk-table-justify uk-table-responsive">
                                                        <tr>
                                                            <th class="uk-width-medium">Hãng sản xuất</th>
                                                            <td class="uk-table-expand">{{$sp->nhasanxuat->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Loại kết nối</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkchuot?->loaiketnois->ten}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Kiểu kết nối</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkchuot?->kieuketnoi}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th class="uk-width-medium">Màu sắc</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkchuot?->mausac}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th class="uk-width-medium">LED</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkchuot?->led}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th class="uk-width-medium">Độ nhạy</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkchuot?->donhay}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th class="uk-width-medium">Phụ kiện</th>
                                                            <td class="uk-table-expand">{{$sp->thongsopkchuot?->phukien}}</td>
                                                        </tr>
                                                    </table>
                                                </section>
                                                @endif
                                                <section>
                                                    <div class="uk-grid-small uk-grid-divider" uk-grid>
                                                        <div class="uk-width-1-1 uk-width-1-5@s uk-text-center tm-reviews-column">
                                                            <div class="uk-text-meta uk-text-uppercase">ĐÁNH GIÁ
                                                            </div>
                                                            <div class="uk-heading-primary">{{$diemtb}}</div>
                                                            <div class="uk-flex uk-flex-center">
                                                                <ul class="uk-iconnav tm-rating">
                                                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$diemtb) <li><span class="uk-text-warning" uk-icon="star"></span></li>
                                                                        @else
                                                                        <li><span class="uk-text-muted" uk-icon="star"></span></li>
                                                                        @endif
                                                                        @endfor
                                                                </ul>
                                                            </div>
                                                            <div style="margin-top: 100px;"></div>
                                                            @if(Auth::check())
                                                            @if($canReview)
                                                            <button type="button" class="uk-button uk-button-primary" data-toggle="modal" data-target="#danhgiaModal" style="font-size: 12px; padding: 5px; display: inline-block;">
                                                                Viết đánh giá
                                                            </button>
                                                            @else
                                                            <button class="uk-button uk-button-default" disabled>Mua sản phẩm để đánh giá</button>
                                                            @endif
                                                            @else
                                                            <button type="button" class="uk-button uk-button-default" data-toggle="modal" disabled>
                                                                Đăng nhập để viết đánh giá
                                                            </button>
                                                            @endif
                                                        </div>
                                                        <div class="uk-width-1-1 uk-width-expand@s">
                                                            <div id="danhgia-container" class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
                                                                @foreach ($danhgias as $i)
                                                                <article class="danhgia-item" style="display: block;">
                                                                    <section class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                                        <header class="uk-flex uk-flex-middle">
                                                                            @if($i->nguoidung->img)
                                                                            <img src="{{ asset('font-end/img/taikhoan/' . $i->nguoidung->img) }}" alt="{{ $i->nguoidung->ten }}" class="uk-border-circle" width="50" height="50">
                                                                            @else
                                                                            <img src="{{ asset('font-end/img/taikhoan/nguoidung.png') }}" alt="{{ $i->nguoidung->ten }}" class="uk-border-circle" width="50" height="50">
                                                                            @endif
                                                                            <div class="uk-margin-left">
                                                                                <div class="uk-h4 uk-margin-remove" style="font-size: 20px;">{{ $i->nguoidung->ten }}</div>
                                                                                <time class="uk-text-meta" style="font-size: 10px;">{{($i->created_at)->format('d, M, Y') }}</time>
                                                                            </div>
                                                                        </header>
                                                                        <div>
                                                                            <ul class="uk-iconnav uk-margin-bottom tm-rating">
                                                                                @for ($diem = 1; $diem <= 5; $diem++) @if ($diem <=$i->diem)
                                                                                    <li><span class="uk-text-warning" uk-icon="star"></span></li>
                                                                                    @else
                                                                                    <li><span class="uk-text-muted" uk-icon="star"></span></li>
                                                                                    @endif
                                                                                    @endfor
                                                                            </ul>
                                                                            <div class="comment-content">
                                                                                <p style="line-height: 1.6; font-size:20px;">{{ $i->binhluan }}</p>
                                                                            </div>
                                                                            @if(Auth::check())
                                                                            @if(Auth::user()->id == $i->nguoidungid)
                                                                            <div class="edit-comment-form" style="display:none;">
                                                                                <form action="{{ route('danhgia.update', $i->id) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div class="form-group">
                                                                                        <label for="diem-{{ $i->id }}">Chọn sao:</label>
                                                                                        <select name="diem" id="diem-{{ $i->id }}" class="form-control" required>
                                                                                            <option value="1" {{ $i->diem == 1 ? 'selected' : '' }}>1 sao</option>
                                                                                            <option value="2" {{ $i->diem == 2 ? 'selected' : '' }}>2 sao</option>
                                                                                            <option value="3" {{ $i->diem == 3 ? 'selected' : '' }}>3 sao</option>
                                                                                            <option value="4" {{ $i->diem == 4 ? 'selected' : '' }}>4 sao</option>
                                                                                            <option value="5" {{ $i->diem == 5 ? 'selected' : '' }}>5 sao</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="binhluan-{{ $i->id }}">Bình Luận</label>
                                                                                        <textarea name="binhluan" id="binhluan-{{ $i->id }}" class="form-control" required>{{ $i->binhluan }}</textarea>
                                                                                    </div>
                                                                                    <button type="submit" class="uk-button uk-button-primary">Cập nhật</button>
                                                                                    <button type="button" class="uk-button uk-button-default cancel-edit">Hủy</button>
                                                                                </form>
                                                                            </div>
                                                                            <a class="uk-button uk-button-secondary edit-comment" href="#" data-id="{{ $i->id }}">Sửa bình luận</a>
                                                                            <form action="{{ route('danhgia.destroy', $i->id) }}" method="POST" style="display:inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="uk-button uk-button-danger">Xóa bình luận</button>
                                                                            </form>
                                                                            @endif
                                                                            @endif
                                                                            <div style="margin-top:30px;"></div>
                                                                        </div>


                                                                    </section>
                                                                </article>
                                                                @endforeach
                                                            </div>
                                                            <div style="text-align: center;">
                                                                <button id="load-more" class="uk-button uk-button-default" style="margin: 20px auto;">Xem thêm</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    @if(isset($quatangs) && count($quatangs) > 0)
                                                    <h2>Quà tặng kèm theo</h2>
                                                    <div class="uk-margin-top uk-text-xsmall uk-text-success">
                                                        <strong>Quà tặng:</strong>
                                                        <header class="uk-card-header uk-text-uppercase uk-text-muted uk-text-center uk-text-xsmall uk-visible@m">
                                                            <div class="uk-grid-small uk-child-width-1-2" uk-grid>
                                                                <div>Sản phẩm</div>
                                                                <div>
                                                                    <div class="uk-grid-small uk-child-width-expand" uk-grid>
                                                                        <div>Giá</div>

                                                                        <div class="uk-width-auto">
                                                                            <div style="width: 20px;"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </header>
                                                        <ul class="uk-list uk-list-bullet uk-margin-remove">
                                                            @foreach($quatangs as $quatang)
                                                            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m uk-flex-middle" uk-grid>
                                                                <div>
                                                                    <div class="uk-grid-small" uk-grid>
                                                                        <div class="uk-width-1-3">
                                                                            <div class="tm-ratio tm-ratio-4-3">
                                                                                <a class="tm-media-box" href="{{ route('chitietsp', $quatang->sanphamidquatang) }}">
                                                                                    <figure class="tm-media-box-wrap">
                                                                                        <img src="{{ asset('back-end/img/sp/' . $quatang->sanpham->hinhanhsanphams->first()->img) }}" alt="{{ $quatang->sanpham->ten }}">
                                                                                    </figure>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="uk-width-expand">
                                                                            <div class="uk-text-xsmall" style="color: pink;">{{ $quatang->sanpham->danhmuc->ten }}</div>
                                                                            <a class="uk-link-heading uk-text-xsmall" href="{{ route('chitietsp', $quatang->sanphamidquatang) }}">
                                                                                {{ $quatang->sanpham->ten }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="uk-grid-small uk-child-width-1-1 uk-child-width-expand@s uk-text-center" uk-grid>
                                                                        <div>
                                                                            <div class="uk-text-muted uk-hidden@m uk-text-xsmall">Giá</div>
                                                                            <div class="uk-text-xsmall"><s>{{ number_format($quatang->sanpham->gia, 0, ',', '.') }}đ</s> 0đ</div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @else
                                                    <h2>Sản phẩm hiện tại chưa có quà tặng kèm</h2>
                                                    @endif
                                                </section>
                                                <section>
                                                    <ul class="uk-list-divider uk-list-large" uk-accordion="multiple: true">
                                                        <li><a class="uk-accordion-title" href="#">Khi mua ở VMSHOP
                                                                sẽ được đổi trả chứ?</a>
                                                            <div class="uk-accordion-content">Thắc mắc về chính sách
                                                                đổi trả</div>
                                                        </li>
                                                        <li><a class="uk-accordion-title" href="#">Bảo hành ở cửa
                                                                hàng hay sao?</a>
                                                            <div class="uk-accordion-content">Tìm hiểu chính sách
                                                                bảo hành.</div>
                                                        </li>
                                                        <li><a class="uk-accordion-title" href="#">VMS có hỗ trợ lắp
                                                                đặt RAM cho laptop?</a>
                                                            <div class="uk-accordion-content">Hỗ trợ lắp đặt hoàn
                                                                toàn miễn phí</div>
                                                        </li>
                                                    </ul>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section>
                            <div uk-slider="finite: true">
                                <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                                    <h2 class="uk-width-expand uk-text-center uk-text-left@s">Sản phẩm tương tự
                                    </h2>
                                    <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a>
                                    </div>
                                </div>
                                <div>
                                    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                        <div class="uk-position-relative">
                                            <div class="uk-slider-container">
                                                <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                                    @foreach($sptt as $i)
                                                    <article class="tm-product-card">
                                                        <div class="tm-product-card-media">
                                                            <div class="tm-ratio tm-ratio-4-3">
                                                                <a class="tm-media-box" href="{{route('chitietsp',['id'=> $i->id])}}">
                                                                    <div class="tm-product-card-labels">
                                                                        @if($i->daban >= 50)
                                                                        <span class="uk-label uk-label-warning">Bán chạy</span>
                                                                        @endif
                                                                        @if(Auth::check())
                                                                        @php
                                                                        $user = Auth::user();
                                                                        $isInterested = false;
                                                                        foreach ($user->quantams as $quantam) {
                                                                        foreach ($quantam->chitietquantams as $chitiet) {
                                                                        if ($chitiet->sanphamid == $i->id) {
                                                                        $isInterested = true;
                                                                        break 2;
                                                                        }
                                                                        }
                                                                        }
                                                                        @endphp
                                                                        @if($isInterested)
                                                                        <span class="uk-label uk-label-danger">Đang quan tâm</span>
                                                                        @endif
                                                                        @endif
                                                                    </div>
                                                                    <figure class="tm-media-box-wrap">
                                                                        @if($i->hinhanhsanphams->isNotEmpty())
                                                                        <img src="{{ asset('back-end/img/sp/' . $i->hinhanhsanphams->first()->img) }}" alt='anh' />
                                                                        @endif
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="tm-product-card-body">
                                                            <div class="tm-product-card-info">
                                                                <div class="uk-text-meta uk-margin-xsmall-bottom uk-text-xsmall">
                                                                    {{$i->danhmuc->ten}} / {{$i->nhasanxuat->ten}}
                                                                </div>
                                                                <h3 class="tm-product-card-title">
                                                                    <a class="uk-link-heading" href="{{route('chitietsp',['id'=> $i->id])}}">{{$i->ten}}</a>
                                                                </h3>
                                                                @if($i->danhmucid ==1)
                                                                <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;width:100%">
                                                                    <li>
                                                                        <span class="uk-text-muted">Màn hình</span>
                                                                        <span>
                                                                            @if ($i->thongsomanhinh->kichthuocs)
                                                                            <span>{{ $i->thongsomanhinh->kichthuocs->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">CPU:</span>
                                                                        <span>
                                                                            @if ($i->thongsohieunang->cpus)
                                                                            <span>{{ $i->thongsohieunang->cpus->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">RAM: </span>
                                                                        <span>
                                                                            @if ($i->thongsohieunang->rams)
                                                                            <span>{{ $i->thongsohieunang->rams->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">VGA:</span>
                                                                        <span>
                                                                            @if ($i->thongsohieunang->gpurois)
                                                                            <span>{{ $i->thongsohieunang->gpurois->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                @elseif($i->danhmucid == 2)
                                                                <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                                    <li>
                                                                        <span class="uk-text-muted">Loại:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkbanphim->loaibanphims)
                                                                            <span>{{ $i->thongsopkbanphim->loaibanphims->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Kiểu dáng:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkbanphim->kieudangbanphims)
                                                                            <span>{{ $i->thongsopkbanphim->kieudangbanphims->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Keycap:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkbanphim->keycaps)
                                                                            <span>{{ $i->thongsopkbanphim->keycaps->ten}}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                @elseif($i->danhmucid == 3)
                                                                <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                                    <li>
                                                                        <span class="uk-text-muted">Dung lượng:</span>
                                                                        <span>
                                                                            @if (isset($i->thongsopkram->dungluongs))
                                                                            <span>{{ $i->thongsopkram->dungluongs->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Loại:</span>
                                                                        <span>
                                                                            @if (isset($i->thongsopkram->loairams))
                                                                            <span>{{ $i->thongsopkram->loairams->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Bus:</span>
                                                                        <span>
                                                                            @if (isset($i->thongsopkram->tocdobuss))
                                                                            <span>{{ $i->thongsopkram->tocdobuss->ten}}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                @elseif($i->danhmucid == 4)
                                                                <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                                    <li>
                                                                        <span class="uk-text-muted">Kích thước:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkmanhinh->kichthuocs)
                                                                            <span>{{ $i->thongsopkmanhinh->kichthuocs->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Độ phân giải:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkmanhinh->dophangiais)
                                                                            <span>{{ $i->thongsopkmanhinh->dophangiais->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Tấm nền:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkmanhinh->tamnens)
                                                                            <span>{{ $i->thongsopkmanhinh->tamnens->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Tần số quét:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkmanhinh->tansoquets)
                                                                            <span>{{ $i->thongsopkmanhinh->tansoquets->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                @elseif($i->danhmucid == 5)
                                                                <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                                    <li>
                                                                        <span class="uk-text-muted">Loại:</span>
                                                                        <span>
                                                                            @if ($i->thongsopktainghe->loaiketnois)
                                                                            <span>{{ $i->thongsopktainghe->loaiketnois->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Kiểu:</span>
                                                                        <span>
                                                                            @if ($i->thongsopktainghe->kieutainghes)
                                                                            <span>{{ $i->thongsopktainghe->kieutainghes->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Kết nối:</span>
                                                                        <span>
                                                                            @if ($i->thongsopktainghe->congketnois)
                                                                            <span>{{ $i->thongsopktainghe->congketnois->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                @elseif($i->danhmucid == 7)
                                                                <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                                    <li>
                                                                        <span class="uk-text-muted">Loại:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkchuot->loaiketnois)
                                                                            <span>{{ $i->thongsopkchuot->loaiketnois->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="uk-text-muted">Kết nối:</span>
                                                                        <span>
                                                                            @if ($i->thongsopkchuot->kieuketnois)
                                                                            <span>{{ $i->thongsopkchuot->kieuketnois->ten }}</span>
                                                                            @else
                                                                            <span>Chưa có thông tin</span>
                                                                            @endif
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                @endif
                                                            </div>
                                                            <div class="tm-product-card-shop">
                                                                <div class="tm-product-card-prices">
                                                                    @if($i->giamgiahangloat !=null && $i->giamgiahangloat->tinhtrang==1)
                                                                    @php
                                                                    $a = $i->giamgiahangloat->phantramgiamgia * $i->gia / 100;
                                                                    $giam = $a > $i->giamgiahangloat->giamtoida ? $i->giamgiahangloat->giamtoida : $a;
                                                                    @endphp
                                                                    @endif
                                                                    @if($i->giamgia !=null && $i->giamgiahangloat !=null && $i->giamgia->danggiam == 1 && $i->giamgiahangloat->tinhtrang==1 && $i->giamgia->soluongsanpham >0 && $i->giamgiahangloat->soluongsanpham >0)
                                                                    <del> {{ number_format($i->gia) }}đ</del>
                                                                    <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                                        {{ number_format($i->gia - $i->giamgia->giagiam - $giam) }}đ
                                                                    </div>
                                                                    @elseif($i->giamgiahangloat && $i->giamgiahangloat->tinhtrang==1 && $i->giamgiahangloat->soluongsanpham >0)
                                                                    <del> {{ number_format($i->gia) }}đ</del>
                                                                    <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                                        {{ number_format($i->gia - $giam) }}đ
                                                                    </div>
                                                                    @elseif(isset($i->giamgia) && $i->giamgia->danggiam == 1 && $i->giamgia->soluongsanpham > 0 )
                                                                    <del> {{ number_format($i->gia) }}đ</del>
                                                                    <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                                        {{ number_format($i->gia - $i->giamgia->giagiam) }}đ
                                                                    </div>
                                                                    @else
                                                                    <div class="tm-product-card-price">
                                                                        {{ number_format($i->gia)}}đ
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="tm-product-card-add">
                                                                    <div class="uk-text-meta tm-product-card-actions">
                                                                        <a href="{{route('addquantam',['id'=>$i->id])}}" class="tm-product-card-action js-add-to js-add-to-favorites tm-action-button-active js-added-to" title="Quan tâm">
                                                                            <span uk-icon="icon: heart; ratio: .75;"></span>
                                                                        </a>
                                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('add-to-compare-{{ $i->id }}').submit();" class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" title="So sánh">
                                                                            <span uk-icon="icon: copy; ratio: .75;"></span>
                                                                        </a>
                                                                        <form id="add-to-compare-{{ $i->id }}" action="{{ route('addToCompare', $i->id) }}" method="POST" style="display: none;">
                                                                            @csrf
                                                                        </form>
                                                                    </div>
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
                                                    </article>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-top uk-hidden@s">
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(Auth::user())
    <div class="modal" id="danhgiaModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đánh giá sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('danhgia.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nguoidungid" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="sanphamid" value="{{ $sp->id }}">

                        <div class="form-group">
                            <label for="diem">Chọn sao:</label>
                            <select name="diem" id="diem" class="form-control" required>
                                <option value="1">1 sao</option>
                                <option value="2">2 sao</option>
                                <option value="3">3 sao</option>
                                <option value="4">4 sao</option>
                                <option value="5">5 sao</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="binhluan">Bình luận:</label>
                            <textarea name="binhluan" id="binhluan" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="uk-button uk-button-primary">Gửi đánh giá</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</main>

<script>
    const categoryBtn = document.getElementById("categoryBtn");
    const featureDropdown = document.getElementById("featureDropdown");
    const arrowIcon = document.getElementById('arrowIcon');

    categoryBtn.addEventListener("click", () => {
        featureDropdown.classList.toggle("open");
        arrowIcon.classList.toggle('fa-angle-up');
    });
    document.addEventListener("click", (event) => {
        if (!featureDropdown.contains(event.target) && !categoryBtn.contains(event.target)) {
            featureDropdown.classList.remove("open");
            arrowIcon.classList.remove('fa-angle-up');
        }
    });
</script>
<script>
    function increment(value, inputId) {
        var inputElement = document.getElementById(inputId);
        var currentValue = parseInt(inputElement.value);
        var newValue = currentValue + value;

        var maxValue = parseInt("{{$sp->soluong}}");
        if (newValue >= 1 && newValue <= maxValue) {
            inputElement.value = newValue;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const danhgiaItems = document.querySelectorAll('.danhgia-item');
        const loadMoreBtn = document.getElementById('load-more');
        let currentCount = 0;
        const initialLoad = 3;
        const increment = 10;

        function showItems(count) {
            for (let i = currentCount; i < currentCount + count && i < danhgiaItems.length; i++) {
                danhgiaItems[i].style.display = 'block';
            }
            currentCount += count;
            if (currentCount >= danhgiaItems.length) {
                loadMoreBtn.style.display = 'none';
            }
        }

        showItems(initialLoad); // Initial load
        loadMoreBtn.addEventListener('click', () => showItems(increment));
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-comment').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                var commentId = this.dataset.id;
                var article = this.closest('article');
                var commentContent = article.querySelector('.comment-content');
                var editForm = article.querySelector('.edit-comment-form');

                commentContent.style.display = 'none';
                editForm.style.display = 'block';
            });
        });

        document.querySelectorAll('.cancel-edit').forEach(function(button) {
            button.addEventListener('click', function() {
                var article = this.closest('article');
                var commentContent = article.querySelector('.comment-content');
                var editForm = article.querySelector('.edit-comment-form');

                editForm.style.display = 'none';
                commentContent.style.display = 'block';
            });
        });
    });
</script>




@endsection
