@extends('fe.index')
@section('title', 'Thanh toán')
@section('thanhtoan')

<main>
    <section class="uk-section uk-section-small">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                <section class="uk-text-center">
                    <a class="uk-link-muted uk-text-small" href="{{ route('giohang') }}">
                        <span class="uk-margin-xsmall-right" uk-icon="icon: arrow-left; ratio: .75;"></span>
                        Trở về giỏ hàng
                    </a>
                    <h1 class="uk-margin-small-top uk-margin-remove-bottom">Thanh toán</h1>
                </section>
                <section>
                    <div class="uk-grid-large" uk-grid>
                        <div class="uk-grid-large uk-child-width-1-1 tm-checkout uk-width-expand@m" uk-grid>
                            <section>
                                <h2 class="tm-checkout-title">Thông tin liên lạc</h2>
                                <div class="uk-card uk-card-default uk-card-small uk-card-body tm-ignore-container">
                                    <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                                        <div>
                                            <label>
                                                <div class="uk-form-label uk-form-label-required">Tên</div>
                                                <input class="uk-input" type="text" name="ten" value="{{ Auth::user()->ten }}" readonly>
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <div class="uk-form-label uk-form-label-required">Số điện thoại</div>
                                                <input class="uk-input" type="tel" name="sdt" value="{{ Auth::user()->sodienthoai }}" readonly>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="tm-checkout-title">Vận chuyển</h2>
                                <div class="uk-card uk-card-default uk-card-small uk-card-body tm-ignore-container">
                                    <div class="uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-3@s uk-flex-center" uk-switcher="toggle: > * > .tm-choose" uk-grid>
                                        <div>
                                            <a class="tm-choose" href="#" onclick="setShippingMethod('cuahang')">
                                                <div class="tm-choose-title">Lấy tại cửa hàng</div>
                                            </a>
                                        </div>
                                        <div>
                                            <a class="tm-choose" href="#" onclick="setShippingMethod('giaohang')">
                                                <div class="tm-choose-title">Giao hàng</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="uk-switcher uk-margin">
                                        <section>
                                            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                                                <div class="uk-text-small">
                                                    <div class="uk-width-expand">
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.9540021159405!2d106.67529017552981!3d10.738028659899786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752fad0158a09f%3A0xfd0a6159277a3508!2zMTgwIMSQLiBDYW8gTOG7lywgUGjGsOG7nW5nIDQsIFF14bqtbiA4LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1716981122545!5m2!1svi!2s" width="850" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section>
                                            <div class="uk-grid-small" uk-grid>
                                                <div class="uk-width-expand">
                                                    @if(Auth::user()->diachi != '')
                                                    <label>
                                                        <div class="uk-form-label uk-form-label-required">Địa chỉ</div>
                                                        <input class="uk-input" style="width:700px;" type="text" name="diachi" value="{{ Auth::user()->diachi}}, {{ Auth::user()->xaphuong->name}}, {{ Auth::user()->quanhuyen->name}}, {{ Auth::user()->thanhpho->name}}" readonly>
                                                    </label>
                                                    @else
                                                    <label>
                                                        <div class="uk-form-label uk-form-label-required">Địa chỉ</div>
                                                        <input class="uk-input" type="text" name="diachi" placeholder="ban chua co dia chi" required>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <h2 class="tm-checkout-title">Thanh toán</h2>
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <div class="uk-card-body">
                                        <div class="uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-3@s uk-flex-center" uk-switcher="toggle: > * > .tm-choose" uk-grid>
                                            @foreach($pttt as $i)
                                            <div>
                                                <a id="payment-{{$i->id}}" class="tm-choose" href="#" onclick="setPaymentMethod('{{$i->id}}')">
                                                    <div class="tm-choose-title">{{$i->ten}}</div>
                                                    <div class="tm-choose-description">Mô tả phương thức thanh toán</div>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <form id="checkoutForm" action="{{route('checkout')}}" method="post">
                            @csrf
                            @php
                            $tongtam = $giohang->chitietgiohangs->sum(function ($chitiet) {
                            $sanpham = $chitiet->sanpham;
                            $soluong = $chitiet->soluong;
                            $gia_goc = $sanpham->gia;
                            $giamgia = $sanpham->giamgia && $sanpham->giamgia->danggiam == 1 && $sanpham->giamgia->soluongsanpham > 0 ? $sanpham->giamgia->giagiam : 0;

                            $phantram_giamgiahangloat = $sanpham->giamgiahangloat ? ($sanpham->giamgiahangloat->phantramgiamgia * $gia_goc / 100) : 0;
                            $giamgiahangloat = $sanpham->giamgiahangloat && $sanpham->giamgiahangloat->tinhtrang == 1 && $sanpham->giamgiahangloat->soluongsanpham > 0 ? ($phantram_giamgiahangloat > $sanpham->giamgiahangloat->giamtoida ? $sanpham->giamgiahangloat->giamtoida : $phantram_giamgiahangloat) : 0;

                            $soluong_giamgia = $sanpham->giamgia ? ($sanpham->giamgia->soluongsanpham ?? 0) : 0;
                            $soluong_giamgiahangloat = $sanpham->giamgiahangloat ? ($sanpham->giamgiahangloat->soluongsanpham ?? 0) : 0;

                            $soluong_cahai = min($soluong, min($soluong_giamgia, $soluong_giamgiahangloat));
                            $soluong_giamgia = max(0, min($soluong - $soluong_cahai, $soluong_giamgia - $soluong_cahai));
                            $soluong_giamgiahangloat = max(0, min($soluong - $soluong_cahai - $soluong_giamgia, $soluong_giamgiahangloat - $soluong_cahai));
                            $soluong_khonggiamgia = $soluong - $soluong_cahai - $soluong_giamgia - $soluong_giamgiahangloat;

                            $tong_tam = 0;
                            $tong_tam += $soluong_cahai * ($gia_goc - $giamgia - $giamgiahangloat);
                            $tong_tam += $soluong_giamgia * ($gia_goc - $giamgia);
                            $tong_tam += $soluong_giamgiahangloat * ($gia_goc - $giamgiahangloat);
                            $tong_tam += $soluong_khonggiamgia * $gia_goc;
                            return $tong_tam;
                            });

                            $giam = session('discount_amount', 0);
                            $tong = $tongtam - $giam;
                            $phi = 50000;
                            @endphp
                            <div class="uk-width-1-1 uk-width-1-4@m tm-aside-column">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container" uk-sticky="offset: 30; bottom: true; media: @m;">
                                    <section class="uk-card-body">
                                        <h4>Các mặt hàng theo thứ tự</h4>
                                        @foreach ($giohang->chitietgiohangs as $chitiet)
                                        @php
                                        $soluong = $chitiet->soluong;
                                        $giamgia_soluong = $chitiet->sanpham->giamgia &&  $chitiet->sanpham->giamgia->danggiam == 1 && $chitiet->sanpham->giamgia->soluongsanpham > 0 ? $chitiet->sanpham->giamgia->soluongsanpham : 0;
                                        $giamgiahangloat_soluong = $chitiet->sanpham->giamgiahangloat && $chitiet->sanpham->giamgiahangloat->tinhtrang == 1 && $chitiet->sanpham->giamgiahangloat->soluongsanpham > 0 ? $chitiet->sanpham->giamgiahangloat->soluongsanpham : 0;

                                        // Tính phần trăm giảm giá và giảm giá hàng loạt
                                        $phantram_giamgia = $chitiet->sanpham->giamgiahangloat ? ($chitiet->sanpham->giamgiahangloat->phantramgiamgia * $chitiet->sanpham->gia / 100) : 0;
                                        $giamgiahangloat = $chitiet->sanpham->giamgiahangloat && $chitiet->sanpham->giamgiahangloat->tinhtrang == 1 && $chitiet->sanpham->giamgiahangloat->soluongsanpham > 0 ? ($phantram_giamgia > $chitiet->sanpham->giamgiahangloat->giamtoida ? $chitiet->sanpham->giamgiahangloat->giamtoida : $phantram_giamgia) : 0;

                                        $giagiam =  $chitiet->sanpham->giamgia &&  $chitiet->sanpham->giamgia->danggiam == 1 && $chitiet->sanpham->giamgia->soluongsanpham > 0 ? $chitiet->sanpham->giamgia->giagiam : 0;
                                        $soluong_cahai = min($soluong, min($giamgia_soluong, $giamgiahangloat_soluong));
                                        $soluong_giamgia = max(0, min($soluong - $soluong_cahai, $giamgia_soluong - $soluong_cahai));
                                        $soluong_giamgiahangloat = max(0, min($soluong - $soluong_cahai - $soluong_giamgia, $giamgiahangloat_soluong - $soluong_cahai));
                                        $soluong_khonggiamgia = $soluong - $soluong_cahai - $soluong_giamgia - $soluong_giamgiahangloat;
                                        @endphp

                                        @if ($soluong_cahai > 0)
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-small" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">{{ $chitiet->sanpham->ten }}</div>
                                                <div class="uk-text-small">Số lượng: {{ $soluong_cahai }}</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div class="uk-text-muted uk-hidden@m">Giá</div>
                                                <del>{{ number_format($chitiet->sanpham->gia) }} đ</del>
                                                <div style="color: red;">{{ number_format($chitiet->sanpham->gia - $giagiam - $giamgiahangloat) }} đ</div>
                                            </div>
                                        </div>
                                        @endif

                                        {{-- Sản phẩm chỉ nhận giảm giá cá nhân --}}
                                        @if ($soluong_giamgia > 0)
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-small" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">{{ $chitiet->sanpham->ten }}</div>
                                                <div class="uk-text-small">Số lượng: {{ $soluong_giamgia }}</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div class="uk-text-muted uk-hidden@m">Giá</div>
                                                <del>{{ number_format($chitiet->sanpham->gia) }} đ</del>
                                                <div style="color: red;">{{ number_format($chitiet->sanpham->gia - $giagiam) }} đ</div>
                                            </div>
                                        </div>
                                        @endif

                                        {{-- Sản phẩm chỉ nhận giảm giá hàng loạt --}}
                                        @if ($soluong_giamgiahangloat > 0)
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-small" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">{{ $chitiet->sanpham->ten }}</div>
                                                <div class="uk-text-small">Số lượng: {{ $soluong_giamgiahangloat }}</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div class="uk-text-muted uk-hidden@m">Giá</div>
                                                <del>{{ number_format($chitiet->sanpham->gia) }} đ</del>
                                                <div style="color: red;">{{ number_format($chitiet->sanpham->gia - $giamgiahangloat) }} đ</div>
                                            </div>
                                        </div>
                                        @endif

                                        {{-- Sản phẩm không nhận giảm giá --}}
                                        @if ($soluong_khonggiamgia > 0)
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-small" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">{{ $chitiet->sanpham->ten }}</div>
                                                <div class="uk-text-small">Số lượng: {{ $soluong_khonggiamgia }}</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div class="uk-text-muted uk-hidden@m">Giá</div>
                                                <div>{{ number_format($chitiet->sanpham->gia) }} đ</div>
                                            </div>
                                        </div>
                                        @endif

                                        @if ($chitiet->sanpham->quatangs)
                                        @foreach ($chitiet->sanpham->quatangs as $quatang)
                                        @if(\Carbon\Carbon::parse($quatang->ngayketthuc)->gte(\Carbon\Carbon::now()) && $quatang->soluong > 0 )
                                        @php
                                        $soLuongQuaTang = 1 * $chitiet->soluong;
                                        $soluong = $quatang->soluong > $soLuongQuaTang ? $soLuongQuaTang : $quatang->soluong;
                                        @endphp
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-small" style="max-width: 200px; height: 100px; overflow: hidden; text-overflow: ellipsis;">(Quà tặng)<span style="color:red;">(SL còn:{{$quatang->soluong}})</span> {{ $quatang->sanpham->ten }} </div>
                                                <div class="uk-text-small">Số lượng: {{$soluong}} </div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div>0đ</div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                    </section>

                                    <section class="uk-card-body">
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-muted">Vận chuyển</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div id="shipping-info" class="uk-text-meta"></div>
                                            </div>

                                        </div>
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-muted">Thanh toán</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div id="payment-method"></div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="uk-card-body">
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-muted">Tạm tính</div>
                                            </div>

                                            <div class="uk-text-right">
                                                <div id="tongtam"></div>
                                            </div>
                                        </div>
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-muted">Giảm giá</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div class="uk-text-danger" id="giam">-{{number_format($giam)}}VNĐ</div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="uk-card-body">
                                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                                            <div class="uk-width-expand">
                                                <div class="uk-text-muted">Tổng</div>
                                            </div>
                                            <div class="uk-text-right">
                                                <div class="uk-text-lead uk-text-bolder" id="tong"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="phiship" id="phiship" value="">
                                        <input type="hidden" name="shipping_method" id="shipping_method" value="">
                                        <input type="hidden" name="payment_method" id="payment_method_input" value="">
                                        <input type="hidden" name="diachi" id="diachi" value="{{ Auth::user()->diachi }}, {{ Auth::user()->xaphuong->name }}, {{ Auth::user()->quanhuyen->name }}, {{ Auth::user()->thanhpho->name }}">
                                        <input type="hidden" name="tongall" id="tongall" value="">
                                        <button class="uk-button uk-button-primary uk-margin-small uk-width-1-1" type="submit">Checkout</button>
                                    </section>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paymentMethods = document.querySelectorAll('[id^="payment-"]');
        paymentMethods.forEach(function(paymentMethod) {
            paymentMethod.addEventListener('click', function(event) {
                event.preventDefault();
                var method = this.id.replace('payment-', '');
                setPaymentMethod(method);
            });
        });

        var shippingMethods = document.querySelectorAll('[id^="shipping-"]');
        shippingMethods.forEach(function(shippingMethod) {
            shippingMethod.addEventListener('click', function(event) {
                event.preventDefault();
                var method = this.id.replace('shipping-', '');
                setShippingMethod(method);
            });
        });
    });

    var valuetongtam = <?php echo $tongtam ?>;
    var valuegiam = <?php echo $giam ?>;
    var valuetong = <?php echo $tong ?>;

    function setShippingMethod(method) {
        document.getElementById('shipping_method').value = method;
        var phi = document.getElementById('shipping-info');
        var tongtam = document.getElementById('tongtam');
        var giam = document.getElementById('giam');
        var tong = document.getElementById('tong');

        if (method === 'cuahang') {
            phi.textContent = 'Tại cửa hàng';
            tongtam.textContent = new Intl.NumberFormat('vi-VN').format(valuetongtam) + 'đ';
            tong.textContent = new Intl.NumberFormat('vi-VN').format(valuetong) + 'đ';
            document.getElementById('tongall').value = valuetong;
        } else if (method === 'giaohang') {
            calculateShippingFee();
        }
    }

    function calculateShippingFee() {
        $.ajax({
            url: '{{ route("calculate-shipping") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                to_district_id: '{{ Auth::user()->maqh }}',
                to_ward_code: '{{ Auth::user()->xaid }}',
                nguoidung_id: '{{ Auth::user()->id }}',
                insurance_value: 10000,
                cod_failed_amount: 2000,
                coupon: null
            },

            success: function(response) {
                var total = parseFloat(response.data.total);
                if (isNaN(total)) {
                    console.error('Shipping fee is not a number:', response.data.total);
                    return;
                }
                var shippingFee = Math.floor(total / 1000) * 1000;
                var tongtam1 = valuetongtam + shippingFee;
                var tongall = valuetongtam + shippingFee - valuegiam;

                $('#shipping-info').text(new Intl.NumberFormat('vi-VN').format(shippingFee) + 'đ');
                $('#tongtam').text(new Intl.NumberFormat('vi-VN').format(tongtam1) + 'đ');
                $('#tong').text(new Intl.NumberFormat('vi-VN').format(tongall) + 'đ');
                $('#tongall').val(tongall);
                $('#phiship').val(shippingFee);
            },
            error: function(xhr, status, error) {
                console.error('Error calculating shipping fee:', error);
            }
        });
    }


    function setPaymentMethod(method) {
        document.getElementById('payment_method_input').value = method;

        var paymentMethodText = document.querySelector('#payment-' + method + ' .tm-choose-title').innerText;
        document.getElementById('payment-method').innerText = paymentMethodText;
    }

    function validateForm() {
        const shippingMethod = document.getElementById('shipping_method').value;
        const paymentMethod = document.getElementById('payment_method_input').value;

        if (!shippingMethod || !paymentMethod) {
            alert('Vui lòng chọn phương thức giao hàng và thanh toán.');
            return false;
        }
        return true;
    }
</script>




@endsection
