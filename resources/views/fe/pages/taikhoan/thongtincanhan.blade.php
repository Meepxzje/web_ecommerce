@extends('fe.pages.taikhoan')
@section('thongtincanhan')
<div class="uk-width-1-1 uk-width-expand@m">
    <form class="uk-form-stacked" action="{{route('capnhatnguoidung')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
            <header class="uk-card-header">
                <h1 class="uk-h2">Thông tin cá nhân</h1>
            </header>
            <div class="uk-card-body">
                <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                    <fieldset class="uk-fieldset">
                        <legend class="uk-h4">Liên hệ</legend>
                        <section>
                            <div class="uk-width-1-3 uk-width-1-4@s uk-width-1-2@m uk-margin-auto uk-visible-toggle uk-position-relative uk-border-circle uk-overflow-hidden uk-light" style="width: 200px; height: 200px;">
                                <label for="fileInput" style="cursor: pointer;">
                                    @if(isset($u->img))
                                    <img id="avatar" src="{{asset('font-end/img/taikhoan')}}/{{$u->img}}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @else
                                    <img id="avatar" src="{{asset('font-end/img/taikhoan/nguoidung.png')}}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @endif
                                </label>
                                <input type="file" id="fileInput" name="img" style="display: none;">
                            </div>
                        </section>
                        <div style="margin-top: 50px;"></div>
                        <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                            <div>
                                <label>
                                    <div class="uk-form-label">Tên</div>
                                    <input class="uk-input" type="text" name="ten" value="{{$u->ten}}">
                                </label>
                                @error('ten')
                                <div class="error-message" style="color: red;font-size: small;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label>
                                    <div class="uk-form-label">Số điện thoại</div>
                                    <input class="uk-input" type="tel" name="sdt" value="{{ old('sdt', $u->sodienthoai) }}">
                                </label>
                                @error('sdt')
                                <div class="error-message" style="color: red;font-size: small;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="uk-fieldset">
                        <legend class="uk-h4"></legend>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand">
                                <label>
                                    <div class="uk-form-label">Địa chỉ cụ thể</div>
                                    <input class="uk-input" style="width:700px;" type="text" name="diachi" value="{{ old('sdt',$u->diachi)}}">
                                    @error('diachi')
                                    <div class="error-message" style="color: red;font-size: small;">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label>

                                    <div class="uk-form-label">Thành phố</div>
                                    <select id="thanhpho" class="uk-select choose thanhpho" style="width:250px;" name="thanhpho">
                                        <option value="">Chọn thành phố</option>
                                        @foreach($thanhphos as $thanhpho)
                                        <option value="{{ $thanhpho->matp }}" @if($thanhpho->matp == $u->matp) selected @endif>{{ $thanhpho->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('thanhpho')
                                    <div class="error-message" style="color: red;font-size: small;">{{ $message }}</div>
                                    @enderror
                                </label>

                                <label>

                                    <div class="uk-form-label">Quận huyện</div>
                                    <select id="quanhuyen" class="uk-select quanhuyen choose" style="width:250px;" name="quanhuyen">
                                        <option value="">Chọn quận huyện</option>
                                        @foreach($quanhuyens as $quanhuyen)
                                        <option value="{{ $quanhuyen->maqh }}" @if($quanhuyen->maqh == $u->maqh) selected @endif>{{ $quanhuyen->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('quanhuyen')
                                    <div class="error-message" style="color: red;font-size: small;">{{ $message }}</div>
                                    @enderror
                                </label>

                                <label>
                                    <div class="uk-form-label">Xã phường</div>
                                    <select id="xaphuong" class="uk-select xaphuong choose" style="width:250px;" name="xaphuong">
                                        <option value="">Chọn xã phường</option>
                                        @foreach($xaphuongs as $xaphuong)
                                        <option value="{{ $xaphuong->xaid }}" @if($xaphuong->xaid == $u->xaid) selected @endif>{{ $xaphuong->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('xaphuong')
                                    <div class="error-message" style="color: red;font-size: small;">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="uk-card-footer uk-text-center">
                <button class="uk-button uk-button-primary" type="submit">Lưu</button>
            </div>
        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'thanhpho') {
                result = 'quanhuyen';
            } else {
                result = 'xaphuong';
            }

            $.ajax({
                url: ('/layquanhuyen'),
                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                }
            });
        });
    });
</script>


<script>
    document.getElementById('fileInput').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar').src = e.target.result;
        }
        reader.readAsDataURL(file);
    });
</script>
@endsection
