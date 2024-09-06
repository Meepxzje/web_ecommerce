<header class="header fixed">
    <div class="uk-navbar-container uk-light uk-visible@m tm-toolbar-container">
        <div class="uk-container" uk-navbar>
            <div class="uk-navbar-left">
                <nav>
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#"><span class="uk-margin-xsmall-right" uk-icon="icon: receiver; ratio: .75;"></span><span class="tm-pseudo">19000091</span></a>
                        </li>
                        <li>
                            <a href="contacts.html" onclick="return false"><span class="uk-margin-xsmall-right" uk-icon="icon: location; ratio: .75;"></span><span class="tm-pseudo">Cửa hàng ở Q8</span><span uk-icon="icon: triangle-down; ratio: .75;"></span></a>
                            <div class="uk-margin-remove" uk-drop="mode: click; pos: bottom-center;">
                                <div class="uk-card uk-card-default uk-card-small uk-box-shadow-xlarge uk-overflow-hidden uk-padding-small uk-padding-remove-horizontal uk-padding-remove-bottom">
                                    <figure class="uk-card-media-top uk-height-small js-map" data-latitude="59.9356728" data-longitude="30.3258604" data-zoom="14"></figure>
                                    <div class="uk-card-body">
                                        <div class="uk-text-small">
                                            <div class="uk-text-bolder">VinnMeep Shop</div>
                                            <div>
                                                Trịnh Minh Thuận &nbsp; <br>Huỳnh Nhật Viên&nbsp;
                                            </div>
                                            <div>Hàng ngày 10:00–22:00</div>
                                        </div>
                                        <div class="uk-margin-small">
                                            <a class="uk-link-muted uk-text-uppercase tm-link-to-all uk-link-reset" href="contacts.html"><span>Liên hệ</span><span uk-icon="icon: chevron-right; ratio: .75;"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-navbar-item">
                                <span class="uk-margin-xsmall-right" uk-icon="icon: clock; ratio: .75;"></span>Hàng ngày 10:00–22:00
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="uk-navbar-right">
                <nav>
                    <ul class="uk-navbar-nav">
                        <li><a href="">Tin tức</a></li>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Thanh toán</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="main-content" style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-top: 50px;padding: 0 200px; box-sizing: border-box;">
        <div style="display: flex; align-items: center;">
            <!-- Logo -->
            <a href="/"><img src="{{asset('font-end/img/logo.jpg')}}" alt="VinnMeppShop." class="logo" style="margin-right: 20px;"></a>
            <!-- Navigation -->
            <nav class="nav" style="display: flex; align-items: center; width: 700px;">
                <button class="category-btn" id="categoryBtn" style="margin-right: 10px;">
                    <i class="fa-solid fa-list fa-bounce"></i> Danh mục
                </button>
                <div class="search-container" style="display: flex; justify-content: center; flex-grow: 1;">
                    <form method="GET" action="{{route('timkiem')}}" style="display: flex; align-items: center; width: 100%; max-width: 600px; position: relative;">
                        <input type="text" name="keyword" class="search-input" id="searchInput" placeholder="Bạn cần tìm gì?" style="padding: 10px 40px 10px 10px; flex-grow: 1;">
                        <button type="submit" class="search-button" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 0; cursor: pointer;">
                            <i class="fa-brands fa-searchengin fa-beat" style="font-size: 18px;"></i>
                        </button>
                    </form>
                    <div class="autocomplete-suggestions" id="suggestionsBox" style="display: none; max-width: 500px; max-height: 300px; margin-top: 50px;"></div>
                </div>
            </nav>
        </div>

        <div style="display: flex; align-items: center;">
            <a class="uk-navbar-item uk-link-muted uk-visible@m tm-navbar-button" href="/sosanh" style="margin-right: 10px;">
                <span uk-icon="icon: copy; ratio: 1.3;"></span>
                @php
                $compare = session()->get('compare', []);
                @endphp
                @if(count($compare)>0)
                <span class="uk-badge">{{count($compare)}}</span>
                @endif
            </a>
            @if(Auth::check())
            @if(Auth::user()->slgiohang() )
            <a class="uk-navbar-item uk-link-muted tm-navbar-button" href="{{ route('giohang') }}">
                <span uk-icon="icon: cart; ratio: 1.3;"></span>
                <span class="uk-badge">{{ Auth::user()->slgiohang()}}</span>
            </a>
            @else
            <a class="uk-navbar-item uk-link-muted tm-navbar-button" href="{{ route('giohang') }}">
                <span uk-icon="icon: cart; ratio: 1.3;"></span>
            </a>
            @endif
            @else
            <a class="uk-navbar-item uk-link-muted tm-navbar-button" href="{{ route('giohang') }}">
                <span uk-icon="icon: cart; ratio: 1.3;"></span>
            </a>
            @endif

            @if(Auth::check())
            <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; margin-right:10px; margin-left:10px;">
                @if(Auth::user()->img)
                <img src="{{ asset('font-end/img/taikhoan') }}/{{ Auth::user()->img }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                <img src="{{asset('font-end/img/taikhoan/nguoidung.png')}}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                @endif
            </div>
            <div class="uk-padding-small uk-margin-remove" uk-dropdown="pos: bottom-right; offset: 30; delay-hide: 200;" style="min-width: 200px; margin-top: 30px;">
                <div style="display: flex; align-items: center;">
                    <div>
                        <p style="margin: 0;font-style:italic ;font-size: 20px; color: black; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            {{ Auth::user()->ten }}
                        </p>
                    </div>
                </div>
                <ul class="uk-nav uk-dropdown-nav">
                    @if(Auth::user()->role == 1)
                    <li style="font-size: 20px;"><a href="{{ route('admin.index') }}" style="color: red">Quản lí</a></li>
                    @endif
                    <li style="font-size: 15px;"><a href="{{ route('taikhoan') }}" style="color: black">Hồ sơ của tôi</a></li>
                    <li style="font-size: 15px;"><a href="{{ route('quantam') }}" style="color: black">Sản phẩm quan tâm <span>({{ Auth::user()->slquantam() }})</span></a></li>
                    <li style="font-size: 15px;"><a href="{{ route('dondathang') }}" style="color: black">Đơn đặt hàng <span>({{ Auth::user()->sldonhang() }})</span></a></li>
                    <li class="uk-nav-divider"></li>
                    <li style="font-size: 15px;"><a href="{{ route('logout') }}" style="color: black" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
            @else
            <a class="category-btn" href="/dangnhap">Đăng nhập</a>
            @endif
        </div>
    </div>
    <div id="featureDropdown" class="feature" style="margin-top: 10px;">
        <div class="main-content">
            <div class="body-feature">
                <div class="feature-list">
                    <!-- <div class="item">
                    <a href="{{ route('danhsachsp')}}"><i class="fa-solid fa-laptop icon"></i></a>
                    <p class="item-title"><a href="{{ route('danhsachsp')}}">Danh sách tất cả</a></p>
                </div> -->
                    @foreach ($dms as $i)
                    @if($i->ten == 'Laptop')
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-laptop icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">{{ $i->ten }}</a></p>

                    </div>
                    @elseif($i->ten == 'Bàn phím')
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-keyboard icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">{{ $i->ten }}</a></p>
                    </div>
                    @elseif($i->ten == 'Ram')
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-memory icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">{{ $i->ten }}</a></p>
                    </div>
                    @elseif($i->ten == 'Màn hình')
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-desktop icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">{{ $i->ten }}</a></p>
                    </div>
                    @elseif($i->ten == 'Tai nghe')
                    <div class="item">
                        <a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}"><i class="fa-solid fa-headphones icon"></i></a>
                        <p class="item-title"><a href="{{ route('danhsachdanhmuc', ['id' => $i->id]) }}">{{ $i->ten }}</a></p>
                    </div>
                    @elseif($i->ten == 'Chuột')
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

