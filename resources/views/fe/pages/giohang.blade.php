@extends('fe.index')
@section('title', 'Giỏ hàng')
@section('giohang')

<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="{{ route('index')}}">Trang chủ</a></li>
                        <li><span>Giỏ hàng</span></li>
                    </ul>
                    <h1 class="uk-margin-small-top uk-margin-remove-bottom">Giỏ hàng</h1>
                    <div style="color:red;font-size:15px;font-style: italic;margin-top:10px;">*Lưu ý: Giá tổng có thể thay đổi do hết số lượng khuyến mãi</div>
                </div>
                <div>
                    @if($giohang)
                    @if(Auth::check())
                    @if($giohang->chitietgiohangs->count() > 0)
                    <div class="uk-grid-medium" uk-grid>
                        <div class="uk-width-1-1 uk-width-expand@m">
                            <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                <header class="uk-card-header uk-text-uppercase uk-text-muted uk-text-center uk-text-small uk-visible@m">
                                    <div class="uk-grid-small uk-child-width-1-2" uk-grid>
                                        <div>Sản phẩm</div>
                                        <div>
                                            <div class="uk-grid-small uk-child-width-expand" uk-grid>
                                                <div>Giá</div>
                                                <div class="tm-quantity-column">Số lượng</div>
                                                <div>Tổng cộng</div>
                                                <div class="uk-width-auto">
                                                    <div style="width: 20px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </header>


                                @foreach($giohang->chitietgiohangs as $chitiet)
                                @php
                                $total_soluong_cahai = 0;
                                $total_gia_giam_cahai = 0;
                                $total_soluong_giamgia = 0;
                                $total_gia_giamgia = 0;
                                $total_soluong_giamgiahangloat = 0;
                                $total_gia_giamgiahangloat = 0;
                                $total_soluong_khonggiamgia = 0;
                                $total_gia_goc = 0;
                                $gia_giam_cahai = 0;
                                $gia_giamgia = 0;
                                $gia_giamgiahangloat = 0;
                                $soluong_cahai = 0;
                                $soluong_giamgia = 0;
                                $soluong_giamgiahangloat = 0;
                                $soluong_khonggiamgia = 0;

                                // Các tính toán như trước đây
                                $sanpham = $chitiet->sanpham;
                                $giamgia = $sanpham->giamgia ?? null;
                                $giamgiahangloat = $sanpham->giamgiahangloat ?? null;



                                $block = $sanpham->soluong <= 0;
                                $class = $block ? 'disabled-card' : '';

                                $gia_goc = $sanpham->gia;
                                $giamgia_value = $giamgia ? $giamgia->giagiam : 0;
                                $phantram_giamgiahangloat = $giamgiahangloat ? ($giamgiahangloat->phantramgiamgia * $gia_goc / 100) : 0;
                                $giamgiahangloat_value = $giamgiahangloat ? ($phantram_giamgiahangloat > $giamgiahangloat->giamtoida ? $giamgiahangloat->giamtoida : $phantram_giamgiahangloat) : 0;

                                if ($giamgia && $giamgiahangloat && $giamgia->danggiam == 1 && $giamgiahangloat->tinhtrang == 1 && $giamgia->soluongsanpham > 0 && $giamgiahangloat->soluongsanpham > 0) {
                                    $soluong_cahai = min($chitiet->soluong, min($giamgia->soluongsanpham, $giamgiahangloat->soluongsanpham));
                                    $soluong_giamgia = max(0, min($chitiet->soluong - $soluong_cahai, $giamgia->soluongsanpham - $soluong_cahai));
                                    $soluong_giamgiahangloat = max(0, min($chitiet->soluong - $soluong_cahai - $soluong_giamgia, $giamgiahangloat->soluongsanpham - $soluong_cahai));
                                    $soluong_khonggiamgia = $chitiet->soluong - $soluong_cahai - $soluong_giamgia - $soluong_giamgiahangloat;
                                    $gia_giam_cahai = $gia_goc - $giamgia_value - $giamgiahangloat_value;
                                } elseif ($giamgiahangloat && $giamgiahangloat->tinhtrang == 1 && $giamgiahangloat->soluongsanpham > 0) {
                                    $gia_giamgiahangloat = $gia_goc - $giamgiahangloat_value;
                                    $soluong_giamgiahangloat = max(0, min($chitiet->soluong, $giamgiahangloat->soluongsanpham));
                                    $soluong_khonggiamgia = $chitiet->soluong - $soluong_giamgiahangloat;
                                } elseif ($giamgia && $giamgia->danggiam == 1 && $giamgia->soluongsanpham > 0) {
                                    $gia_giamgia = $gia_goc - $giamgia_value;
                                    $soluong_giamgia = max(0, min($chitiet->soluong, $giamgia->soluongsanpham));
                                    $soluong_khonggiamgia = $chitiet->soluong - $soluong_giamgia;
                                } else {
                                    $soluong_khonggiamgia = $chitiet->soluong;
                                }

                                $total_soluong_cahai += $soluong_cahai;
                                $total_gia_giam_cahai += $soluong_cahai * $gia_giam_cahai;
                                $total_soluong_giamgia += $soluong_giamgia;
                                $total_gia_giamgia += $soluong_giamgia * $gia_giamgia;
                                $total_soluong_giamgiahangloat += $soluong_giamgiahangloat;
                                $total_gia_giamgiahangloat += $soluong_giamgiahangloat * $gia_giamgiahangloat;
                                $total_soluong_khonggiamgia += $soluong_khonggiamgia;
                                $total_gia_goc += $soluong_khonggiamgia * $gia_goc;

                                @endphp
                                <div class="uk-card-body {{$class}}">
                                    @if($block)
                                    <div class="out-of-stock">Sản phẩm hết hàng</div>
                                    @endif
                                    <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m uk-flex-middle" uk-grid>
                                        <div>
                                            <div class="uk-grid-small" uk-grid>
                                                <div class="uk-width-1-3">
                                                    <div class="tm-ratio tm-ratio-4-3">
                                                        <a class="tm-media-box" href="{{ route('chitietsp', $chitiet->sanphamid) }}">
                                                            <figure class="tm-media-box-wrap">
                                                                <img src="{{ asset('back-end/img/sp/' . $sanpham->hinhanhsanphams->first()->img) }}" alt="{{ $sanpham->ten }}">
                                                            </figure>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="uk-width-expand">
                                                    <div class="uk-text-meta" style="font-size: 16px;">{{ $sanpham->danhmuc->ten }}</div>
                                                    <a class="uk-link-heading" href="{{ route('chitietsp', $chitiet->sanphamid) }}">
                                                        {{ $sanpham->ten }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-expand@s uk-text-center" uk-grid>
                                                <div>
                                                    <div class="uk-text-muted uk-hidden@m">Giá</div>
                                                    @if ($soluong_cahai > 0 && $sanpham->giamgia !=null && $sanpham->giamgiahangloat !=null && $sanpham->giamgia->danggiam == 1 && $sanpham->giamgiahangloat->tinhtrang==1 && $sanpham->giamgia->soluongsanpham >0 && $sanpham->giamgiahangloat->soluongsanpham >0 )
                                                    <del>{{ number_format($gia_goc) }} đ</del>
                                                    <div style="color: red;">{{ number_format($gia_giam_cahai) }}đ</div>
                                                    @elseif (isset($sanpham->giamgia) && $sanpham->giamgia->danggiam == 1 && $sanpham->giamgia->soluongsanpham > 0)
                                                    <del>{{ number_format($gia_goc) }} đ</del>
                                                    <div style="color: red;">{{ number_format($gia_giamgia) }} đ</div>
                                                    @elseif($sanpham->giamgiahangloat && $sanpham->giamgiahangloat->tinhtrang==1 && $sanpham->giamgiahangloat->soluongsanpham >0 )
                                                    <del>{{ number_format($gia_goc) }} đ</del>
                                                    <div style="color: red;">{{ number_format($gia_giamgiahangloat) }} đ</div>
                                                    @else
                                                    <div>{{ number_format($gia_goc) }} đ</div>
                                                    @endif
                                                </div>
                                                <div class="tm-cart-quantity-column">
                                                    <div class="tm-cart-quantity-column">
                                                        <div class="tm-cart-quantity-column">
                                                            <a onclick="changeQuantity('{{ $chitiet->sanphamid }}', '{{ $chitiet->giohangid }}', -1)" uk-icon="icon: minus; ratio: .75"></a>
                                                            <input class="uk-input tm-quantity-input" id="quantity-{{ $chitiet->sanphamid }}" type="number" min="1" max="{{ $chitiet->sanpham->soluong }}" value="{{ $chitiet->soluong }}" readonly />
                                                            <a onclick="changeQuantity('{{ $chitiet->sanphamid }}', '{{ $chitiet->giohangid }}', 1)" uk-icon="icon: plus; ratio: .75"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="uk-text-muted uk-hidden@m">Tổng cộng</div>
                                                    <div>
                                                        {{ number_format(
                                                        $total_gia_giam_cahai +
                                                        $total_gia_giamgia +
                                                        $total_gia_giamgiahangloat +
                                                        $total_gia_goc
                                                    ) }}đ
                                                    </div>
                                                </div>
                                                <div class="uk-width-auto@s remove-btn">
                                                    <a class="uk-text-danger" uk-tooltip="Remove" href="{{ route('giohang.remove', $chitiet->id) }}">
                                                        <span uk-icon="icon: close; ratio: .75"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($chitiet->sanpham->quatangs) && $chitiet->sanpham->quatangs->count() > 0)
                                    @php
                                    $hasDisplayedHeader = false;
                                    @endphp
                                    @foreach($chitiet->sanpham->quatangs as $quatang)
                                    @if(\Carbon\Carbon::parse($quatang->ngayketthuc)->gte(\Carbon\Carbon::now()) && $quatang->soluong > 0 )

                                    @if(!$hasDisplayedHeader)
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
                                            @php $hasDisplayedHeader = true; @endphp
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
                                        </ul>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    @if($hasDisplayedHeader)
                                    @endif
                                    @endif
                                </div>
                                @endforeach
                                <div class="uk-card-footer">
                                    <label>
                                        <span class="uk-form-label uk-margin-small-right">Mã giảm giá</span>
                                        <div class="uk-inline">
                                            <a class="uk-form-icon uk-form-icon-flip" href="#discountModal" uk-icon="arrow-right" uk-toggle></a>
                                            <input id="discountInput" class="uk-input uk-form-width-small" style="width: 200px;" type="text">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 tm-aside-column uk-width-1-4@m">
                            <div class="uk-card uk-card-default uk-card-small tm-ignore-container" uk-sticky="offset: 30; bottom: true; media: @m;">
                                <div class="uk-card-body">
                                    <div class="uk-grid-small" uk-grid>
                                        @php
                                        $tongtam = $giohang->chitietgiohangs->sum(function ($chitiet) {
                                        $sanpham = $chitiet->sanpham;
                                        $soluong = $chitiet->soluong;
                                        $gia_goc = $sanpham->gia;

                                        $giamgia = $sanpham->giamgia ?? null;
                                        $giamgiahangloat = $sanpham->giamgiahangloat ?? null;

                                        $giamgia_value = $giamgia ? $giamgia->giagiam : 0;
                                        $phantram_giamgiahangloat = $giamgiahangloat ? ($giamgiahangloat->phantramgiamgia * $gia_goc / 100) : 0;
                                        $giamgiahangloat_value = $giamgiahangloat ? ($phantram_giamgiahangloat > $giamgiahangloat->giamtoida ? $giamgiahangloat->giamtoida : $phantram_giamgiahangloat) : 0;

                                        $soluong_cahai = 0;
                                        $soluong_giamgia = 0;
                                        $soluong_giamgiahangloat = 0;
                                        $soluong_khonggiamgia = 0;

                                        $tong_tam = 0;

                                        if ($giamgia && $giamgiahangloat && $giamgia->danggiam == 1 && $giamgiahangloat->tinhtrang == 1 && $giamgia->soluongsanpham > 0 && $giamgiahangloat->soluongsanpham > 0) {
                                        $soluong_cahai = min($soluong, min($giamgia->soluongsanpham, $giamgiahangloat->soluongsanpham));
                                        $soluong_giamgia = max(0, min($soluong - $soluong_cahai, $giamgia->soluongsanpham - $soluong_cahai));
                                        $soluong_giamgiahangloat = max(0, min($soluong - $soluong_cahai - $soluong_giamgia, $giamgiahangloat->soluongsanpham - $soluong_cahai));
                                        $soluong_khonggiamgia = $soluong - $soluong_cahai - $soluong_giamgia - $soluong_giamgiahangloat;
                                        $tong_tam += $soluong_cahai * ($gia_goc - $giamgia_value - $giamgiahangloat_value);
                                        } elseif ($giamgiahangloat && $giamgiahangloat->tinhtrang == 1 && $giamgiahangloat->soluongsanpham > 0) {
                                        $soluong_giamgiahangloat = max(0, min($soluong, $giamgiahangloat->soluongsanpham));
                                        $soluong_khonggiamgia = $soluong - $soluong_giamgiahangloat;
                                        $tong_tam += $soluong_giamgiahangloat * ($gia_goc - $giamgiahangloat_value);
                                        } elseif ($giamgia && $giamgia->danggiam == 1 && $giamgia->soluongsanpham > 0) {
                                        $soluong_giamgia = max(0, min($soluong, $giamgia->soluongsanpham));
                                        $soluong_khonggiamgia = $soluong - $soluong_giamgia;
                                        $tong_tam += $soluong_giamgia * ($gia_goc - $giamgia_value);
                                        } else {
                                        $soluong_khonggiamgia = $soluong;
                                        }
                                        $tong_tam += $soluong_khonggiamgia * $gia_goc;

                                        return $tong_tam;
                                        });
                                        @endphp
                                        <div class="uk-width-expand uk-text-muted">Tổng</div>
                                        <div id="total" data-total-amount="{{$tongtam}}">
                                            {{ number_format($tongtam)}}đ
                                        </div>
                                    </div>

                                    <div class="uk-grid-small" uk-grid>
                                        <div class="uk-width-expand uk-text-muted">Mã giảm Giá</div>
                                        <div class="uk-text-danger" id="discount-amount">-0đ</div>
                                    </div>
                                    <div id="discountModal" uk-modal>
                                        <div class="uk-modal-dialog uk-modal-body">
                                            <h2 class="uk-modal-title">Chọn Mã Giảm Giá</h2>
                                            <ul class="uk-list uk-list-divider">
                                                @foreach($mgg as $discount)
                                                @if(\Carbon\Carbon::today()->lte(\Carbon\Carbon::parse($discount->ngayhethan)) && $discount->dasudung == 0)
                                                <li>
                                                    <span style="color: red;">{{ $discount->magiamgia->magiamgia}}: </span>
                                                    @if($discount->magiamgia->phantramgiamgia)
                                                    <span>Giảm {{ number_format($discount->magiamgia->phantramgiamgia) }}% cho đơn hàng <span style="color:#800000">{{ number_format($discount->magiamgia->giatritoithieudonhang) }}VNĐ</span></span>
                                                    <div style="color:red">(Tối đa {{ number_format($discount->magiamgia->sotiengiamgiatoida) }})</div>
                                                    <div style="font-size: 12px; margin-bottom:20px;">HSD: {{date('d/m/Y', strtotime($discount->ngayhethan))}}</div>
                                                    @if($discount->magiamgia->giatritoithieudonhang < $tongtam) <button class="uk-button uk-button-primary uk-button-small use-discount-btn" data-discount-id="{{$discount->id}}" data-discount="{{ $discount->magiamgia->magiamgia }}" data-discount-type="percent" data-discount-value="{{ $discount->magiamgia->phantramgiamgia }}" data-max-discount="{{ $discount->magiamgia->sotiengiamgiatoida }}">Sử dụng</button>
                                                        @else
                                                        <button class="uk-button uk-button-primary uk-button-small use-discount-btn" disabled>Đơn hàng chưa đủ yêu cầu</button>
                                                        @endif
                                                        @else
                                                        <span>Giảm trực tiếp {{ number_format($discount->magiamgia->giamtructiep) }}VNĐ cho đơn hàng <span style="color:#800000">{{ number_format($discount->magiamgia->giatritoithieudonhang) }}VNĐ</span></span>
                                                        <div style="font-size: 12px; margin-bottom:20px;">HSD: {{date('d/m/Y', strtotime($discount->ngayhethan))}}</div>
                                                        @if($discount->magiamgia->giatritoithieudonhang < $tongtam) <button class="uk-button uk-button-primary uk-button-small use-discount-btn" data-discount-id="{{$discount->id}}" data-discount="{{ $discount->magiamgia->magiamgia }}" data-discount-type="direct" data-discount-value="{{ $discount->magiamgia->giamtructiep }}">Sử dụng</button>
                                                            @else
                                                            <button class="uk-button uk-button-primary uk-button-small use-discount-btn" disabled>Đơn hàng chưa đủ yêu cầu</button>
                                                            @endif
                                                            @endif
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                            <button class="uk-modal-close-default" type="button" uk-close></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-card-body">
                                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                                        <div class="uk-width-expand uk-text-muted">Tổng cộng</div>
                                        <div class="uk-text-lead uk-text-bolder" id="final-total">{{number_format($tongtam)}}</div>
                                    </div>
                                    @if($block == false)
                                    <a class="uk-button uk-button-primary uk-margin-small uk-width-1-1" href="{{route('thanhtoan')}}">Thanh toán</a>
                                    @else
                                    <button class="uk-button uk-button-primary uk-margin-small uk-width-1-1" disabled>Hiện có sản phẩm đang hết hàng</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="uk-card-body">
                        <div class="uk-text-center">
                            <p>Giỏ hàng của bạn đang trống.</p>
                        </div>
                    </div>
                    @endif
                    @else
                    @if(count($giohang) > 0)
                    <div class="uk-grid-medium" uk-grid>
                        <div class="uk-width-1-1 uk-width-expand@m">
                            <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                <header class="uk-card-header uk-text-uppercase uk-text-muted uk-text-center uk-text-small uk-visible@m">
                                    <div class="uk-grid-small uk-child-width-1-2" uk-grid>
                                        <div>Sản phẩm</div>
                                        <div>
                                            <div class="uk-grid-small uk-child-width-expand" uk-grid>
                                                <div>Giá</div>
                                                <div class="tm-quantity-column">Số lượng</div>
                                                <div>Tổng cộng</div>
                                                <div class="uk-width-auto">
                                                    <div style="width: 20px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                @foreach($giohang as $sanphamid => $details)
                                @php
                                $sanpham = App\Models\Sanpham::find($sanphamid);
                                @endphp
                                @if ($sanpham)
                                <div class="uk-card-body">
                                    <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m uk-flex-middle" uk-grid>
                                        <div>
                                            <div class="uk-grid-small" uk-grid>
                                                <div class="uk-width-1-3">
                                                    <div class="tm-ratio tm-ratio-4-3">
                                                        <a class="tm-media-box" href="{{ route('chitietsp', $sanphamid) }}">
                                                            <figure class="tm-media-box-wrap">
                                                                <img src="{{ asset('back-end/img/sp/' . $sanpham->hinhanhsanphams->first()->img) }}" alt="{{ $sanpham->ten }}">
                                                            </figure>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="uk-width-expand">
                                                    <div class="uk-text-meta">{{ $sanpham->danhmuc->ten }}</div>
                                                    <a class="uk-link-heading" href="{{ route('chitietsp', $sanphamid) }}">
                                                        {{ $sanpham->ten }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-expand@s uk-text-center" uk-grid>
                                                <div>
                                                    <div class="uk-text-muted uk-hidden@m">Giá</div>
                                                    <div>{{ number_format($sanpham->gia, 0, ',', '.') }}đ</div>
                                                </div>
                                                <div class="tm-cart-quantity-column">
                                                    <div class="tm-cart-quantity-column">
                                                        <!-- <a onclick="increment(-1, 'product-{{ $sanphamid }}')" uk-icon="icon: minus; ratio: .75"></a> -->
                                                        <input class="uk-input tm-quantity-input" id="product-{{ $sanphamid }}" type="text" maxlength="3" value="{{ $details['soluong'] }}" readonly />
                                                        <!-- <a onclick="increment(1, 'product-{{ $sanphamid }}')" uk-icon="icon: plus; ratio: .75"></a> -->
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="uk-text-muted uk-hidden@m">Tổng cộng</div>
                                                    <div>{{ number_format($details['soluong'] * $sanpham->gia, 0, ',', '.') }}đ</div>
                                                </div>
                                                <div class="uk-width-auto@s">
                                                    <a class="uk-text-danger" uk-tooltip="Remove" href="{{ route('giohang.removess', $sanphamid) }}">
                                                        <span uk-icon="close"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($sanpham->quatangs) && $sanpham->quatangs->count() > 0)
                                    @php
                                    $hasDisplayedHeader = false;
                                    @endphp
                                    @foreach($sanpham->quatangs as $quatang)
                                    @if(\Carbon\Carbon::parse($quatang->ngayketthuc)->gte(\Carbon\Carbon::now()))
                                    @if(!$hasDisplayedHeader)
                                    <div class="uk-margin-top uk-text-xsmall uk-text-success">
                                        <strong>Quà tặng:</strong>
                                        <header class="uk-card-header uk-text-uppercase uk-text-muted uk-text-center uk-text-xsmall uk-visible@m">
                                            <div class="uk-grid-small uk-child-width-1-2" uk-grid>
                                                <div>Sản phẩm</div>
                                                <div>
                                                    <div class="uk-grid-small uk-child-width-expand" uk-grid>
                                                        <div>Giá</div>
                                                        <div class="tm-quantity-column">Số lượng</div>
                                                        <div class="uk-width-auto">
                                                            <div style="width: 20px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </header>
                                        <ul class="uk-list uk-list-bullet uk-margin-remove">
                                            @php $hasDisplayedHeader = true; @endphp
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
                                                        <div class="tm-cart-quantity-column uk-text-xsmall">
                                                            <div>{{ $quatang->soluong }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    @if($hasDisplayedHeader)
                                    @endif
                                    @endif
                                </div>
                                @endif
                                @endforeach
                                <div class="uk-card-footer">
                                    <label>
                                        <span class="uk-form-label uk-margin-small-right">Mã giảm giá</span>
                                        <div class="uk-inline">
                                            <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="arrow-right"></a>
                                            <input class="uk-input uk-form-width-small" type="text" readonly>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 tm-aside-column uk-width-1-4@m">
                            <div class="uk-card uk-card-default uk-card-small tm-ignore-container" uk-sticky="offset: 30; bottom: true; media: @m;">
                                <div class="uk-card-body">
                                    <div class="uk-grid-small" uk-grid>
                                        <div class="uk-width-expand uk-text-muted">Tổng</div>
                                        <div id="total">{{ number_format(array_sum(array_map(function ($details) {
                                                        return $details['soluong'] * $details['gia'];
                                                    }, $giohang)), 0, ',', '.') }}đ</div>
                                    </div>
                                    <div class="uk-grid-small" uk-grid>
                                        <div class="uk-width-expand uk-text-muted">Mã giảm Giá</div>
                                        <div class="uk-text-danger">-0đ</div>
                                    </div>
                                </div>
                                <div class="uk-card-body">
                                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                                        <div class="uk-width-expand uk-text-muted">Tổng cộng</div>
                                        <div class="uk-text-lead uk-text-bolder">{{ number_format(array_sum(array_map(function ($details) {
                                                        return $details['soluong'] * $details['gia'];
                                                    }, $giohang)), 0, ',', '.') }}đ</div>
                                    </div>
                                    <a class="uk-button uk-button-primary uk-margin-small uk-width-1-1" href="/dangnhap">Đăng nhập ngay để thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="uk-card-body">
                        <div class="uk-text-center">
                            <p>Giỏ hàng của bạn đang trống.</p>
                        </div>
                    </div>
                    @endif
                    @endif
                    @else
                    <div class="uk-card-body">
                        <div class="uk-text-center">
                            <p>Giỏ hàng của bạn đang trống.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function changeQuantity(sanphamid, giohangid, change) {
        var quantityInput = document.getElementById('quantity-' + sanphamid);
        var currentQuantity = parseInt(quantityInput.value);
        var maxQuantity = parseInt(quantityInput.max);

        var newQuantity = currentQuantity + change;

        if (newQuantity >= 1 && newQuantity <= maxQuantity) {
            quantityInput.value = newQuantity;
            updateCart(newQuantity, sanphamid, giohangid);
        } else {
            if (newQuantity < 1) {
                Swal.fire({
                    icon: 'error',
                    title: "Số lượng không thể nhỏ hơn 1",
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: "Vượt quá số lượng trong kho",
                    showConfirmButton: false,
                });
            }
        }
    }

    function updateCart(quantity, sanphamid, giohangid) {
        $.ajax({
            url: '{{ route("giohang.update.quantity") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                productId: sanphamid,
                giohangId: giohangid,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    location.reload(); // Reload the page or update UI as needed
                } else {
                    alert('Có lỗi xảy ra khi cập nhật số lượng.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
                alert('Status: ' + status);
                alert('Response: ' + xhr.responseText);
            }
        });
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var useDiscountBtns = document.querySelectorAll('.use-discount-btn');
        useDiscountBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var discountCode = this.getAttribute('data-discount');
                var discountType = this.getAttribute('data-discount-type');
                var discountId = this.getAttribute('data-discount-id');
                var discountValue = parseFloat(this.getAttribute('data-discount-value'));
                var maxDiscount = parseFloat(this.getAttribute('data-max-discount'));
                var totalElement = document.getElementById('total');
                var totalAmount = parseFloat(totalElement.getAttribute('data-total-amount'));
                document.getElementById('discountInput').value = discountCode;
                var discountAmount = 0;
                if (discountType === 'percent') {
                    discountAmount = Math.floor((discountValue / 100) * totalAmount);
                    if (!isNaN(maxDiscount) && discountAmount > maxDiscount) {
                        discountAmount = maxDiscount;
                    }
                } else if (discountType === 'direct') {
                    discountAmount = discountValue;
                }
                var newTotal = totalAmount - discountAmount;
                document.getElementById('discount-amount').innerText = '-' + number_format(discountAmount) + 'đ';
                document.getElementById('final-total').innerText = number_format(newTotal) + 'đ';
                UIkit.modal('#discountModal').hide();


                $.ajax({
                    url: '{{ route("save.discount") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        discount_code: discountCode,
                        discount_amount: discountAmount,
                        discount_id: discountId
                    },
                    success: function(response) {
                        // if (response.success) {
                        //     alert('Mã giảm giá đã được lưu.');
                        // } else {
                        //     alert('Có lỗi xảy ra, vui lòng thử lại.');
                        // }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                        alert('Status: ' + status);
                        alert('Response: ' + xhr.responseText);
                    }
                });
            });
        });
    });

    function number_format(number, decimals = 0, dec_point = '.', thousands_sep = ',') {
        var n = number,
            prec = decimals;
        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k).toFixed(prec);
        };
        n = !isFinite(+n) ? 0 : +n;
        prec = !isFinite(+prec) ? 0 : Math.abs(prec);
        var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
        var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;
        var s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>








@endsection
