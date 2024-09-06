@extends('fe.pages.taikhoan')
@section('magiamgia')

<div class="uk-width-1-1 uk-width-expand@m">
    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
        <header class="uk-card-header">
            <h1 class="uk-h2">Mã giảm giá</h1>

            <div>
                <a class="uk-button uk-button-secondary" href="{{ route('magiamgia', ['tinhtrang' => 'chuasudung']) }}">Chưa sử dụng</a>
                <a class="uk-button uk-button-secondary" href="{{ route('magiamgia', ['tinhtrang' => 'dasudunghoachethan']) }}">Đã sử dụng và hết hạn</a>
            </div>

        </header>
        <div class="uk-grid-collapse tm-products-list" uk-grid>
            @foreach($mgg as $i)
            <article class="tm-product-card">
                <div class="tm-product-card-media">
                    <div class="tm-ratio tm-ratio-4-3">
                        <a class="tm-media-box">
                            <figure class="tm-media-box-wrap">
                                <img src="{{ asset('font-end/img/magiamgia.png')}}" alt='anh' />
                            </figure>
                        </a>
                    </div>
                </div>
                <div class="tm-product-card-body">
                    <div class="tm-product-card-info">
                        <div class="uk-text-meta uk-margin-xsmall-bottom uk-text-xsmall">
                            {{$i->magiamgia->magiamgia}}
                        </div>
                        <h3 class="tm-product-card-title" style="width:400px;height:300px;">
                            <div class="uk-link-heading">
                                <span style="color: red;">{{ $i->magiamgia->magiamgia}}: </span>
                                @if($i->magiamgia->phantramgiamgia)
                                <span>Giảm {{ number_format($i->magiamgia->phantramgiamgia) }}% cho đơn hàng <span style="color:#800000">{{ number_format($i->magiamgia->giatritoithieudonhang) }}VNĐ</span></span>
                                <span style="color:red">(Tối đa {{ number_format($i->magiamgia->sotiengiamgiatoida) }})</span>
                                <div style="font-size: 12px; margin-bottom:20px;">HSD: {{date('d/m/Y', strtotime($i->ngayhethan))}}</div>
                                @else
                                <span>Giảm trực tiếp {{ number_format($i->magiamgia->giamtructiep) }}VNĐ cho đơn hàng <span style="color:#800000">{{ number_format($i->magiamgia->giatritoithieudonhang) }}VNĐ</span></span>
                                <div style="font-size: 12px; margin-bottom:20px;">HSD: {{date('d/m/Y', strtotime($i->ngayhethan))}}</div>
                                @endif
                            </div>
                        </h3>
                    </div>
                    <div class="tm-product-card-shop">
                        @if(\Carbon\Carbon::today()->lte(\Carbon\Carbon::parse($i->ngayhethan)) && $i->dasudung == 0)
                        <a class="uk-button uk-button-primary uk-button-small use-discount-btn" href="/giohang">Sử dụng</a>
                        @elseif($i->dasudung == 1)
                        <button class="uk-button uk-button-primary uk-button-small use-discount-btn" disabled>Đã sử dụng</button>
                        @else
                        <button class="uk-button uk-button-primary uk-button-small use-discount-btn" disabled>Hết hạn</button>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>



@endsection
