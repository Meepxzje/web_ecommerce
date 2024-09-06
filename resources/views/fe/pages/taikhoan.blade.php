@extends('fe.index')
@section('title', 'Tài khoản khách hàng')
@section('taikhoan')
<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium" uk-grid>
                @include('fe.pages.taikhoan.menutaikhoan')
                @yield('dondathang')
                @yield('thongtincanhan')
                @yield('caidattaikhoan')
                @yield('quantam')
                @yield('magiamgia')
            </div>
        </div>
    </section>
</main>
@endsection
