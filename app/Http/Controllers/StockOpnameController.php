<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\StockOpname;

class StockOpnameController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Stock Opname';
        $this->param['pageTitle'] = 'Stock Opname';
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
        $this->param['year'] = StockOpname::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        // $this->param['btn']['link'] = route('stock-opname.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $stockOpname = StockOpname::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $stockOpname = StockOpname::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('stock-opname.list-stock-opname', ['stockOpname' => $stockOpname], $this->param);
    }
}
