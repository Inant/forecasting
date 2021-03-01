<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('bulan');
            $table->mediumInteger('tahun');
            $table->decimal('qty_hasil_produksi', 11,2);
            // $table->decimal('nominal_bahan_baku', 13,2);
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
        Schema::dropIfExists('hasil_produksi');
    }
}
