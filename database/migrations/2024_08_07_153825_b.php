<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('luotxemsanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoidungid')->constrained('nguoidung')->onDelete('cascade');
            $table->foreignId('sanphamid')->constrained('sanpham')->onDelete('cascade');
            $table->timestamps();
        });

        // Tạo migration cho bảng muahang_sanpham
        Schema::create('muasanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoidungid')->constrained('nguoidung')->onDelete('cascade');
            $table->foreignId('sanphamid')->constrained('sanpham')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luotxemsanpham');
        Schema::dropIfExists('muasanpham');
    }
};
