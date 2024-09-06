@extends('fe.index')
@section('title', 'Danh sách Sản Phẩm')
@section('formloc')

<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><span>{{$dm->ten}}</span></li>
                    </ul>
                    <h1 class="heading-lv2">{{$dm->ten}}</h1>
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
                                                                <div class="uk-width-1-1 uk-width-expand@s uk-flex uk-flex-center uk-flex-left@s uk-text-small">
                                                                    <span class="uk-margin-small-right uk-text-muted">Sắp xếp theo:</span>
                                                                    <ul class="uk-subnav uk-margin-remove">
                                                                        <li class="uk-active uk-padding-remove">
                                                                            <a class="uk-text-lowercase" href="#">liên quan<span class="uk-margin-xsmall-left" uk-icon="icon: chevron-down; ratio: .5;"></span></a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="uk-text-lowercase" href="#">Giá</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="uk-text-lowercase" href="#">Mới nhất</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="uk-width-1-1 uk-width-auto@s uk-flex uk-flex-center uk-flex-middle">
                                                                    <button class="uk-button uk-button-default uk-button-small uk-hidden@m" uk-toggle="target: #filters">
                                                                        <span class="uk-margin-xsmall-right" uk-icon="icon: settings; ratio: .75;"></span>Filters
                                                                    </button>
                                                                    <div class="tm-change-view uk-margin-small-left">
                                                                        <ul class="uk-subnav uk-iconnav js-change-view" uk-switcher>
                                                                            <li>
                                                                                <a class="uk-active" data-view="grid" uk-icon="grid" uk-tooltip="Grid"></a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-view="list" uk-icon="list" uk-tooltip="List"></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-grid-collapse uk-child-width-1-3 tm-products-grid js-products-grid" uk-grid>
                                                                @foreach($sp as $i)
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
                                                                            <div class="uk-text-meta uk-margin-xsmall-bottom">
                                                                                {{$i->danhmuc->ten}}
                                                                            </div>
                                                                            <h3 class="tm-product-card-title">
                                                                                <a class="uk-link-heading" href="{{route('chitietsp',['id'=> $i->id])}}">{{$i->ten}}</a>
                                                                            </h3>
                                                                            @if($i->danhmucid ==1)
                                                                            <ul class="uk-list uk-text-small uk-margin-remove" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; display: inline-block; font-size: smaller;">
                                                                                <li>
                                                                                    <span class="uk-text-muted">Màn hình</span>
                                                                                    <span>
                                                                                        @if ($i->thongsomanhinh)
                                                                                        <span>{{ $i->thongsomanhinh->kichthuoc }}</span>
                                                                                        @else
                                                                                        <span>Chưa có thông tin</span>
                                                                                        @endif
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="uk-text-muted">CPU:</span>
                                                                                    <span>
                                                                                        @if ($i->thongsohieunang)
                                                                                        <span>{{ $i->thongsohieunang->cpu }}</span>
                                                                                        @else
                                                                                        <span>Chưa có thông tin</span>
                                                                                        @endif
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="uk-text-muted">RAM: </span>
                                                                                    <span>
                                                                                        @if ($i->thongsohieunang)
                                                                                        <span>{{ $i->thongsohieunang->ram }}</span>
                                                                                        @else
                                                                                        <span>Chưa có thông tin</span>
                                                                                        @endif
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="uk-text-muted">GPU:</span>
                                                                                    <span>
                                                                                        @if ($i->thongsohieunang)
                                                                                        <span>{{ $i->thongsohieunang->gpuroi }}</span>
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
                                                                                <div class="tm-product-card-price">
                                                                                    {{ number_format($i->gia, 0, ',', '.') }} vnđ
                                                                                </div>
                                                                            </div>
                                                                            <div class="tm-product-card-add">
                                                                                <div class="uk-text-meta tm-product-card-actions">
                                                                                    <a class="tm-product-card-action js-add-to js-add-to-favorites tm-action-button-active js-added-to" title="Thêm vào yêu thích"><span uk-icon="icon: heart; ratio: .75;"></span><span class="tm-product-card-action-text">Thêm vào yêu thích</span></a><a class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" title="Thêm vào so sánh"><span uk-icon="icon: copy; ratio: .75;"></span><span class="tm-product-card-action-text">Thêm vào giỏ hàng</span></a>
                                                                                </div>
                                                                                <button class="uk-button uk-button-primary tm-product-card-add-button tm-shine js-add-to-cart">
                                                                                    <span class="tm-product-card-add-button-icon" uk-icon="cart"></span><span class="tm-product-card-add-button-text">Thêm vào giỏ hàng</span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </article>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-large uk-width-1-1" style="
                                  border-top-left-radius: 0;
                                  border-top-right-radius: 0;
                                ">
                                                                <span class="uk-margin-small-right" uk-icon="icon: plus; ratio: .75;"></span><span>Xem thêm...</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <ul class="uk-pagination uk-flex-center">
                                                    <li class="uk-active"><span>1</span></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">5</a></li>
                                                    <li class="uk-disabled"><span>…</span></li>
                                                    <li><a href="#">20</a></li>
                                                    <li>
                                                        <a href="#"><span uk-pagination-next></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <div id="nav-offcanvas" uk-offcanvas="overlay: true">
                <aside class="uk-offcanvas-bar uk-padding-remove">
                    <div class="uk-card uk-card-default uk-card-small tm-shadow-remove">
                        <header class="uk-card-header uk-flex uk-flex-middle">
                            <div>
                                <a class="uk-link-muted uk-text-bold" href="#">8 800 799 99 99</a>
                                <div class="uk-text-xsmall uk-text-muted" style="margin-top: -2px">
                                    <div>St.&nbsp;Petersburg, Nevsky&nbsp;Prospect&nbsp;28</div>
                                    <div>Daily 10:00–22:00</div>
                                </div>
                            </div>
                        </header>
                        <nav class="uk-card-small uk-card-body">
                            <ul class="uk-nav-default uk-nav-parent-icon uk-list-divider" uk-nav>
                                <li class="uk-parent">
                                    <a href="catalog.html">Catalog</a>
                                    <ul class="uk-nav-sub uk-list-divider">
                                        <li>
                                            <a href="subcategory.html">Laptops &amp; Tablets</a>
                                        </li>
                                        <li><a href="subcategory.html">Phones &amp; Gadgets</a></li>
                                        <li><a href="subcategory.html">TV &amp; Video</a></li>
                                        <li>
                                            <a href="subcategory.html">Games &amp; Entertainment</a>
                                        </li>
                                        <li><a href="subcategory.html">Photo</a></li>
                                        <li class="uk-text-center">
                                            <a class="uk-link-muted uk-text-uppercase tm-link-to-all" href="catalog.html"><span>see all
                                                    categories</span><span uk-icon="icon: chevron-right; ratio: .75;"></span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="uk-parent">
                                    <a href="brands.html">Brands</a>
                                    <ul class="uk-nav-sub uk-list-divider">
                                        <li><a href="subcategory.html">Apple</a></li>
                                        <li><a href="subcategory.html">Samsung</a></li>
                                        <li><a href="subcategory.html">Sony</a></li>
                                        <li><a href="subcategory.html">Microsoft</a></li>
                                        <li><a href="subcategory.html">Intel</a></li>
                                        <li><a href="subcategory.html">HP</a></li>
                                        <li><a href="subcategory.html">LG</a></li>
                                        <li><a href="subcategory.html">Lenovo</a></li>
                                        <li><a href="subcategory.html">ASUS</a></li>
                                        <li><a href="subcategory.html">Acer</a></li>
                                        <li><a href="subcategory.html">Dell</a></li>
                                        <li><a href="subcategory.html">Canon</a></li>
                                        <li class="uk-text-center">
                                            <a class="uk-link-muted uk-text-uppercase tm-link-to-all" href="brands.html"><span>see all
                                                    brands</span><span uk-icon="icon: chevron-right; ratio: .75;"></span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="uk-parent">
                                    <a href="#">Pages</a>
                                    <ul class="uk-nav-sub uk-list-divider">
                                        <li><a href="subcategory.html">Catalog</a></li>
                                        <li><a href="subcategory.html">Category</a></li>
                                        <li><a href="subcategory.html">Subcategory</a></li>
                                        <li><a href="subcategory.html">Product</a></li>
                                        <li><a href="subcategory.html">Cart</a></li>
                                        <li><a href="subcategory.html">Checkout</a></li>
                                        <li><a href="subcategory.html">Compare</a></li>
                                        <li><a href="subcategory.html">Brands</a></li>
                                        <li><a href="subcategory.html">Compare</a></li>
                                        <li><a href="subcategory.html">Account</a></li>
                                        <li><a href="subcategory.html">Favorites</a></li>
                                        <li><a href="subcategory.html">Personal</a></li>
                                        <li><a href="subcategory.html">Settings</a></li>
                                        <li><a href="subcategory.html">About</a></li>
                                        <li><a href="subcategory.html">Contacts</a></li>
                                        <li><a href="subcategory.html">Blog</a></li>
                                        <li><a href="subcategory.html">News</a></li>
                                        <li><a href="subcategory.html">Article</a></li>
                                        <li><a href="subcategory.html">FAQ</a></li>
                                        <li><a href="subcategory.html">Delivery</a></li>
                                        <li><a href="subcategory.html">404</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li>
                                    <a href="compare.html">Compare<span class="uk-badge uk-margin-xsmall-left">3</span></a>
                                </li>
                            </ul>
                        </nav>
                        <nav class="uk-card-small uk-card-body">
                            <ul class="uk-nav uk-nav-default">
                                <li><a href="news.html">News</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="#">Payment</a></li>
                            </ul>
                        </nav>
                        <nav class="uk-card-body">
                            <ul class="uk-iconnav uk-flex-center">
                                <li><a href="#" title="Facebook" uk-icon="facebook"></a></li>
                                <li><a href="#" title="Twitter" uk-icon="twitter"></a></li>
                                <li><a href="#" title="YouTube" uk-icon="youtube"></a></li>
                                <li><a href="#" title="Instagram" uk-icon="instagram"></a></li>
                            </ul>
                        </nav>
                    </div>
                </aside>
            </div>
            <div id="cart-offcanvas" uk-offcanvas="overlay: true; flip: true">
                <aside class="uk-offcanvas-bar uk-padding-remove">
                    <div class="uk-card uk-card-default uk-card-small uk-height-1-1 uk-flex uk-flex-column tm-shadow-remove">
                        <header class="uk-card-header uk-flex uk-flex-middle">
                            <div class="uk-grid-small uk-flex-1" uk-grid>
                                <div class="uk-width-expand">
                                    <div class="uk-h3">Cart</div>
                                </div>
                                <button class="uk-offcanvas-close" type="button" uk-close></button>
                            </div>
                        </header>
                        <div class="uk-card-body uk-overflow-auto">
                            <ul class="uk-list uk-list-divider">
                                <li class="uk-visible-toggle">
                                    <arttcle>
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-1-4">
                                                <div class="tm-ratio tm-ratio-4-3">
                                                    <a class="tm-media-box" href="product.html">
                                                        <figure class="tm-media-box-wrap">
                                                            <img src="images/products/1/1-small.jpg" alt='Apple MacBook Pro 15" Touch Bar MPTU2LL/A 256GB (Silver)' />
                                                        </figure>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-meta uk-text-xsmall">Laptop</div>
                                                <a class="uk-link-heading uk-text-small" href="product.html">Apple MacBook
                                                    Pro 15&quot; Touch Bar
                                                    MPTU2LL/A 256GB
                                                    (Silver)</a>
                                                <div class="uk-margin-xsmall uk-grid-small uk-flex-middle" uk-grid>
                                                    <div class="uk-text-bolder uk-text-small">
                                                        $1599.00
                                                    </div>
                                                    <div class="uk-text-meta uk-text-xsmall">
                                                        1 × $1599.00
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a class="uk-icon-link uk-text-danger uk-invisible-hover" href="#" uk-icon="icon: close; ratio: .75" uk-tooltip="Remove"></a>
                                            </div>
                                        </div>
                                    </arttcle>
                                </li>
                                <li class="uk-visible-toggle">
                                    <arttcle>
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-1-4">
                                                <div class="tm-ratio tm-ratio-4-3">
                                                    <a class="tm-media-box" href="product.html">
                                                        <figure class="tm-media-box-wrap">
                                                            <img src="images/products/2/2-small.jpg" alt='Apple MacBook 12" MNYN2LL/A 512GB (Rose Gold)' />
                                                        </figure>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-meta uk-text-xsmall">Laptop</div>
                                                <a class="uk-link-heading uk-text-small" href="product.html">Apple MacBook
                                                    12&quot; MNYN2LL/A
                                                    512GB (Rose Gold)</a>
                                                <div class="uk-margin-xsmall uk-grid-small uk-flex-middle" uk-grid>
                                                    <div class="uk-text-bolder uk-text-small">
                                                        $1549.00
                                                    </div>
                                                    <div class="uk-text-meta uk-text-xsmall">
                                                        1 × $1549.00
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a class="uk-icon-link uk-text-danger uk-invisible-hover" href="#" uk-icon="icon: close; ratio: .75" uk-tooltip="Remove"></a>
                                            </div>
                                        </div>
                                    </arttcle>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>

@endsection
