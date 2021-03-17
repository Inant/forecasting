<?php

namespace App\Http\Controllers;
use App\Models\PurchaseOrder;

use Illuminate\Http\Request;

class ForecastingController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'Peramalan Purchase Order';
        $this->param['pageTitle'] = 'Peramalan Purchase Order';
        $this->param['bulan'] = array(
            [
                'bulan' => '01',
                'nama' => 'Januari'
            ],
            [
                'bulan' => '02',
                'nama' => 'Februari'
            ],
            [
                'bulan' => '03',
                'nama' => 'Maret'
            ],
            [
                'bulan' => '04',
                'nama' => 'April'
            ],
            [
                'bulan' => '05',
                'nama' => 'Mei'
            ],
            [
                'bulan' => '06',
                'nama' => 'Juni'
            ],
            [
                'bulan' => '07',
                'nama' => 'Juli'
            ],
            [
                'bulan' => '08',
                'nama' => 'Agustus'
            ],
            [
                'bulan' => '09',
                'nama' => 'September'
            ],
            [
                'bulan' => '10',
                'nama' => 'Oktober'
            ],
            [
                'bulan' => '11',
                'nama' => 'November'
            ],
            [
                'bulan' => '12',
                'nama' => 'Desember'
            ],
        );
        $this->param['year'] = PurchaseOrder::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();

        try {
            if ($request->get('alpha')) {
                $this->param['alpha'] = $request->get('alpha');

                $this->param['purchaseOrder'] = PurchaseOrder::select('id', 'bulan', 'tahun', 'qty_po')->get()->toArray();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('peramalan-po.peramalan-po', $this->param);
    }
}