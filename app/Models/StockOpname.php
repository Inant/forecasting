<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $table = 'stock_opname';

    protected $fillable = ['bulan', 'tahun', 'bahan_baku', 'sparepart', 'barang_jadi', 'created_at', 'updated_at'];
}
