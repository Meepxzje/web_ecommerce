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
        Schema::create('chitietdoitras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doitraid');
            $table->unsignedBigInteger('sanphamid');
            $table->integer('soluong');
            $table->timestamps();

            $table->foreign('doitraid')->references('id')->on('doitras')->onDelete('cascade');
            $table->foreign('sanphamid')->references('id')->on('sanphams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdoitras');
    }
};
