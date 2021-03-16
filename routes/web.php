<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard','pageTitle' => 'Dasboard']);

})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::resource('user', 'UserController');
    Route::resource('pembelian-bahan-baku', 'PembelianBahanBakuController');
    Route::resource('pembelian-sparepart', 'PembelianSparepartController');
    Route::resource('pemakaian-sparepart', 'PemakaianSparepartController');
    Route::resource('bahan-baku', 'BahanBakuController');
    Route::resource('hasil-produksi', 'HasilProduksiController');
    Route::resource('pemakaian-barang-jadi', 'PemakaianBarangJadiController');
    Route::resource('purchase-order', 'PurchaseOrderController');
    Route::get('stock-opname', 'StockOpnameController@index')->name('stock-opname');
});
