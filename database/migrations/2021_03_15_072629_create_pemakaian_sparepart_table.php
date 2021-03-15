<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemakaianSparepartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakaian_sparepart', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('bulan');
            $table->mediumInteger('tahun');
            $table->decimal('qty_pemakaian', 11,2);
            $table->decimal('nominal_pemakaian', 13,2);
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
        Schema::dropIfExists('pemakaian_sparepart');
    }
}
