@extends('fe.pages.taikhoan')
@section('caidattaikhoan')
<div class="uk-width-1-1 uk-width-expand@m">
    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
        <header class="uk-card-header">
            <h1 class="uk-h2">Cài đặt</h1>
        </header>
        <div class="uk-card-body">
            <form method="POST" action="{{ route('doimatkhau') }}" class="uk-form-stacked">
                @csrf
                <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                    <fieldset class="uk-fieldset">
                        <legend class="uk-h4">Đổi Mật khẩu</legend>
                        <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                            <input type="hidden" value="{{ Auth::user()->id }}" name="nguoidungid">
                            <div>
                                <label>
                                    <div class="uk-form-label">Mật khẩu hiện tại</div>
                                    <input class="uk-input uk-form-width-large" type="password" name="pwcu">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <div class="uk-form-label " style="margin-top:20px;">Password mới</div>
                                    <input class="uk-input uk-form-width-large" type="password" name="pwmoi">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <div class="uk-form-label" style="margin-top:20px;">Xác nhận mật khẩu</div>
                                    <input class="uk-input uk-form-width-large" type="password" name="pwxn">
                                </label>
                            </div>
                            <div>
                                <div style="margin-top: 10px; margin-left: 20px;"></div>
                                <button type="submit" class="uk-button uk-button-primary">Cập nhật mật khẩu</button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
