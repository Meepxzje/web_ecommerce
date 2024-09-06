<div class="uk-width-1-1 uk-width-1-4@m tm-aside-column">
    <div class="uk-card uk-card-default uk-card-small tm-ignore-container" uk-sticky="offset: 90; bottom: true; media: @m;">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                <section>
                    <div class="uk-width-1-3 uk-width-1-4@s uk-width-1-2@m uk-margin-auto uk-visible-toggle uk-position-relative uk-border-circle uk-overflow-hidden uk-light">

                        @if(isset($u->img))
                        <img src="{{asset('font-end/img/taikhoan')}}/{{$u->img}}"><a class="uk-link-reset uk-overlay-primary uk-position-cover uk-hidden-hover" href="#">
                            <div class="uk-position-center"><span uk-icon="icon: camera; ratio: 1.25;"></span></div>
                        </a>
                        @else
                        <img src="{{asset('font-end/img/taikhoan/nguoidung.png')}}"><a class="uk-link-reset uk-overlay-primary uk-position-cover uk-hidden-hover" href="#">
                            <div class="uk-position-center"><span uk-icon="icon: camera; ratio: 1.25;"></span></div>
                        </a>
                        @endif
                    </div>

                </section>

                <div class="uk-text-center">
                    <div class="uk-text-meta">{{$u->ten}}</div>
                    <div class="uk-h4 uk-margin-remove">Tham gia từ: {{$u->created_at->format('m-Y')}}</div>
                </div>
                <div>
                    <div class="uk-grid-small uk-flex-center" uk-grid>
                        <div><a class="uk-button uk-button-default uk-button-small" href="{{route('caidattaikhoan')}}"><span class="uk-margin-xsmall-right" uk-icon="icon: cog; ratio: .75;"></span><span>Đổi mật khẩu</span></a>
                        </div>
                        <!-- <div><button class="uk-button uk-button-default uk-button-small" href="" title="Log out"><span uk-icon="icon: sign-out; ratio: .75;"></span></button></div> -->
                    </div>
                </div>
            </div>
        </div>
        <div>
            <nav>
                <ul class="uk-nav uk-nav-default tm-nav">
                    <li class="{{ Request::is('taikhoan') ? 'uk-active' : '' }}"><a href="{{ route('taikhoan') }}">Thông tin cá nhân</a></li>
                    <li class="{{ Request::is('dondathang') ? 'uk-active' : '' }}"><a href="{{ route('dondathang') }}">Đơn đặt hàng <span>({{$u->sldonhang()}})</span></a></li>
                    <li class="{{ Request::is('quantam') ? 'uk-active' : '' }}"><a href="{{ route('quantam') }}">Quan tâm<span>({{$u->slquantam()}})</span></a></li>
                    <li class="{{ Request::is('magiamgia') ? 'uk-active' : '' }}"><a href="{{ route('magiamgia') }}">Mã giảm giá<span>({{$u->slmgg()}})</span></a></li>
                    <!-- <li><a href="favorites.html">Yêu thích
                            <span>(3)</span></a></li> -->
                </ul>
            </nav>
        </div>
    </div>
</div>
