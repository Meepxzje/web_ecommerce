@extends('fe.index')
@section('title', 'Home Page')
@section('home')

<main>


    <!-- menu -->
    <div class="feature">
        <div class="main-content">
            <div class="body-feature">
                <div class="feature-list">
                    @foreach ($dms as $i)
                    @if($i->id == 1)
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-laptop icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">{{ $i->ten }}</a></p>
                    </div>
                    @elseif($i->id == 2)
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-keyboard icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">Bàn phím</a></p>
                    </div>
                    @elseif($i->id == 3)
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-memory icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">Ram</a></p>
                    </div>
                    @elseif($i->id == 4)
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-desktop icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">Màn hình</a></p>
                    </div>
                    @elseif($i->id == 5)
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-headphones icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">Tai nghe</a></p>
                    </div>
                    @elseif($i->id == 7)
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-mouse icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">Chuột </a></p>
                    </div>
                    @endif
                    @endforeach
                    <div class="item">
                        <a href="/spgiamgia"><i class="fa-solid fa-tag icon"></i></a>
                        <p class="item-title"><a href="/spgiamgia">Giảm giá</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- san pham ban chay-->
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Sản phẩm bán chạy nhất của website
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($sp as $i)
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
                                                    @if($i->danhmuc->ten == 'Laptop' || ($i->danhmuc->parent && $i->danhmuc->parent->ten == 'Laptop'))
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


    <!--san pham ban chay thang-->
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Sản phẩm bán chạy nhất của tháng {{ now()->format('m') }}
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($banchaythang as $i)
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
                                                    @if($i->danhmuc->ten == 'Laptop' || ($i->danhmuc->parent && $i->danhmuc->parent->ten == 'Laptop'))
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


    @if(count($dexuatmatrix)>0)
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Đề xuất ma trận chưa xem
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($dexuatmatrix as $i)
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
                                                    @if($i->danhmuc->ten == 'Laptop' || ($i->danhmuc->parent && $i->danhmuc->parent->ten == 'Laptop'))
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
    @endif




    @if(count($dexuatmatrixdonhang)>0)
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Đề xuất ma trận chưa mua
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($dexuatmatrixdonhang as $i)
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
                                                    @if($i->danhmuc->ten == 'Laptop' || ($i->danhmuc->parent && $i->danhmuc->parent->ten == 'Laptop'))
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
    @endif


    @if(count($recommendSanphams)>0)
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Dựa vào sản phẩm bạn vừa xem, chúng tôi đề xuất
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($recommendSanphams as $i)
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
                                                    @if($i->danhmuc->ten == 'Laptop' || ($i->danhmuc->parent && $i->danhmuc->parent->ten == 'Laptop'))
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
    @endif



    @if(count($viewedSanphams)>0)
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Sản phẩm vừa xem (DB)
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($viewedSanphams as $i)
                                        @if($i->sanpham)
                                        <article class="tm-product-card">
                                            <div class="tm-product-card-media">
                                                <div class="tm-ratio tm-ratio-4-3">
                                                    <a class="tm-media-box" href="{{route('chitietsp',['id'=> $i->id])}}">
                                                        <div class="tm-product-card-labels">
                                                            @if($i->sanpham->daban >= 50)
                                                            <span class="uk-label uk-label-warning">Bán chạy</span>
                                                            @endif
                                                            @if(Auth::check())
                                                            @php
                                                            $user = Auth::user();
                                                            $isInterested = false;
                                                            foreach ($user->quantams as $quantam) {
                                                            foreach ($quantam->chitietquantams as $chitiet) {
                                                            if ($chitiet->sanphamid == $i->sanpham->id) {
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
                                                            @if($i->sanpham && $i->sanpham->hinhanhsanphams->isNotEmpty())
                                                            <img src="{{ asset('back-end/img/sp/' . $i->sanpham->hinhanhsanphams->first()->img) }}" alt='anh' />
                                                            @endif
                                                        </figure>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="tm-product-card-body">
                                                <div class="tm-product-card-info">
                                                    <div class="uk-text-meta uk-margin-xsmall-bottom uk-text-xsmall">

                                                        {{$i->sanpham->danhmuc->ten}} / {{$i->sanpham->nhasanxuat->ten}}

                                                    </div>
                                                    <h3 class="tm-product-card-title">
                                                        <a class="uk-link-heading" href="{{route('chitietsp',['id'=> $i->id])}}">{{$i->ten}}</a>
                                                    </h3>
                                                    @if($i->sanpham->danhmuc->ten == 'Laptop' || ($i->sanpham->danhmuc->parent && $i->sanpham->danhmuc->parent->ten == 'Laptop'))
                                                    <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;width:100%">
                                                        <li>
                                                            <span class="uk-text-muted">Màn hình</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsomanhinh->kichthuocs)
                                                                <span>{{ $i->sanpham->thongsomanhinh->kichthuocs->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">CPU:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsohieunang->cpus)
                                                                <span>{{ $i->sanpham->thongsohieunang->cpus->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">RAM: </span>
                                                            <span>
                                                                @if ($i->sanpham->thongsohieunang->rams)
                                                                <span>{{ $i->sanpham->thongsohieunang->rams->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">VGA:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsohieunang->gpurois)
                                                                <span>{{ $i->sanpham->thongsohieunang->gpurois->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    @elseif($i->sanpham->danhmucid == 2)
                                                    <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                        <li>
                                                            <span class="uk-text-muted">Loại:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkbanphim->loaibanphims)
                                                                <span>{{ $i->sanpham->thongsopkbanphim->loaibanphims->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Kiểu dáng:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkbanphim->kieudangbanphims)
                                                                <span>{{ $i->sanpham->thongsopkbanphim->kieudangbanphims->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Keycap:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkbanphim->keycaps)
                                                                <span>{{ $i->sanpham->thongsopkbanphim->keycaps->ten}}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    @elseif($i->sanpham->danhmucid == 3)
                                                    <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                        <li>
                                                            <span class="uk-text-muted">Dung lượng:</span>
                                                            <span>
                                                                @if (isset($i->sanpham->thongsopkram->dungluongs))
                                                                <span>{{ $i->sanpham->thongsopkram->dungluongs->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Loại:</span>
                                                            <span>
                                                                @if (isset($i->sanpham->thongsopkram->loairams))
                                                                <span>{{ $i->sanpham->thongsopkram->loairams->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Bus:</span>
                                                            <span>
                                                                @if (isset($i->sanpham->thongsopkram->tocdobuss))
                                                                <span>{{ $i->sanpham->thongsopkram->tocdobuss->ten}}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    @elseif($i->sanpham->danhmucid == 4)
                                                    <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                        <li>
                                                            <span class="uk-text-muted">Kích thước:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkmanhinh->kichthuocs)
                                                                <span>{{ $i->sanpham->thongsopkmanhinh->kichthuocs->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Độ phân giải:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkmanhinh->dophangiais)
                                                                <span>{{ $i->sanpham->thongsopkmanhinh->dophangiais->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Tấm nền:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkmanhinh->tamnens)
                                                                <span>{{ $i->sanpham->thongsopkmanhinh->tamnens->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Tần số quét:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkmanhinh->tansoquets)
                                                                <span>{{ $i->sanpham->thongsopkmanhinh->tansoquets->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    @elseif($i->sanpham->danhmucid == 5)
                                                    <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                        <li>
                                                            <span class="uk-text-muted">Loại:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopktainghe->loaiketnois)
                                                                <span>{{ $i->sanpham->thongsopktainghe->loaiketnois->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Kiểu:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopktainghe->kieutainghes)
                                                                <span>{{ $i->sanpham->thongsopktainghe->kieutainghes->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Kết nối:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopktainghe->congketnois)
                                                                <span>{{ $i->sanpham->thongsopktainghe->congketnois->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    @elseif($i->sanpham->danhmucid == 7)
                                                    <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                        <li>
                                                            <span class="uk-text-muted">Loại:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkchuot->loaiketnois)
                                                                <span>{{ $i->sanpham->thongsopkchuot->loaiketnois->ten }}</span>
                                                                @else
                                                                <span>Chưa có thông tin</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="uk-text-muted">Kết nối:</span>
                                                            <span>
                                                                @if ($i->sanpham->thongsopkchuot->kieuketnois)
                                                                <span>{{ $i->sanpham->thongsopkchuot->kieuketnois->ten }}</span>
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
                                                        @if($i->sanpham->giamgiahangloat !=null && $i->sanpham->giamgiahangloat->tinhtrang==1)
                                                        @php
                                                        $a = $i->sanpham->giamgiahangloat->phantramgiamgia * $i->sanpham->gia / 100;
                                                        $giam = $a > $i->sanpham->giamgiahangloat->giamtoida ? $i->sanpham->giamgiahangloat->giamtoida : $a;
                                                        @endphp
                                                        @endif
                                                        @if($i->sanpham->giamgia !=null && $i->sanpham->giamgiahangloat !=null && $i->sanpham->giamgia->danggiam == 1 && $i->sanpham->giamgiahangloat->tinhtrang==1 && $i->sanpham->giamgia->soluongsanpham >0 && $i->sanpham->giamgiahangloat->soluongsanpham >0)
                                                        <del> {{ number_format($i->sanpham->gia) }}đ</del>
                                                        <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                            {{ number_format($i->sanpham->gia - $i->sanpham->giamgia->giagiam - $giam) }}đ
                                                        </div>
                                                        @elseif($i->sanpham->giamgiahangloat && $i->sanpham->giamgiahangloat->tinhtrang==1 && $i->sanpham->giamgiahangloat->soluongsanpham >0)
                                                        <del> {{ number_format($i->sanpham->gia) }}đ</del>
                                                        <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                            {{ number_format($i->sanpham->gia - $giam) }}đ
                                                        </div>
                                                        @elseif(isset($i->sanpham->giamgia) && $i->sanpham->giamgia->danggiam == 1 && $i->sanpham->giamgia->soluongsanpham > 0 )
                                                        <del> {{ number_format($i->sanpham->gia) }}đ</del>
                                                        <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                            {{ number_format($i->sanpham->gia - $i->sanpham->giamgia->giagiam) }}đ
                                                        </div>
                                                        @else
                                                        <div class="tm-product-card-price">
                                                            {{ number_format($i->sanpham->gia)}}đ
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="tm-product-card-add">
                                                        <div class="uk-text-meta tm-product-card-actions">
                                                            <a href="{{route('addquantam',['id'=>$i->sanpham->id])}}" class="tm-product-card-action js-add-to js-add-to-favorites tm-action-button-active js-added-to" title="Quan tâm">
                                                                <span uk-icon="icon: heart; ratio: .75;"></span>
                                                            </a>
                                                            <a href="#" onclick="event.preventDefault(); document.getElementById('add-to-compare-{{ $i->sanpham->id }}').submit();" class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" title="So sánh">
                                                                <span uk-icon="icon: copy; ratio: .75;"></span>
                                                            </a>
                                                            <form id="add-to-compare-{{ $i->sanpham->id }}" action="{{ route('addToCompare', $i->sanpham->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <form action="{{ route('giohang.addToCart') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="sanphamid" value="{{ $i->sanpham->id }}">
                                                                <input type="hidden" name="gia" value="{{ $i->sanpham->gia }}">
                                                                <button class="uk-button uk-button-primary tm-product-card-add-button tm-shine js-add-to-cart" type="submit">
                                                                    <span class="tm-product-card-add-button-icon" uk-icon="cart"></span><span class="tm-product-card-add-button-text">Thêm vào giỏ hàng</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        @endif
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
    @endif


    @if(count($viewedSanphamss)>0)
    <div class="hero">
        <div class="main-content">
            <section>
                <div uk-slider="finite: true">
                    <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                        <h2 class="uk-width-expand uk-text-center uk-text-left@s">Sản phẩm vừa xem (session)
                        </h2>
                        <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <div class="uk-position-relative">
                                <div class="uk-slider-container">
                                    <div class="uk-slider-items uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@m tm-products-grid">
                                        @foreach($viewedSanphamss as $i)
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
                                                    @if($i->danhmuc->ten == 'Laptop' || ($i->danhmuc->parent && $i->danhmuc->parent->ten == 'Laptop'))
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
    @endif




    <!-- ma giam gia -->
    <div class="hero">
        <div class="main-content">
            <div class="uk-grid-small uk-flex-middle uk-margin-bottom" uk-grid>
                <h2 class="uk-width-expand uk-text-center uk-text-left@s">Mã giảm giá
                </h2>
                <div class="uk-visible@s"><a class="tm-slidenav" href="#" uk-slider-item="previous" uk-slidenav-previous></a><a class="tm-slidenav" href="#" uk-slider-item="next" uk-slidenav-next></a></div>
            </div>
            <div uk-slider="finite: true">
                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container">
                            <div class="uk-slider-items uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-flex-center">
                                @foreach($mgg as $i)
                                @php
                                $hannhan = \Carbon\Carbon::parse($i->updated_at)->addDays(2);
                                $today = \Carbon\Carbon::today();
                                $isExpired = $hannhan->lessThan($today);
                                $isHidden = $hannhan->lessThan($today->subDays(1));
                                @endphp
                                @if(!$isHidden)
                                <div class="uk-card uk-card-default uk-card-body">

                                    <div>
                                        <div class="uk-card uk-card-default">
                                            <div class="uk-card-media-top">
                                                <img src="{{ asset('font-end/img/magiamgia.png') }}" alt="anh">
                                            </div>
                                            <div class="uk-card-body">
                                                <h3 class="uk-card-title">{{ $i->magiamgia }} / SL:{{ $i->soluong }}</h3>
                                                <p style="height:100px;">
                                                    @if($i->phantramgiamgia)
                                                    <span>Giảm {{ number_format($i->phantramgiamgia) }}% cho đơn hàng <span style="color:#800000">{{ number_format($i->giatritoithieudonhang) }} VNĐ</span></span>
                                                    <span style="color:red">(Tối đa {{ number_format($i->sotiengiamgiatoida) }} VNĐ)</span>
                                                    @else
                                                    <span>Giảm trực tiếp {{ number_format($i->giamtructiep) }} VNĐ cho đơn hàng <span style="color:#800000">{{ number_format($i->giatritoithieudonhang) }} VNĐ</span></span>
                                                    @endif
                                                <div>Hạn nhận: {{ $hannhan->format('d/m/Y') }}</div>
                                                </p>
                                                @if(!$isExpired)
                                                @if($i->soluong>0 && !in_array($i->id, $ctmgg))
                                                <a href="{{route('nhanmagiamgia',['id'=>$i->id])}}" class="uk-button uk-button-primary">Nhận ngay</a>
                                                @elseif(in_array($i->id, $ctmgg))
                                                <button class="uk-button uk-button-primary" disabled>Đã nhận</button>
                                                @else
                                                <button class="uk-button uk-button-primary" disabled>Số lượng đã hết</button>
                                                @endif
                                                @else
                                                <button class="uk-button uk-button-primary" disabled>Hết hạn</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="uk-section uk-section-default uk-section-small">
        <div class="uk-container">
            <h2 class="uk-text-center">Thương hiệu phổ biến</h2>
            <div class="uk-margin-medium-top" uk-slider="finite: true">
                <div class="uk-position-relative">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-visible@m">
                            <a href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                        </div>
                        <div class="uk-width-expand uk-slider-container">
                            <ul class="uk-slider-items uk-child-width-1-3 uk-child-width-1-6@s uk-grid uk-grid-large">
                                @foreach($nsx as $i)
                                <li>
                                    <div class="tm-ratio tm-ratio-16-9">
                                        <a class="uk-link-muted tm-media-box tm-grayscale" href="#" title="{{$i->ten}}">
                                            <figure class="tm-media-box-wrap">
                                                <img src="{{asset('back-end/img/nsx/' . $i->img)}}" alt="{{$i->ten}}" />
                                            </figure>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="uk-visible@m">
                            <a href="#" uk-slider-item="next" uk-slidenav-next></a>
                        </div>
                    </div>
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top uk-hidden@m"></ul>
            </div>

        </div>
    </section>

    <!-- SAN PHAM THEO NHU CAU -->
    <div class="course">
        <div class="main-content">
            <div class="body">
                <h2 class="heading-lv2">SẢN PHẨM THEO NHU CẦU</h2>
                <div class="row-top">
                    <p class="desc">Các sản phẩm có thể sẽ phù hợp với nhu cầu của bạn </p>
                    <a href="{{route('danhsachdanhmuc',['id'=>1])}}" class="all-course">Xem tất cả sản phẩm</a>
                </div>
                <div class="course-list">
                    @foreach($dms as $i)
                    @if($i->ten == 'Laptop Gaming')
                    <div class="course-item">
                        <a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}"><img src="{{asset('font-end/img/gaming.jpg')}}" alt="Web Design" class="thumb"></a>
                        <div class="course-detail">
                            <div class="wrap-item">
                                <h3 class="heading-lv3"><a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}">GAMING</a></h3>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($i->ten == 'Laptop')
                    <div class="course-item">
                        <a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}"><img src="{{asset('font-end/img/gaming.jpg')}}" alt="Web Design" class="thumb"></a>
                        <div class="course-detail">
                            <div class="wrap-item">
                                <h3 class="heading-lv3"><a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}">LAPTOP</a></h3>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($i->ten == 'Laptop văn phòng')
                    <div class="course-item">
                        <a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}"><img src="{{asset('font-end/img/officer.jpg')}}" alt="UI/UX Design" class="thumb"></a>
                        <div class="course-detail">
                            <div class="wrap-item">
                                <h3 class="heading-lv3"><a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}">OFFICE</a></h3>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($i->ten == 'Laptop thiết kế')
                    <div class="course-item">
                        <a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}"><img src="{{asset('font-end/img/designer.jpg')}}" alt="Web Development" class="thumb"></a>
                        <div class="course-detail">
                            <div class="wrap-item">
                                <h3 class="heading-lv3"><a href="{{route('danhsachdanhmuc',['id'=>$i->id])}}">DESIGN</a></h3>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- feedback -->
    <div class="feedback">
        <div class="main-content">
            <div class="body">
                <blockquote class="comment">
                    Các sản phẩm bạn vừa xem gần đây
                </blockquote>
                <div class="feedback-cta">
                    <a href="#!" class="cta-btn">
                        <div class="cta-btn-group">
                            <img src="{{asset('font-end/icon/prev.svg')}}" alt="" class="icon">
                        </div>
                    </a>
                    <a href="#!" class="cta-btn">
                        <div class="cta-btn-group">
                            <img src="{{asset('font-end/icon/next.svg')}}" alt="" class="icon">
                        </div>
                    </a>
                </div>

                <!-- avatar member -->
                <img src="{{asset('font-end/img/1.png')}}" alt="member 1" class="ava-fb avar-fb-1">
                <img src="{{asset('font-end/img/3.png')}}" alt="member 2" class="ava-fb avar-fb-2">
                <img src="{{asset('font-end/img/2.png')}}" alt="member 3" class="ava-fb avar-fb-3">
                <img src="{{asset('font-end/img/4.png')}}" alt="member 4" class="ava-fb avar-fb-4">
                <img src="{{asset('font-end//img/5.png')}}" alt="member 5" class="ava-fb avar-fb-5">
                <img src="{{asset('font-end/img/2.png')}}" alt="member 6" class="ava-fb avar-fb-6">
            </div>
        </div>
    </div>

    <!-- admit -->
    <div class="admit">
        <div class="main-content">
            <div class="body">
                <!-- admit left -->
                <div class="admit-left">
                    <h2 class="heading-lv2">Ưu đãi khi thanh toán ONLINE</h2>
                    <p class="desc">Kết nối với chúng tôi nha khác hàng ơi.</p>
                </div>
                <!-- admit right -->
                <a href="#!" class="btn">Xem ƯU ĐÃI</a>
            </div>
        </div>
    </div>
</main>

@endsection
