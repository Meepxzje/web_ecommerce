@extends('admin.index')
@section('title', 'Thông số Sản Phẩm')
@section('sp(thongso)')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Cập nhật thông số sản phẩm {{$sp->ten}}</h1>
    <div> <a href="{{route('admin.indexsp')}}" class="btn btn-primary">Quay lại</a>
    </div>
    @if($sp->danhmucid == '1')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hiệu năng</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsohieunang', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nhasanxuat" class="form-label">CPU:</label>
                            <select name="cpu" class="form-control form-control-sm" style="width: 500px;">
                                @foreach($cpu as $i)
                                <option value="{{ $i->id }}" {{ $sp->thongsohieunang?->cpu == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tocdoxungnhipcoban">Tốc độ xung nhịp cơ bản</label>
                            <input type="text" class="form-control" id="tocdoxungnhipcoban" name="tocdoxungnhipcoban" value="{{ $sp->thongsohieunang?->tocdoxungnhipcoban ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tocdoxungnhiptoida">Tốc độ xung nhịp tối đa</label>
                            <input type="text" class="form-control" id="tocdoxungnhiptoida" name="tocdoxungnhiptoida" value="{{ $sp->thongsohieunang?->tocdoxungnhiptoida ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="ram" class="form-label">Ram:</label>
                            <select name="ram" class="form-control form-control-sm" style="width: 500px;">
                                @foreach($ram as $i)
                                <option value="{{ $i->id }}" {{ $sp->thongsohieunang?->ram == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="loaibonho">Loại bộ nhớ</label>
                            <input type="text" class="form-control" id="loaibonho" name="loaibonho" value="{{ $sp->thongsohieunang?->loaibonho ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tocdobonho">Tốc độ bộ nhớ</label>
                            <input type="text" class="form-control" id="tocdobonho" name="tocdobonho" value="{{ $sp->thongsohieunang?->tocdobonho ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="khecambonhokhadung">Khe cắm bộ nhớ khả dụng</label>
                            <input type="text" class="form-control" id="khecambonhokhadung" name="khecambonhokhadung" value="{{ $sp->thongsohieunang?->khecambonhokhadung ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="kieudohoa">Kiểu đồ họa</label>
                            <input type="text" class="form-control" id="kieudohoa" name="kieudohoa" value="{{ $sp->thongsohieunang?->kieudohoa ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="gpu">GPU</label>
                            <input type="text" class="form-control" id="gpu" name="gpu" value="{{ $sp->thongsohieunang?->gpu ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="gpuroi" class="form-label">GPU - Rời:</label>
                            <select name="gpuroi" class="form-control form-control-sm" style="width: 500px;">
                                @foreach($gpu as $i)
                                <option value="{{ $i->id }}" {{ $sp->thongsohieunang?->gpuroi == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ổ đĩa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsoluutru', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="khecamkhadung">Khe cắm khả dụng</label>
                            <input type="text" class="form-control" id="khecamkhadung" name="khecamkhadung" value="{{ $sp->thongsoluutru?->khecamkhadung ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="tongdungluong" class="form-label">Tổng dung lượng</label>
                            <select name="tongdungluong" class="form-control form-control-sm" style="width: 500px;">
                                @foreach($ssd as $i)
                                <option value="{{ $i->id }}" {{ $sp->thongsoluutru?->tongdungluong == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="luutru">Lưu trữ</label>
                            <input type="text" class="form-control" id="luutru" name="luutru" value="{{$sp->thongsoluutru?->luutru ?? ''  }}">
                        </div>
                        <div class="form-group">
                            <label for="odia">Ổ đĩa</label>
                            <input type="text" class="form-control" id="odia" name="odia" value="{{ $sp->thongsoluutru?->odia ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Truyền thông</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsotruyenthong', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="ketnoimang">Kết nối mạng</label>
                            <input type="text" class="form-control" id="ketnoimang" name="ketnoimang" value="{{ $sp->thongsotruyenthong?->ketnoimang ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="modem">Modem</label>
                            <input type="text" class="form-control" id="modem" name="modem" value="{{ $sp->thongsotruyenthong?->modem ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="wifi">Wifi</label>
                            <input type="text" class="form-control" id="wifi" name="wifi" value="{{ $sp->thongsotruyenthong?->wifi ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="bluetooth">Bluetooth</label>
                            <input type="text" class="form-control" id="bluetooth" name="bluetooth" value="{{ $sp->thongsotruyenthong?->bluetooth ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="bangthongdidong">Băng thông di động</label>
                            <input type="text" class="form-control" id="bangthongdidong" name="bangthongdidong" value="{{ $sp->thongsotruyenthong?->bangthongdidong ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="gps">GPS</label>
                            <input type="text" class="form-control" id="gps" name="gps" value="{{ $sp->thongsotruyenthong?->gps ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="nfc">NFC</label>
                            <input type="text" class="form-control" id="nfc" name="nfc" value="{{ $sp->thongsotruyenthong?->nfc ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="webcam">Webcam</label>
                            <input type="text" class="form-control" id="webcam" name="webcam" value="{{ $sp->thongsotruyenthong?->webcam ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>

                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tổng quát</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsotongquat', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="hedieuhanh">Hệ điều hành</label>
                            <input type="text" class="form-control" id="hedieuhanh" name="hedieuhanh" value="{{ $sp->thongsotongquat?->hedieuhanh ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="anninh">An ninh</label>
                            <input type="text" class="form-control" id="anninh" name="anninh" value="{{ $sp->thongsotongquat?->anninh ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="banphim">Bàn phím</label>
                            <input type="text" class="form-control" id="banphim" name="banphim" value="{{ $sp->thongsotongquat?->banphim ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="thietbidiem">Thiết bị điểm</label>
                            <input type="text" class="form-control" id="thietbidiem" name="thietbidiem" value="{{ $sp->thongsotongquat?->thietbidiem ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="kichthuoc">Kích thước</label>
                            <input type="text" class="form-control" id="kichthuoc" name="kichthuoc" value="{{ $sp->thongsotongquat?->kichthuoc ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="trongluong">Trọng lượng</label>
                            <input type="text" class="form-control" id="trongluong" name="trongluong" value="{{ $sp->thongsotongquat?->trongluong ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Màn hình</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsomanhinh', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="loaipanel">Loại Panel</label>
                            <input type="text" class="form-control" id="loaipanel" name="loaipanel" value="{{ optional($sp->thongsomanhinh)->loaipanel }}">
                        </div>
                        <div class="mb-3">
                            <label for="kichthuoc" class="form-label">Kích Thước</label>
                            <select name="kichthuoc" class="form-control form-control-sm" style="width: 500px;">
                                @foreach($manhinh as $i)
                                <option value="{{ $i->id }}" {{ $sp->thongsomanhinh?->kichthuoc == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tylekhunghinh">Tỷ Lệ Khung Hình</label>
                            <input type="text" class="form-control" id="tylekhunghinh" name="tylekhunghinh" value="{{ optional($sp->thongsomanhinh)->tylekhunghinh }}">
                        </div>
                        <div class="form-group">
                            <label for="dophangiai">Độ Phân Giải</label>
                            <input type="text" class="form-control" id="dophangiai" name="dophangiai" value="{{ optional($sp->thongsomanhinh)->dophangiai }}">
                        </div>
                        <div class="form-group">
                            <label for="manhinhcamung">Màn Hình Cảm Ứng</label>
                            <input type="text" class="form-control" id="manhinhcamung" name="manhinhcamung" value="{{ optional($sp->thongsomanhinh)->manhinhcamung }}">
                        </div>
                        <div class="form-group">
                            <label for="bemat">Bề Mặt</label>
                            <input type="text" class="form-control" id="bemat" name="bemat" value="{{ optional($sp->thongsomanhinh)->bemat }}">
                        </div>
                        <div class="form-group">
                            <label for="dosang">Độ Sáng</label>
                            <input type="text" class="form-control" id="dosang" name="dosang" value="{{ optional($sp->thongsomanhinh)->dosang }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>

                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cổng kết nối input/output</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsoketnoi', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="cong">Cổng</label>
                            <input type="text" class="form-control" id="cong" name="cong" value="{{ $sp->thongsoketnoi->cong ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="soluongcong">Số lượng cổng</label>
                            <input type="number" class="form-control" id="soluongcong" name="soluongcong" value="{{ $sp->thongsoketnoi->soluongcong ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="hienthi">Hiển thị</label>
                            <input type="text" class="form-control" id="hienthi" name="hienthi" value="{{ $sp->thongsoketnoi->hienthi ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="soluongconghienthi">Số lượng cổng hiển thị</label>
                            <input type="number" class="form-control" id="soluongconghienthi" name="soluongconghienthi" value="{{ $sp->thongsoketnoi->soluongconghienthi ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="amthanh1">Âm thanh 1</label>
                            <input type="text" class="form-control" id="amthanh1" name="amthanh1" value="{{ $sp->thongsoketnoi->amthanh1 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="amthanh2">Âm thanh 2</label>
                            <input type="text" class="form-control" id="amthanh2" name="amthanh2" value="{{ $sp->thongsoketnoi->amthanh2 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="amthanh3">Âm thanh 3</label>
                            <input type="text" class="form-control" id="amthanh3" name="amthanh3" value="{{ $sp->thongsoketnoi->amthanh3 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="khecaidatmorong">Khe cài đặt mở rộng</label>
                            <input type="text" class="form-control" id="khecaidatmorong" name="khecaidatmorong" value="{{ $sp->thongsoketnoi->khecaidatmorong ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="docthenho">Đọc thẻ nhớ</label>
                            <input type="text" class="form-control" id="docthenho" name="docthenho" value="{{ $sp->thongsoketnoi->docthenho ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pin</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thongsopin', ['id' => $sp->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="pin">Pin</label>
                            <input type="text" class="form-control" id="pin" name="pin" value="{{ $sp->thongsopin->pin ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="loai">Loại pin</label>
                            <input type="text" class="form-control" id="loai" name="loai" value="{{ $sp->thongsopin->loai ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="thoigiansudungtoida">Thời gian sử dụng tối đa</label>
                            <input type="text" class="form-control" id="thoigiansudungtoida" name="thoigiansudungtoida" value="{{ $sp->thongsopin->thoigiansudungtoida ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="yeucaunangluong">Yêu cầu năng lượng</label>
                            <input type="text" class="form-control" id="yeucaunangluong" name="yeucaunangluong" value="{{ $sp->thongsopin->yeucaunangluong ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="cungcapnangluong">Cung cấp năng lượng</label>
                            <input type="text" class="form-control" id="cungcapnangluong" name="cungcapnangluong" value="{{ $sp->thongsopin->cungcapnangluong ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    @endif
    @if($sp->danhmucid == '2')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông số Bàn Phím</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.thongsopkbanphim',['id'=>$sp->id]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Loại kết nối</label>
                                <select name="loaibanphim" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($loaibanphim as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkbanphim?->loaibanphim == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="congketnoi" class="form-label">Cổng Kết Nối:</label>
                                <textarea name="congketnoi" class="form-control">{{ $sp->thongsopkbanphim?->congketnoi ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Kiểu dáng bàn phím</label>
                                <select name="kieudangbanphim" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($kieudangbanphim as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkbanphim?->kieudangbanphim == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kichthuoc" class="form-label">Kích thước</label>
                                <input type="text" name="kichthuoc" class="form-control" placeholder="dài rộng ngang" value="{{ $sp->thongsopkbanphim->kichthuoc ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Loại Keycap</label>
                                <select name="keycap" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($keycap as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkbanphim?->keycap == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="motakeycap" class="form-label">Mô tả keycap</label>
                                <input type="text" name="motakeycap" class="form-control" placeholder="ví dụ loại là PBT thì ở dây ghi là double-shot" value="{{ $sp->thongsopkbanphim->motakeycap ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="switch" class="form-label">Loại Switch</label>
                                <input type="text" name="switch" class="form-control" value="{{ $sp->thongsopkbanphim->switch ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="pin" class="form-label">Pin</label>
                                <input type="text" name="pin" class="form-control" placeholder="có pin nếu ko dây" value="{{ $sp->thongsopkbanphim->pin ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="phukien" class="form-label">Phụ kiện</label>
                                <textarea name="phukien" class="form-control">{{ $sp->thongsopkbanphim->phukien ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($sp->danhmucid == '3')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông số RAM</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.thongsopkram', ['id' => $sp->id]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Tổng dung lượng</label>
                                <select name="dungluong" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($ram as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkram?->dungluong == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tổng dung lượng</label>
                                <select name="loairam" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($loairam as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkram?->loairam == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tốc độ Bus</label>
                                <select name="tocdobus" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($busram as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkram?->tocdobus == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($sp->danhmucid == '4')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông số màn hình</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.thongsopkmanhinh', ['id' => $sp->id]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Kích thước màn hình</label>
                                <select name="kichthuoc" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($manhinh as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkmanhinh?->kichthuoc == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Độ phân giải</label>
                                <select name="dophangiai" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($dophangiai as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkmanhinh?->dophangiai == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tấm nền</label>
                                <select name="tamnen" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($tamnen as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkmanhinh?->tamnen == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Tần số quét</label>
                                <select name="tansoquet" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($tansoquet as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkmanhinh?->tansoquet == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dosang" class="form-label">Độ Sáng (nits):</label>
                                <select name="dosang" class="form-control">
                                    <option value="250">250 nits</option>
                                    <option value="300">300 nits</option>
                                    <option value="350">350 nits</option>
                                    <option value="400">400 nits</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dotuongphan" class="form-label">Độ Tương Phản:</label>
                                <select name="dotuongphan" class="form-control">
                                    <option value="1000:1">1000:1</option>
                                    <option value="3000:1">3000:1</option>
                                    <option value="5000:1">5000:1</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="congketnoi" class="form-label">Cổng Kết Nối:</label>
                                <textarea name="congketnoi" class="form-control">{{ $sp->thongsopkmanhinh->congketnoi ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm Thông Số Màn Hình</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($sp->danhmucid == '5')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông số Tai Nghe</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.thongsopktainghe', ['id' => $sp->id]) }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                <label for="" class="form-label">Loại kết nối</label>
                                <select name="loaiketnoi" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($loaibanphim as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopktainghe?->loaiketnoi == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Kiểu kết nối</label>
                                <select name="kieutainghe" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($kieutainghe as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopktainghe?->loaiketnoi == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cổng kết nối</label>
                                <select name="congketnoi" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($congketnoi as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopktainghe?->congketnoi == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mausac" class="form-label">Màu sắc:</label>
                                <input type="text" name="mausac" class="form-control" value="{{ $sp->thongsopktainghe->mausac ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label for="micro" class="form-label">Micro(co hay khong):</label>
                                <input type="text" name="micro" class="form-control" value="{{ $sp->thongsopktainghe->micro ?? '' }}">
                            </div>


                            <div class="mb-3">
                                <label for="day" class="form-label">Dây (nếu có):</label>
                                <input type="text" name="day" class="form-control" value="{{ $sp->thongsopktainghe->day ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label for="tuongthich" class="form-label">Tương thích(PC, Mac, PlayStation 4/5, Xbox One / Series XS, Nintendo Switch, Mobile devices)</label>
                                <input type="text" name="tuongthich" class="form-control" value="{{ $sp->thongsopktainghe->tuongthich ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label for="cacham" class="form-label">Cách âm(co hay khong):</label>
                                <input type="text" name="cacham" class="form-control" value="{{ $sp->thongsopktainghe->cacham ?? '' }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($sp->danhmucid == '7')
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông số Chuột</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.thongsopkchuot', ['id' => $sp->id]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Loại kết nối</label>
                                <select name="loaiketnoi" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($loaibanphim as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkchuot?->loaiketnoi == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cổng kết nối</label>
                                <select name="kieuketnoi" class="form-control form-control-sm" style="width: 500px;">
                                    @foreach($congketnoi as $i)
                                    <option value="{{ $i->id }}" {{ $sp->thongsopkchuot?->kieuketnoi == $i->id ? 'selected' : '' }}>{{ $i->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mausac" class="form-label">Màu sắc:</label>
                                <input name="mausac" class="form-control" value="{{ $sp->thongsopkchuot?->mausac ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="led" class="form-label">Led (RGB,..)</label>
                                <input type="text" name="led" class="form-control" value="{{ $sp->thongsopkchuot->led ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="donhay" class="form-label">Độ nhạy(800/1600/2400/3200/6400/10000 DPI)</label>
                                <input type="text" name="donhay" class="form-control" value="{{ $sp->thongsopkchuot->donhay ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label for="phukien" class="form-label">Phụ kiện đi kèm</label>
                                <input type="text" name="phukien" class="form-control" value="{{ $sp->thongsopkchuot->phukien ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
