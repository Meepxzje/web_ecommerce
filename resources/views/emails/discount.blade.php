<!DOCTYPE html>
<html>

<head>
    <title>Thông báo giảm giá</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Xin chào, {{ $nguoidung->ten }}</h1>
        <p>Dưới đây là các sản phẩm bạn quan tâm hiện đang được giảm giá:</p>

        @foreach($productsWithDiscounts as $productWithDiscount)
            @php
                $sanpham = $productWithDiscount['sanpham'];
                $giamgias = $productWithDiscount['giamgias'];
                $giamgiahangloats = $productWithDiscount['giamgiahangloats'];
                $giam = 0;
                if ($sanpham->giamgiahangloat != null && $sanpham->giamgiahangloat->tinhtrang == 1) {
                    $a = $sanpham->giamgiahangloat->phantramgiamgia * $sanpham->gia / 100;
                    $giam = $a > $sanpham->giamgiahangloat->giamtoida ? $sanpham->giamgiahangloat->giamtoida : $a;
                }
            @endphp

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $sanpham->ten }}</h5>
                    <p class="card-text">Giá gốc: <del>{{ number_format($sanpham->gia) }}đ</del></p>

                    @if($giamgias->count() > 0 && $giamgiahangloats->count() > 0)
                        <p class="card-text">Chỉ còn: <span class="text-danger">{{ number_format($sanpham->gia - $sanpham->giamgia->giagiam - $giam) }}đ</span></p>
                    @elseif($giamgiahangloats->count() > 0)
                        <p class="card-text">Chỉ còn: <span class="text-danger">{{ number_format($sanpham->gia - $giam) }}đ</span></p>
                    @elseif($giamgias->count() > 0)
                        <p class="card-text">Chỉ còn: <span class="text-danger">{{ number_format($sanpham->gia - $sanpham->giamgia->giagiam) }}đ</span></p>
                    @else
                        <p class="card-text">Chỉ còn: <span class="text-danger">{{ number_format($sanpham->gia) }}đ</span></p>
                    @endif
                    @foreach ($giamgias as $giamgia)
                        <p class="card-text">Giảm giá cửa hàng: {{ number_format($giamgia->giagiam) }}đ từ {{ $giamgia->ngaybatdau }} đến {{ $giamgia->ngayketthuc }}</p>
                    @endforeach
                    @foreach ($giamgiahangloats as $i)
                        <p class="card-text">Giảm giá hãng: {{ number_format($giam) }}đ từ {{ $i->ngaybatdau }} đến {{ $i->ngayketthuc }}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
