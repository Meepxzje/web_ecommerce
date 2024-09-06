@extends('fe.index')
@section('title', 'Liên hệ')
@section('lienhe')

<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><span>Liên hệ</span></li>
                    </ul>
                    <h1 class="uk-margin-small-top uk-margin-remove-bottom">Liên hệ</h1>
                </div>
                <div>
                    <div class="uk-grid-medium" uk-grid>
                        <section class="uk-width-1-1 uk-width-expand@m">
                            <article class="uk-card uk-card-default uk-card-small uk-card-body uk-article tm-ignore-container">
                                <div class="tm-wrapper">
                                    <figure class="tm-ratio tm-ratio-16-9 js-map" data-latitude="59.9356728" data-longitude="30.3258604" data-zoom="14"></figure>
                                </div>
                                <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-margin-top" uk-grid>
                                    <section>
                                        <h3>Cửa hàng</h3>
                                        <ul class="uk-list">
                                            <li><a class="uk-link-heading" href="#"><span class="uk-margin-small-right" uk-icon="receiver"></span><span class="tm-pseudo">0336.273.758</span></a></li>
                                            <li><a class="uk-link-heading" href="#"><span class="uk-margin-small-right" uk-icon="mail"></span><span class="tm-pseudo">huynhnhatvienpro@gmail.com</span></a></li>
                                            <li>
                                                <div><span class="uk-margin-small-right" uk-icon="location"></span><span>Cao lỗ, Phường 4, Quận 8, TP.HCM</span></div>
                                            </li>
                                            <li>
                                                <div><span class="uk-margin-small-right" uk-icon="clock"></span><span>Hàng ngày 10:00–22:00</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </section>
                                    <section>
                                        <h3>Phản hồi</h3>
                                        <dl class="uk-description-list">
                                            <dt>SỰ HỢP TÁC</dt>
                                            <dd><a class="uk-link-muted" href="#">trinhminhthuan@example.com</a>
                                            </dd>
                                            <dt>ĐỐI TÁC</dt>
                                            <dd><a class="uk-link-muted" href="#">trinhminhthuan@example.com</a></dd>
                                            <dt>BÁO CHÍ</dt>
                                            <dd><a class="uk-link-muted" href="#">vinnmeepshop@example.com</a></dd>
                                        </dl>
                                    </section>
                                    <section class="uk-width-1-1">
                                        <h2 class="uk-text-center">Liên hệ với chúng tôi
</h2>
                                        <form>
                                            <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                <div><label>
                                                        <div class="uk-form-label uk-form-label-required">Tên
                                                        </div><input class="uk-input" type="text" required>
                                                    </label></div>
                                                <div><label>
                                                        <div class="uk-form-label uk-form-label-required">Email
                                                        </div><input class="uk-input" type="email" required>
                                                    </label></div>
                                                <div><label>
                                                        <div class="uk-form-label">Chủ đề</div><select class="uk-select">
                                                            <option>Dịch vụ khách hàng</option>
                                                            <option>Hỗ trợ kỹ thuật</option>
                                                            <option>Khác</option>
                                                        </select>
                                                    </label></div>
                                                <div><label>
                                                        <div class="uk-form-label">Thông điệp</div><textarea class="uk-textarea" rows="5"></textarea>
                                                    </label></div>
                                                <div class="uk-text-center"><button class="uk-button uk-button-primary">Gửi</button></div>
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </article>
                        </section>
                        <aside class="uk-width-1-4 uk-visible@m tm-aside-column">
                            <section class="uk-card uk-card-default uk-card-small" uk-sticky="offset: 90; bottom: true;">
                                <nav>
                                    <ul class="uk-nav uk-nav-default tm-nav">
                                        <li><a href="about.html">Về chúng tôi</a></li>
                                        <li class="uk-active"><a href="contacts.html">Liên hệ</a></li>
                                        <li><a href="news.html">Tin tức</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="delivery.html">Vận chuyển</a></li>
                                    </ul>
                                </nav>
                            </section>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
