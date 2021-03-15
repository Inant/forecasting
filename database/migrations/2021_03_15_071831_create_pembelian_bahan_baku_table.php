<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianBahanBakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_bahan_baku', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('bulan');
            $table->mediumInteger('tahun');
            $table->decimal('qty_pembelian', 11,2);
            $table->decimal('nominal_pembelian', 13,2);
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
        Schema::dropIfExists('pembelian_bahan_baku');
    }
}
