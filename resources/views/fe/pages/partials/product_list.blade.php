<div class="uk-grid-collapse uk-child-width-1-3 tm-products-grid js-products-grid" uk-grid>
    @foreach($products as $i)
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
