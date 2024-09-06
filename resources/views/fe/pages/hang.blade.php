@extends('fe.index')
@section('title', 'Hãng')
@section('hang')

<body>
    <div class="uk-offcanvas-content">

        <main>
            <section class="uk-section uk-section-small">
                <div class="uk-container">
                    <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                        <div class="uk-text-center">
                            <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><span>Hãng</span></li>
                            </ul>
                            <h1 class="uk-margin-small-top uk-margin-remove-bottom">
                                Hãng
                            </h1>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default tm-ignore-container">
                                <header class="uk-card-header uk-background-default">
                                    <nav>
                                        <ul class="uk-subnav uk-flex-center uk-margin-remove">
                                            <li><a href="#number">#</a></li>
                                            <li><a href="#A">A</a></li>
                                            <li><a href="#B">B</a></li>
                                            <li><a href="#C">C</a></li>
                                            <li><a href="#D">D</a></li>
                                            <li><a href="#E">E</a></li>
                                            <li><a href="#F">F</a></li>
                                            <li><a href="#G">G</a></li>
                                            <li><a href="#H">H</a></li>
                                            <li><a href="#I">I</a></li>
                                            <li><a href="#J">J</a></li>
                                            <li><a href="#K">K</a></li>
                                            <li><a href="#L">L</a></li>
                                            <li><a href="#M">M</a></li>
                                            <li><a href="#N">N</a></li>
                                            <li><a href="#O">O</a></li>
                                            <li><a href="#P">P</a></li>
                                            <li><a href="#Q">Q</a></li>
                                            <li><a href="#R">R</a></li>
                                            <li><a href="#S">S</a></li>
                                            <li><a href="#T">T</a></li>
                                            <li><a href="#U">U</a></li>
                                            <li><a href="#V">V</a></li>
                                            <li><a href="#W">W</a></li>
                                            <li><a href="#X">X</a></li>
                                            <li><a href="#Y">Y</a></li>
                                            <li><a href="#Z">Z</a></li>
                                        </ul>
                                    </nav>
                                </header>
                                <section class="uk-card-body" id="A">
                                    <div uk-grid>
                                        <div class="uk-width-1-1 uk-width-1-6@m">
                                            <h2 class="uk-text-center">A</h2>
                                        </div>
                                        <div class="uk-width-1-1 uk-width-expand@m">
                                            <ul class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@s uk-child-width-1-5@m" uk-grid>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/apple.svg')}}" alt="Apple" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Apple
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/samsung.svg')}}" alt="Samsung" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Samsung
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/sony.svg')}}" alt="Sony" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Sony
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/microsoft.svg')}}" alt="Microsoft" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Microsoft
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/intel.svg')}}" alt="Intel" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Intel
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/hp.svg')}}" alt="HP" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            HP
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/lg.svg')}}" alt="LG" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            LG
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/lenovo.svg')}}" alt="Lenovo" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Lenovo
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/asus.svg')}}"" alt=" ASUS" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            ASUS
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/acer.svg')}}" alt="Acer" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Acer
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/dell.svg')}}" alt="Dell" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Dell
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="uk-link-muted uk-text-center uk-display-block uk-padding-small uk-box-shadow-hover-large" href="#">
                                                        <div class="tm-ratio tm-ratio-4-3">
                                                            <div class="tm-media-box">
                                                                <figure class="tm-media-box-wrap">
                                                                    <img src="{{asset('font-end/images/brands/canon.svg')}}" alt="Canon" />
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="uk-margin-small-top uk-text-truncate">
                                                            Canon
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                                <section class="uk-card-body" id="B">
                                    <div uk-grid>
                                        <div class="uk-width-1-1 uk-width-1-6@m">
                                            <h2 class="uk-text-center">B</h2>
                                        </div>
                                        <div class="uk-width-1-1 uk-width-expand@m"></div>
                                    </div>
                                </section>
                                <section class="uk-card-body" id="C">
                                    <div uk-grid>
                                        <div class="uk-width-1-1 uk-width-1-6@m">
                                            <h2 class="uk-text-center">C</h2>
                                        </div>
                                        <div class="uk-width-1-1 uk-width-expand@m"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

@endsection