</header>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let keyword = this.value;
        if (keyword.length >= 2) {
            fetchSuggestions(keyword);
        } else {
            document.getElementById('suggestionsBox').style.display = 'none';
        }
    });

    function fetchSuggestions(keyword) {
        fetch(`/autocomplete?keyword=${keyword}`)
            .then(response => response.json())
            .then(data => {
                let suggestionsBox = document.getElementById('suggestionsBox');
                suggestionsBox.innerHTML = '';
                if (data.length) {
                    data.forEach(product => {
                        console.log(product);
                        let div = document.createElement('div');

                        div.style.display = 'flex';
                        div.style.alignItems = 'center';
                        div.style.padding = '10px';
                        div.style.borderBottom = '1px solid #ddd';
                        div.style.cursor = 'pointer';
                        div.style.transition = 'background-color 0.3s';
                        div.style.marginBottom = '5px';

                        div.innerHTML = `
                            <img src="${product.hinhanhsanphams[0].img}" alt="anh" style="max-width: 50px; max-height: 50px; object-fit: cover; border-radius: 5px;" />
                            <div style="display: flex; flex-direction: column; max-width: calc(100% - 125px);">
                                <div style="font-size: 16px; font-weight: bold; color: #333; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${product.ten}</div>
                            </div>
                        `;
                        // <div style="font-size: 14px; color: #666;">${product.gia}</div>
                        div.addEventListener('mouseover', () => {
                            div.style.backgroundColor = '#f5f5f5';
                        });
                        div.addEventListener('mouseout', () => {
                            div.style.backgroundColor = '';
                        });
                        div.addEventListener('click', () => {
                            window.location.href = `/sp/chitiet/${product.id}`;
                        });
                        suggestionsBox.appendChild(div);
                    });
                    suggestionsBox.style.display = 'block';
                } else {
                    suggestionsBox.style.display = 'none';
                }

            })
            .catch(error => console.error('Error fetching suggestions:', error));
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const textElement = document.querySelector('.truncated-text');
        const originalText = textElement.innerText;

        function truncateText(text, maxWidth) {
            const words = text.split(' ');
            if (words.length <= 2) {
                return text;
            }
            let truncatedText = '...' + words.slice(-2).join(' ');
            textElement.innerText = truncatedText;

            while (textElement.scrollWidth > maxWidth && words.length > 2) {
                words.splice(-3, 1);
                truncatedText = '...' + words.slice(-2).join(' ');
                textElement.innerText = truncatedText;
            }

            return truncatedText;
        }

        textElement.innerText = truncateText(originalText, textElement.clientWidth);
    });
</script>
<script>
    function showSubcategories(id) {
        document.getElementById('subcategories-' + id).style.display = 'block';
    }

    function hideSubcategories(id) {
        document.getElementById('subcategories-' + id).style.display = 'none';
    }
</script>
