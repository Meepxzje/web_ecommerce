@extends('fe.index')
@section('title', 'Tin tức')
@section('tintuc')

<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <div class="uk-text-center">
                    <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><span>Tin tức</span></li>
                    </ul>
                    <h1 class="uk-margin-small-top uk-margin-remove-bottom">News</h1>
                </div>
                <div>
                    <div class="uk-grid-medium" uk-grid>
                        <section class="uk-width-1-1 uk-width-expand@m">
                            <section class="uk-card uk-card-default uk-card-small uk-card-body tm-ignore-container">
                                <ul class="uk-list uk-list-large uk-list-divider">
                                    <li>
                                        <article class="uk-article">
                                            <div class="uk-article-body">
                                                <div class="uk-article-meta uk-margin-xsmall-bottom"><time>26/05/2024</time></div>
                                                <div>
                                                    <h3><a class="uk-link-heading" href="article.html">MSI Modern 14 C11M - chiếc laptop giá 8.49 triệu đồng đáng mua nhất tại VinnMeepShop!</a></h3>
                                                </div>
                                                <div class="uk-margin-small-top">
                                                    <p>Nếu bạn đang tìm kiếm một mẫu laptop giá phải chăng, cấu hình tốt lại phải là máy mới, chính hãng 100% thì bài viết hôm nay sẽ là dành cho bạn! Chiếc laptop MSI Modern 14 C11M (011VN) có mức giá chỉ 8.49 triệu đồng mà thôi, hãy cùng xem chiếc laptop này đáng mua như thế nào nhé!</p>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                    <li>
                                        <article class="uk-article">
                                            <div class="uk-article-body">
                                                <div class="uk-article-meta uk-margin-xsmall-bottom"><time>24/05/2024</time></div>
                                                <div>
                                                    <h3><a class="uk-link-heading" href="article.html">Cùng VMSHOP ngắm 'nội thất' iPad Air M2 13 inch, liệu rằng có bí mật gì bên trong?</a></h3>
                                                </div>
                                                <div class="uk-margin-small-top">
                                                    <p>Trang web sửa chữa nổi tiếng - iFixit mới đây đã đăng tải một video teardown iPad Air M2 13 inch đầu tiên. Qua video, chúng ta có thể thấy được những cái nhìn bên trong thiết bị và khả năng sắp xếp linh kiện của Apple mang đầy tính ấn tượng.</p>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                    <li>
                                        <article class="uk-article">
                                            <div class="uk-article-body">
                                                <div class="uk-article-meta uk-margin-xsmall-bottom"><time>24/05/2024</time></div>
                                                <div>
                                                    <h3><a class="uk-link-heading" href="article.html">Laptop Acer Aspire 3 A314 chiếc laptop 16GB rẻ nhất Thế Giới Di Động có đáng mua?</a></h3>
                                                </div>
                                                <div class="uk-margin-small-top">
                                                    <p>Lần lượt đó chính là vi xử lý Ryzen 7 - 5700U mạnh mẽ, 16GB RAM chuẩn LPDDR4X và 512GB bộ nhớ trong (có thể nâng cấp tối đa 1TB). Nếu bảo đây là một cấu hình siêu mạnh thì chưa đúng, nhưng cũng chẳng phải một cấu hình yếu đuối. Chiếc Acer Aspire 3 A314 có thể cân tốt các tác vụ văn phòng, xử lý số liệu lớn hay các chỉnh sửa, vẽ tạo hình ảnh đơn giản qua các phần mềm chuyên dụng cơ bản.</p>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
                            </section>
                        </section>
                        <aside class="uk-width-1-4 uk-visible@m tm-aside-column">
                            <section class="uk-card uk-card-default uk-card-small" uk-sticky="offset: 90; bottom: true;">
                                <nav>
                                    <ul class="uk-nav uk-nav-default tm-nav">
                                        <li><a href="about.html">Về chúng tôi</a></li>
                                        <li><a href="contacts.html">Liên hệ</a></li>
                                        <li class="uk-active"><a href="#!">Tin tức</a></li>
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
