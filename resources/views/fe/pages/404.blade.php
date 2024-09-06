@extends('fe.index')
@section('title', 'Không tìm thấy trang')
@section('404')

<section class="uk-section uk-section-small">
    <div class="uk-container">
        <div class="uk-text-center">
            <h1 class="uk-heading-hero">404</h1>
            <div class="uk-text-lead">Không tìm thấy trang</div>
            <div class="uk-margin-top">
                Có vẻ như trang bạn đang cố truy cập không tồn tại.<br /><a href="index.html">Quay lại Trang chủ</a>
            </div>
        </div>
    </div>
</section>

@endsection
