@extends('fe.index')
@section('title', 'Tìm kiếm sản phẩm')
@section('timkiemsp')

<main style="font-size: 20px;">
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="/">Trang chủ</a></li>
                    </ul>
                    <h1 class="heading-lv2">Sản phẩm tìm kiếm</h1>
                    <h1 class="heading-lv2">Kết quả tìm kiếm cho "{{ $keyword }}"</h1>
                </div>
            </div>
        </div>
        <div class="uk-offcanvas-content">
            <main>
                <section class="uk-section uk-section-small">
                    <div class="uk-container">
                        <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                            <div>
                                <div class="uk-grid-medium" uk-grid>
                                    @include('fe.pages.a.sidebar')
                                    <div class="uk-width-expand">
                                        <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                            <div>
                                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                                    <div class="uk-grid-collapse uk-child-width-1-1" id="products" uk-grid>
                                                        <div class="uk-card-header">
                                                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                                                <div class="uk-width-1-1 uk-width-expand@s uk-flex uk-flex-between uk-flex-middle uk-text-small">
                                                                    <div class="uk-flex uk-flex-middle">
                                                                        <select id="sortSelect" class="uk-select" style="max-width: 300px;">
                                                                            <option value="#" selected disabled>Sắp xếp theo</option>
                                                                            <option value="1">Bán chạy</option>
                                                                            <option value="2">Giá tăng dần</option>
                                                                            <option value="3">Giá giảm dần</option>
                                                                            <option value="3">Mới nhất</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="uk-width-1-1 uk-width-auto@s uk-flex uk-flex-center uk-flex-middle">
                                                                    <button class="uk-button uk-button-default uk-button-small uk-hidden@m" uk-toggle="target: #filters">
                                                                        <span class="uk-margin-xsmall-right" uk-icon="icon: settings; ratio: .75;"></span>Filters
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="product-listdm">
                                                            <div class="uk-grid-collapse uk-child-width-1-3 tm-products-grid js-products-grid" uk-grid>
                                                                @foreach($products as $i)
                                                                <article class="tm-product-card">
                                                                    <div class="tm-product-card-media">
                                                                        <div class="tm-ratio tm-ratio-4-3">
                                                                            <a class="tm-media-box" href="{{route('chitietsp',['id'=> $i->id])}}">
                                                                                @if($i->daban >= 50)
                                                                                <div class="tm-product-card-labels">
                                                                                    <span class="uk-label uk-label-warning">Bán chạy</span>
                                                                                </div>
                                                                                @endif
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
                                                                            <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
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
                                                                                @if(isset($i->giamgia) && $i->giamgia->danggiam == '1' )
                                                                                <del> {{ number_format($i->gia) }} vnđ</del>
                                                                                <div class="tm-product-card-price" style="color:#CD5C5C;">
                                                                                    {{ number_format($i->gia - $i->giamgia->giagiam) }} vnđ
                                                                                </div>
                                                                                @else
                                                                                <div class="tm-product-card-price">
                                                                                    {{ number_format($i->gia)}} vnđ
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="tm-product-card-add">
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
                                                                </article>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div style="margin-top: 50px;"></div>


                                                        <div class="uk-pagination uk-flex-center" style="white-space: nowrap;">
                                                            <nav aria-label="Page navigation">
                                                                <ul class="pagination">

                                                                </ul>
                                                            </nav>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var searchForm = document.getElementById('searchForm');
        var searchInput = document.getElementById('searchInput');

        if (searchForm && searchInput) {
            searchForm.addEventListener('submit', function(event) {
                var keyword = searchInput.value.trim();
                if (keyword === "") {
                    event.preventDefault();
                    alert("Vui lòng nhập từ khóa tìm kiếm hợp lệ.");
                }
            });
        }
    });
</script>

@endsection
