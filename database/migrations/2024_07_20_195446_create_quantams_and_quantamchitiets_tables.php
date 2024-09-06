<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuantamsAndQuantamchitietsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoidungid')->constrained('nguoidung')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('chitietquantams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quantamid')->constrained('quantams')->onDelete('cascade');
            $table->foreignId('sanphamid')->constrained('sanpham')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quantamchitiets');
        Schema::dropIfExists('quantams');
    }
}
