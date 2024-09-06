@extends('fe.index')
@section('title', 'Cập nhật thông tin')
@section('capnhatthongtin')
<body>
    <main>
        <section class="uk-section uk-section-small">
            <div class="uk-container">
                <div class="uk-grid-medium" uk-grid>
                    <div class="uk-width-1-1 uk-width-1-4@m tm-aside-column">
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container" uk-sticky="offset: 90; bottom: true; media: @m;">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                    <section>
                                        <div class="uk-width-1-3 uk-width-1-4@s uk-width-1-2@m uk-margin-auto uk-visible-toggle uk-position-relative uk-border-circle uk-overflow-hidden uk-light">
                                            <img src="{{asset('font-end/images/avatar.jpg')}}"><a class="uk-link-reset uk-overlay-primary uk-position-cover uk-hidden-hover" href="#">
                                                <div class="uk-position-center"><span uk-icon="icon: camera; ratio: 1.25;"></span></div>
                                            </a>
                                        </div>
                                    </section>
                                    <div class="uk-text-center">
                                        <div class="uk-h4 uk-margin-remove">Viên test</div>
                                        <div class="uk-text-meta">Tham gia từ 26/05/2020</div>
                                    </div>
                                    <div>
                                        <div class="uk-grid-small uk-flex-center" uk-grid>
                                            <div><a class="uk-button uk-button-default uk-button-small" href="settings.html"><span class="uk-margin-xsmall-right" uk-icon="icon: cog; ratio: .75;"></span><span>Sửa hồ sơ</span></a>
                                            </div>
                                            <div><button class="uk-button uk-button-default uk-button-small" href="#" title="Log out"><span uk-icon="icon: sign-out; ratio: .75;"></span></button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <nav>
                                    <ul class="uk-nav uk-nav-default tm-nav">
                                        <li><a href="account.html">Đơn đặt hàng
                                                <span>(2)</span></a></li>
                                        <li><a href="favorites.html">Yêu thích
                                                <span>(3)</span></a></li>
                                        <li><a href="personal.html">Thông tin cá nhân</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1 uk-width-expand@m">
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                            <header class="uk-card-header">
                                <h1 class="uk-h2">Cài đặt</h1>
                            </header>
                            <div class="uk-card-body">
                                <form class="uk-form-stacked">
                                    <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                        <fieldset class="uk-fieldset">
                                            <legend class="uk-h4">Email</legend>
                                            <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                <div><label>
                                                        <div class="uk-form-label">Email hiện tại</div><input class="uk-input uk-form-width-large" type="email" value="example@example.com" disabled>
                                                    </label></div>
                                                <div><label>
                                                        <div class="uk-form-label">Email mới</div><input class="uk-input uk-form-width-large" type="email">
                                                    </label></div>
                                                <div><button class="uk-button uk-button-primary">Cập nhật
                                                        email</button></div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="uk-fieldset">
                                            <legend class="uk-h4">Mật khẩu</legend>
                                            <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                <div><label>
                                                        <div class="uk-form-label">Mật khẩu hiện tại</div><input class="uk-input uk-form-width-large" type="password">
                                                    </label></div>
                                                <div><label>
                                                        <div class="uk-form-label">Password mới</div><input class="uk-input uk-form-width-large" type="password">
                                                    </label></div>
                                                <div><label>
                                                        <div class="uk-form-label">Xác nhận mật khẩu</div><input class="uk-input uk-form-width-large" type="password">
                                                    </label></div>
                                                <div><button class="uk-button uk-button-primary">Cập nhật mật khẩu</button></div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="uk-fieldset">
                                            <legend class="uk-h4">Thông báo qua email</legend>
                                            <ul class="uk-list uk-margin-remove">
                                                <li><input class="tm-checkbox" id="notification-1" type="checkbox" name="notification" value="1" checked><label for="notification-1"><span>Bảng tin hàng tuần</span></label>
                                                </li>
                                                <li><input class="tm-checkbox" id="notification-2" type="checkbox" name="notification" value="1" checked><label for="notification-2"><span>Sản phẩm mới
                                                        </span></label></li>
                                                <li><input class="tm-checkbox" id="notification-3" type="checkbox" name="notification" value="1" checked><label for="notification-3"><span>Sản phẩm đặc biệt</span></label>
                                                </li>
                                            </ul>
                                        </fieldset>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

@endsection
