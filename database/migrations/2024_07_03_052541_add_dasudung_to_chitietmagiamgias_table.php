<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDasudungToChitietmagiamgiasTable extends Migration
{
    public function up()
    {
        Schema::table('chitietmagiamgias', function (Blueprint $table) {
            $table->boolean('dasudung')->default(true);
        });
    }

    public function down()
    {
        Schema::table('chitietmagiamgias', function (Blueprint $table) {
            $table->dropColumn('dasudung');
        });
    }
}

