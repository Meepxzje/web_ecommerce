<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->unsignedBigInteger('danhmucid');
            $table->unsignedBigInteger('nhasanxuatid');
            $table->unsignedBigInteger('nhacungcapid');
            $table->text('mota')->nullable();
            $table->decimal('gia', 10, 2);
            $table->integer('soluong');
            $table->integer('daban')->default(0);
            $table->timestamps();
            $table->foreign('danhmucid')->references('id')->on('danhmuc');
            $table->foreign('nhasanxuatid')->references('id')->on('nhasanxuat');
            $table->foreign('nhacungcapid')->references('id')->on('nhacungcap');
        });
        Schema::create('thongsohieunang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('cpu');
            $table->string('tocdoxungnhipcoban');
            $table->string('tocdoxungnhiptoida');
            $table->string('ram');
            $table->string('loaibonho');
            $table->string('tocdobonho');
            $table->string('khecambonhokhadung')->nullable();
            $table->string('kieudohoa');
            $table->string('gpu');
            $table->string('gpuroi');
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('thongsomanhinh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('loaipanel');
            $table->string('kichthuoc');
            $table->string('tylekhunghinh');
            $table->string('dophangiai');
            $table->string('manhinhcamung')->nullable();
            $table->string('bemat')->nullable();
            $table->string('dosang')->nullable();
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('thongsoluutru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('khecamkhadung')->nullable();
            $table->string('tongdungluong');
            $table->string('luutru');
            $table->string('odia')->nullable();
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('thongsoketnoi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('cong');
            $table->integer('soluongcong');
            $table->string('hienthi')->nullable();
            $table->integer('soluongconghienthi');
            $table->string('amthanh1')->nullable();
            $table->string('amthanh2')->nullable();
            $table->string('amthanh3')->nullable();
            $table->string('khecaidatmorong')->nullable();
            $table->string('docthenho')->nullable();
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('thongsotruyenthong', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('ketnoimang')->nullable();
            $table->string('modem')->nullable();
            $table->string('wifi');
            $table->string('bluetooth');
            $table->string('bangthongdidong')->nullable();
            $table->string('gps')->nullable();
            $table->string('nfc')->nullable();
            $table->string('webcam');
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('thongsopin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('pin');
            $table->string('loai');
            $table->string('thoigiansudungtoida');
            $table->string('yeucaunangluong');
            $table->string('cungcapnangluong');
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('thongsotongquat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('hedieuhanh');
            $table->string('anninh')->nullable();
            $table->string('banphim');
            $table->string('thietbidiem');
            $table->string('kichthuoc');
            $table->string('trongluong');
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });
        Schema::create('danhmuc', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });

        Schema::create('nhacungcap', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('diachi');
            $table->string('sodienthoai');
            $table->string('email');
            $table->string('img');
            $table->timestamps();
        });

        Schema::create('nhasanxuat', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('diachi');
            $table->string('sodienthoai');
            $table->string('email');
            $table->string('img');

            $table->timestamps();
        });

        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('email')->unique();
            $table->string('matkhau');
            $table->string('sodienthoai')->nullable();
            $table->string('diachi')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->string('img')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('giohang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoidungid');
            $table->timestamps();
            $table->foreign('nguoidungid')->references('id')->on('nguoidung');
        });
        Schema::create('chitietgiohang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('giohangid');
            $table->unsignedBigInteger('sanphamid');
            $table->integer('soluong');
            $table->timestamps();
            $table->foreign('giohangid')->references('id')->on('giohang');
            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoidungid');
            $table->unsignedBigInteger('phuongthucthanhtoanid');
            $table->string('tinhtrang');
            $table->date('ngaydat');
            $table->string('diachigiaohang');
            $table->decimal('tongtien', 10, 2);
            $table->timestamps();
            $table->foreign('nguoidungid')->references('id')->on('nguoidung');
            $table->foreign('phuongthucthanhtoanid')->references('id')->on('phuongthucthanhtoan');
        });

        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donhangid');
            $table->unsignedBigInteger('sanphamid');
            $table->integer('soluong');
            $table->decimal('gia', 10, 2);
            $table->timestamps();

            $table->foreign('donhangid')->references('id')->on('donhang');
            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });


        Schema::create('phuongthucthanhtoan', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });


        Schema::create('danhgia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoidungid');
            $table->unsignedBigInteger('sanphamid');
            $table->tinyInteger('diem');
            $table->text('binhluan')->nullable();
            $table->timestamps();
            $table->foreign('nguoidungid')->references('id')->on('nguoidung');
            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });
        Schema::create('binhluan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoidungid');
            $table->unsignedBigInteger('sanphamid');
            $table->text('noidung');
            $table->timestamps();
            $table->foreign('nguoidungid')->references('id')->on('nguoidung');
            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('hinhanhsanpham', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->string('img');
            $table->timestamps();
            $table->foreign('sanphamid')->references('id')->on('sanpham');
        });

        Schema::create('xaphuongthitran', function (Blueprint $table) {
            $table->increments('xaid');
            $table->string('name');
            $table->string('type');
            $table->integer('maqh')->unsigned();
        });

        Schema::create('tinhthanhpho', function (Blueprint $table) {
            $table->increments('matp');
            $table->string('name');
            $table->string('type');
        });
        Schema::create('quanhuyen', function (Blueprint $table) {
            $table->increments('maqh');
            $table->string('name');
            $table->string('type');
            $table->integer('matp')->unsigned();
        });

        Schema::create('phivanchuyen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matp')->unsigned();
            $table->integer('maqh')->unsigned();
            $table->integer('maxp')->unsigned();
            $table->string('phivanchuyen');
        });

        Schema::create('cpus', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });
        Schema::create('gpus', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });
        Schema::create('rams', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });
        Schema::create('ssds', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });
        Schema::create('manhinhs', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });
        Schema::create('tansoquets', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });

        Schema::create('tamnens', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });

        Schema::create('dophangiais', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->timestamps();
        });


        Schema::create('quatangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sanphamid')->constrained('sanpham')->onDelete('cascade');
            $table->string('ten');
            $table->string('mota')->nullable();
            $table->integer('soluong');
            $table->timestamps();
        });

        Schema::create('giamgias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sanphamid')->constrained('sanpham')->onDelete('cascade');
            $table->decimal('giagiam', 15, 2);
            $table->boolean('danggiam')->default(0);
            $table->timestamps();
        });

        Schema::create('doitras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donhangid');
            $table->unsignedBigInteger('sanphamid');
            $table->string('lydo');
            $table->string('tinhtrang')->default('Đang xử lý');
            $table->timestamps();

            $table->foreign('donhangid')->references('id')->on('donhang')->onDelete('cascade');
            $table->foreign('sanphamid')->references('id')->on('sanpham')->onDelete('cascade');
        });

        Schema::create('magiamgias', function (Blueprint $table) {
            $table->id();
            $table->string('magiamgia')->unique();
            $table->decimal('phantramgiamgia', 5, 2)->nullable();
            $table->decimal('sotiengiamgiatoida', 8, 2)->nullable();
            $table->decimal('giatritoithieudonhang', 8, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('chitietmagiamgias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoidungid');
            $table->unsignedBigInteger('magiamgiaid');
            $table->timestamp('ngayhethan')->nullable();
            $table->timestamps();

            $table->foreign('nguoidungid')->references('id')->on('nguoidung')->onDelete('cascade');
            $table->foreign('magiamgiaid')->references('id')->on('magiamgias')->onDelete('cascade');
        });

        Schema::create('magiamgiasp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('magiamgiaid'); // ID mã giảm giá
            $table->unsignedBigInteger('sanphamid'); // ID sản phẩm
            $table->timestamps();
            $table->foreign('magiamgiaid')->references('id')->on('magiamgias')->onDelete('cascade');
            $table->foreign('sanphamid')->references('id')->on('sanpham')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('thongtindonggoi');
        Schema::dropIfExists('thongsotongquat');
        Schema::dropIfExists('thongsopin');
        Schema::dropIfExists('thongsotruyenthong');
        Schema::dropIfExists('thongsoketnoi');
        Schema::dropIfExists('thongsoluutru');
        Schema::dropIfExists('thongsomanhinh');
        Schema::dropIfExists('thongsohieunang');
        Schema::dropIfExists('thongso');
        Schema::dropIfExists('sanpham');
        Schema::dropIfExists('hinhanhsanpham');
        Schema::dropIfExists('binhluan');
        Schema::dropIfExists('danhgia');
        Schema::dropIfExists('phuongthucthanhtoan');
        Schema::dropIfExists('chitietdonhang');
        Schema::dropIfExists('donhang');
        Schema::dropIfExists('giohang');
        Schema::dropIfExists('nguoidung');
        Schema::dropIfExists('nhasanxuat');
        Schema::dropIfExists('nhacungcap');
        Schema::dropIfExists('danhmuc');
        Schema::dropIfExists('quanhuyen');
        Schema::dropIfExists('tinhthanhpho');
        Schema::dropIfExists('xaphuongthitran');
        Schema::dropIfExists('phivanchuyen');
        Schema::dropIfExists('cpus');
        Schema::dropIfExists('gpus');
        Schema::dropIfExists('rams');
        Schema::dropIfExists('ssds');
        Schema::dropIfExists('manhhinhs');
        Schema::dropIfExists('tansoquets');
        Schema::dropIfExists('tamnens');
        Schema::dropIfExists('dophangiais');
        Schema::dropIfExists('quatangs');
        Schema::dropIfExists('giamgias');
        Schema::dropIfExists('doitras');
        Schema::dropIfExists('magiamgiasp');
    }
};
