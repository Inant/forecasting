<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\BahanBaku;
use \App\Models\PemakaianSparepart;
use \App\Models\HasilProduksi;
use \App\Models\PurchaseOrder;

class DashboardController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'Dashboard';
        $this->param['pageTitle'] = 'Dashboard';

        
        try {
            $this->param['bahanBaku'] = BahanBaku::select('bulan','tahun', 'qty_bahan_baku')->orderBy('tahun', 'DESC')->orderBy('bulan','DESC')->first();

            $this->param['sparepart'] = PemakaianSparepart::select('bulan','tahun', 'qty_pemakaian')->orderBy('tahun', 'DESC')->orderBy('bulan','DESC')->first();

            $this->param['produksi'] = HasilProduksi::select('bulan','tahun', 'qty_hasil_produksi')->orderBy('tahun', 'DESC')->orderBy('bulan','DESC')->first();

            $this->param['purchaseOrder'] = PurchaseOrder::select('bulan','tahun', 'qty_po')->orderBy('tahun', 'DESC')->orderBy('bulan','DESC')->first();
            
            $getGrafikPo = PurchaseOrder::select('bulan', 'tahun', 'qty_po')->orderBy('tahun', 'DESC')->orderBy('bulan','DESC')->take(6)->get()->reverse();

            $getGrafikRendemen = HasilProduksi::select('bulan', 'tahun', 'rendemen')->orderBy('tahun', 'DESC')->orderBy('bulan','DESC')->take(6)->get()->reverse();

            $qty = "";
            $rendemen = "";
            $label = "";

            foreach ($getGrafikPo as $key => $value) {
                $key < count($getGrafikPo) ? $qty .= $value->qty_po.',' : $qty .= $value->qty_po;

                $key < count($getGrafikPo) ? $label .= getNamaBulan($value->bulan) . '-' . $value->tahun .',' : $label .= getNamaBulan($value->bulan) . '-' . $value->tahun;
            }

            foreach ($getGrafikRendemen as $key => $value) {
                $key < count($getGrafikRendemen) ? $rendemen .= $value->rendemen.',' : $rendemen .= $value->rendemen;

                // $key < count($getGrafikPo) ? $label .= getNamaBulan($value->bulan) . '-' . $value->tahun .',' : $label .= getNamaBulan($value->bulan) . '-' . $value->tahun;
            }

            $this->param['label'] = rtrim($label, ", ");
            $this->param['qty'] = rtrim($qty, ",");
            $this->param['rendemen'] = rtrim($rendemen, ",");

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
        
        return \view('dashboard', $this->param);
    }
}
