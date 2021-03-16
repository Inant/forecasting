<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStockOpname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_opname', function (Blueprint $table) {
            $table->dropColumn('bahan_baku');
            $table->dropColumn('sparepart');
            $table->dropColumn('barang_jadi');
        });
        
        Schema::table('stock_opname', function (Blueprint $table) {
            $table->decimal('bahan_baku', 11,2);
            $table->decimal('sparepart', 11,2);
            $table->decimal('barang_jadi', 11,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_opname', function (Blueprint $table) {
            $table->decimal('bahan_baku', 11,2);
            $table->decimal('sparepart', 11,2);
            $table->decimal('barang_jadi', 11,2);
        });
    }
}
