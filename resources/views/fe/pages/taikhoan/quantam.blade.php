@extends('fe.pages.taikhoan')
@section('quantam')

<div class="uk-width-1-1 uk-width-expand@m">
    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
        <header class="uk-card-header">
            <h1 class="uk-h2">Quan tâm</h1>
        </header>
        <div class="uk-grid-collapse tm-products-list" uk-grid>
            @foreach($qt as $a)
            @foreach($a->chitietquantams as $sp)
            <article class="tm-product-card">
                <div class="tm-product-card-media">
                    <div class="tm-ratio tm-ratio-4-3">
                        <a class="tm-media-box" href="{{route('chitietsp',['id'=> $sp->sanpham->id])}}">
                            <div class="tm-product-card-labels">
                                @if($sp->sanpham->daban >= 50)
                                <span class="uk-label uk-label-warning">Bán chạy</span>
                                @endif
                                @if(Auth::check())
                                @php
                                $user = Auth::user();
                                $isInterested = false;
                                foreach ($user->quantams as $quantam) {
                                foreach ($quantam->chitietquantams as $chitiet) {
                                if ($chitiet->sanphamid == $sp->sanpham->id) {
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
                                @if($sp->sanpham->hinhanhsanphams->isNotEmpty())
                                <img src="{{ asset('back-end/img/sp/' . $sp->sanpham->hinhanhsanphams->first()->img) }}" alt='anh' />
                                @endif
                            </figure>
                        </a>
                    </div>
                </div>
                <div class="tm-product-card-body">
                    <div class="tm-product-card-info">
                        <div class="uk-text-meta uk-margin-xsmall-bottom uk-text-xsmall">
                            {{$sp->sanpham->danhmuc->ten}} / {{$sp->sanpham->nhasanxuat->ten}}
                        </div>
                        <h3 class="tm-product-card-title" style="max-width:300px;">
                            <a class="uk-link-heading" href="{{route('chitietsp',['id'=> $sp->sanpham->id])}}">{{$sp->sanpham->ten}}</a>
                        </h3>
                        <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;width:100%">
                            @if($sp->sanpham->danhmuc->ten == 'Laptop'  || ($sp->sanpham->danhmuc->parent && $sp->sanpham->danhmuc->parent->ten == 'Laptop'))
                            <li>
                                <span class="uk-text-muted">Màn hình</span>
                                <span>
                                    @if ($sp->sanpham->thongsomanhinh->kichthuocs)
                                    <span>{{ $sp->sanpham->thongsomanhinh->kichthuocs->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">CPU:</span>
                                <span>
                                    @if ($sp->sanpham->thongsohieunang->cpus)
                                    <span>{{ $sp->sanpham->thongsohieunang->cpus->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">RAM: </span>
                                <span>
                                    @if ($sp->sanpham->thongsohieunang->rams)
                                    <span>{{ $sp->sanpham->thongsohieunang->rams->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">VGA:</span>
                                <span>
                                    @if ($sp->sanpham->thongsohieunang->gpurois)
                                    <span>{{ $sp->sanpham->thongsohieunang->gpurois->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            @elseif($sp->sanpham->danhmucid == 2)

                            <li>
                                <span class="uk-text-muted">Loại:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkbanphim->loaibanphims)
                                    <span>{{ $sp->sanpham->thongsopkbanphim->loaibanphims->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Kiểu dáng:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkbanphim->kieudangbanphims)
                                    <span>{{ $sp->sanpham->thongsopkbanphim->kieudangbanphims->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Keycap:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkbanphim->keycaps)
                                    <span>{{ $sp->sanpham->thongsopkbanphim->keycaps->ten}}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>

                            @elseif($sp->sanpham->danhmucid == 3)

                            <li>
                                <span class="uk-text-muted">Dung lượng:</span>
                                <span>
                                    @if (isset($sp->sanpham->thongsopkram->dungluongs))
                                    <span>{{ $sp->sanpham->thongsopkram->dungluongs->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Loại:</span>
                                <span>
                                    @if (isset($sp->sanpham->thongsopkram->loairams))
                                    <span>{{ $sp->sanpham->thongsopkram->loairams->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Bus:</span>
                                <span>
                                    @if (isset($sp->sanpham->thongsopkram->tocdobuss))
                                    <span>{{ $sp->sanpham->thongsopkram->tocdobuss->ten}}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>

                            @elseif($sp->sanpham->danhmucid == 4)

                            <li>
                                <span class="uk-text-muted">Kích thước:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkmanhinh->kichthuocs)
                                    <span>{{ $sp->sanpham->thongsopkmanhinh->kichthuocs->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Độ phân giải:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkmanhinh->dophangiais)
                                    <span>{{ $sp->sanpham->thongsopkmanhinh->dophangiais->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Tấm nền:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkmanhinh->tamnens)
                                    <span>{{ $sp->sanpham->thongsopkmanhinh->tamnens->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Tần số quét:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkmanhinh->tansoquets)
                                    <span>{{ $sp->sanpham->thongsopkmanhinh->tansoquets->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>

                            @elseif($sp->sanpham->danhmucid == 5)

                            <li>
                                <span class="uk-text-muted">Loại:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopktainghe->loaiketnois)
                                    <span>{{ $sp->sanpham->thongsopktainghe->loaiketnois->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Kiểu:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopktainghe->kieutainghes)
                                    <span>{{ $sp->sanpham->thongsopktainghe->kieutainghes->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Kết nối:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopktainghe->congketnois)
                                    <span>{{ $sp->sanpham->thongsopktainghe->congketnois->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>

                            @elseif($sp->sanpham->danhmucid == 7)

                            <li>
                                <span class="uk-text-muted">Loại:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkchuot->loaiketnois)
                                    <span>{{ $sp->sanpham->thongsopkchuot->loaiketnois->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="uk-text-muted">Kết nối:</span>
                                <span>
                                    @if ($sp->sanpham->thongsopkchuot->kieuketnois)
                                    <span>{{ $sp->sanpham->thongsopkchuot->kieuketnois->ten }}</span>
                                    @else
                                    <span>Chưa có thông tin</span>
                                    @endif
                                </span>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tm-product-card-shop">
                        <div class="tm-product-card-prices" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                            @if($sp->sanpham->giamgiahangloat != null && $sp->sanpham->giamgiahangloat->tinhtrang == 1)
                            @php
                            $a = $sp->sanpham->giamgiahangloat->phantramgiamgia * $sp->sanpham->gia / 100;
                            $giam = $a > $sp->sanpham->giamgiahangloat->giamtoida ? $sp->sanpham->giamgiahangloat->giamtoida : $a;
                            @endphp
                            @endif
                            @if($sp->sanpham->giamgia != null && $sp->sanpham->giamgiahangloat != null && $sp->sanpham->giamgia->danggiam == 1 && $sp->sanpham->giamgiahangloat->tinhtrang == 1 && $sp->sanpham->giamgia->soluongsanpham > 0 && $sp->sanpham->giamgiahangloat->soluongsanpham > 0)
                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <del style="margin-bottom: 5px;">{{ number_format($sp->sanpham->gia) }}đ</del>
                                <div class="tm-product-card-price" style="color: #CD5C5C;">
                                    {{ number_format($sp->sanpham->gia - $sp->sanpham->giamgia->giagiam - $giam) }}đ
                                </div>
                            </div>
                            @elseif($sp->sanpham->giamgiahangloat && $sp->sanpham->giamgiahangloat->tinhtrang == 1 && $sp->sanpham->giamgiahangloat->soluongsanpham > 0)
                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <del style="margin-bottom: 5px;">{{ number_format($sp->sanpham->gia) }}đ</del>
                                <div class="tm-product-card-price" style="color: #CD5C5C;">
                                    {{ number_format($sp->sanpham->gia - $giam) }}đ
                                </div>
                            </div>
                            @elseif(isset($sp->sanpham->giamgia) && $sp->sanpham->giamgia->danggiam == 1 && $sp->sanpham->giamgia->soluongsanpham > 0)
                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <del style="margin-bottom: 5px;">{{ number_format($sp->sanpham->gia) }}đ</del>
                                <div class="tm-product-card-price" style="color: #CD5C5C;">
                                    {{ number_format($sp->sanpham->gia - $sp->sanpham->giamgia->giagiam) }}đ
                                </div>
                            </div>
                            @else
                            <div class="tm-product-card-price" style="color: #000;">
                                {{ number_format($sp->sanpham->gia) }}đ
                            </div>
                            @endif
                        </div>

                        <div class="tm-product-card-add">
                            <div class="uk-text-meta tm-product-card-actions">
                                <a href="" onclick="event.preventDefault(); document.getElementById('add-to-compare-{{ $sp->sanpham->id }}').submit();" class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" title="So sánh">
                                    <span uk-icon="icon: copy; ratio: .75;"></span><span class="tm-product-card-action-text" style="font-size: 15px;;">So sánh</span>
                                </a>
                                <form id="add-to-compare-{{ $sp->sanpham->id}}" action="{{ route('addToCompare', $sp->sanpham->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" href="{{route('removequantam',['id'=>$sp->sanpham->id])}}">
                                    <span uk-icon="icon: close; ratio: .75;"></span><span class="tm-product-card-action-text" style="font-size: 15px;;">Xóa khỏi quan tâm</span>
                                </a>
                            </div>
                            <form action="{{ route('giohang.addToCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sanphamid" value="{{ $sp->sanpham->id }}">
                                <input type="hidden" name="gia" value="{{ $sp->sanpham->gia }}">
                                <button class="uk-button uk-button-primary tm-product-card-add-button tm-shine js-add-to-cart" type="submit">
                                    <span class="tm-product-card-add-button-icon" uk-icon="cart"></span><span class="tm-product-card-add-button-text">Thêm vào giỏ hàng</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
            @endforeach
        </div>
    </div>
</div>



@endsection
