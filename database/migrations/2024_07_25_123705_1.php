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
        Schema::table('danhmuc', function (Blueprint $table) {
            $table->foreignId('parentid')->nullable()->constrained('danhmuc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('danhmuc', function (Blueprint $table) {
            $table->dropForeign(['parentid']);
            $table->dropColumn('parentid');
        });
    }
};
