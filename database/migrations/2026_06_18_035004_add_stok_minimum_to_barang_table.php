<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStokMinimumToBarangTable extends Migration
{
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            // Benar-benar dihapus ->after('stok') nya agar tidak memicu eror
            $table->integer('stok_minimum')->default(5);
        });
    }

    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('stok_minimum');
        });
    }
}
