<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\PemakaianSparepart;
use App\Models\HasilProduksi;
use App\Models\PurchaseOrder;

class LaporanController extends Controller
{
    private $param;
    
    public function pemakaianBahanBaku (Request $request)
    {
        $this->param['title'] = 'Laporan Pemakaian Bahan Baku';
        $this->param['pageTitle'] = 'Laporan Pemakaian Bahan Baku';
        $this->param['year'] = BahanBaku::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();

        try {
            if ($request->get('tahun')) {
                $this->param['laporan'] = BahanBaku::where('tahun', $request->get('tahun'))->get();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('laporan.laporan-pemakaian-bahan-baku', $this->param);
    }

    public function pemakaianBahanPenunjang(Request $request)
    {
        $this->param['title'] = 'Laporan Pemakaian Bahan Penunjang';
        $this->param['pageTitle'] = 'Laporan Pemakaian Bahan Penunjang';
        $this->param['year'] = PemakaianSparepart::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();

        try {
            if ($request->get('tahun')) {
                $this->param['laporan'] = PemakaianSparepart::where('tahun', $request->get('tahun'))->get();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('laporan.laporan-pemakaian-bahan-penunjang', $this->param);
    }
    
    public function produksiBarangJadi(Request $request)
    {
        $this->param['title'] = 'Laporan Produksi Barang Jadi';
        $this->param['pageTitle'] = 'Laporan Produksi Barang Jadi';
        $this->param['year'] = HasilProduksi::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();

        try {
            if ($request->get('tahun')) {
                $this->param['laporan'] = HasilProduksi::where('tahun', $request->get('tahun'))->get();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('laporan.laporan-hasil-produksi', $this->param);
    }

    public function purchaseOrder(Request $request)
    {
        $this->param['title'] = 'Laporan Purchase Order';
        $this->param['pageTitle'] = 'Laporan Purchase Order';
        $this->param['year'] = PurchaseOrder::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();

        try {
            if ($request->get('tahun')) {
                $this->param['laporan'] = PurchaseOrder::where('tahun', $request->get('tahun'))->get();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('laporan.laporan-purchase-order', $this->param);
    }
}
