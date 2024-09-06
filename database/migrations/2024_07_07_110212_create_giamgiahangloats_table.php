<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('giamgiahangloats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanphamid');
            $table->decimal('phantramgiamgia', 5, 2);
            $table->decimal('giamtoida', 10, 2);
            $table->date('ngaybatdau');
            $table->date('ngayketthuc');
            $table->integer('soluongsanpham');
            $table->timestamps();

            $table->foreign('sanphamid')->references('id')->on('sanphams')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giamgiahangloats');
    }
};
