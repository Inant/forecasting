<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PembelianSparepart;
use \App\Models\StockOpname;

class PembelianSparepartController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Pembelian Bahan Penunjang';
        $this->param['pageTitle'] = 'Pembelian Bahan Penunjang';
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
        $this->param['year'] = PembelianSparepart::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('pembelian-sparepart.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $pembelianSparepart = PembelianSparepart::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $pembelianSparepart = PembelianSparepart::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('pembelian-sparepart.list-pembelian-sparepart', ['pembelianSparepart' => $pembelianSparepart], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Pembelian Bahan Penunjang';
        $this->param['pageTitle'] = 'Pembelian Bahan Penunjang';
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
        $this->param['btn']['text'] = 'Lihat Data';
        $this->param['btn']['link'] = route('pembelian-sparepart.index');

        return \view('pembelian-sparepart.tambah-pembelian-sparepart', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_pembelian' => 'required|numeric|gt:0',
            'nominal_pembelian' => 'required|numeric|gt:0',
        ]);
        try{
            $cekMonth = PembelianSparepart::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }
    
            $newPembelianSparepart = new PembelianSparepart;
    
            $newPembelianSparepart->bulan = $request->get('bulan');
            $newPembelianSparepart->tahun = $request->get('tahun');
            $newPembelianSparepart->qty_pembelian = $request->get('qty_pembelian');
            $newPembelianSparepart->nominal_pembelian = $request->get('nominal_pembelian');
    
            $newPembelianSparepart->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'sparepart' => \DB::raw('sparepart+' . $request->get('qty_pembelian'))
                ]);
            }
            else{
                $stockOpname = new StockOpname;
                $stockOpname->bulan = $request->get('bulan');
                $stockOpname->tahun = $request->get('tahun');
                $stockOpname->sparepart = $request->get('qty_pembelian');
                $stockOpname->save();
            }
    
            return redirect()->back()->withStatus('Data berhasil ditambahkan.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan. : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $this->param['title'] = 'Edit Pembelian Bahan Penunjang';
            $this->param['pageTitle'] = 'Pembelian Bahan Penunjang';
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
            $this->param['btn']['text'] = 'Lihat Data';
            $this->param['btn']['link'] = route('pembelian-sparepart.index');
            $this->param['pembelianSparepart'] = PembelianSparepart::find($id);

            return \view('pembelian-sparepart.edit-pembelian-sparepart', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $pembelianSparepart = PembelianSparepart::find($id);

        $cekMonth = PembelianSparepart::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $pembelianSparepart->bulan && $cekMonth[0]->tahun == $pembelianSparepart->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $pembelianSparepart->bulan && $cekMonth[0]->tahun != $pembelianSparepart->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $pembelianSparepart->bulan && $cekMonth[0]->tahun == $pembelianSparepart->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $pembelianSparepart->bulan && $cekMonth[0]->tahun != $pembelianSparepart->tahun;

        if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
            return redirect()->back()->withError('Bulan dan tahun tidak valid.');
            // echo "fail";
        }

        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_pembelian' => 'required|numeric|gt:0',
            'nominal_pembelian' => 'required|numeric|gt:0',
        ]);
        try{

            StockOpname::where('bulan', $pembelianSparepart->bulan)->where('tahun', $pembelianSparepart->tahun)
                ->update([
                    'sparepart' => \DB::raw('sparepart-' . $pembelianSparepart->qty_pembelian)
                ]);

            $pembelianSparepart->bulan = $request->get('bulan');
            $pembelianSparepart->tahun = $request->get('tahun');
            $pembelianSparepart->qty_pembelian = $request->get('qty_pembelian');
            $pembelianSparepart->nominal_pembelian = $request->get('nominal_pembelian');
            $pembelianSparepart->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'sparepart' => \DB::raw('sparepart+' . $request->get('qty_pembelian'))
                ]);
            }
            else{
                StockOpname::create([
                    'bulan' => $request->get('bulan'),
                    'tahun' => $request->get('tahun'),
                    'sparepart' => $request->get('qty_pembelian'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            return redirect()->back()->withStatus('Data berhasil diperbarui.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $pembelianSparepart = PembelianSparepart::findOrFail($id);

            StockOpname::where('bulan', $pembelianSparepart->bulan)->where('tahun', $pembelianSparepart->tahun)
                ->update([
                    'sparepart' => \DB::raw('sparepart-' . $pembelianSparepart->qty_pembelian)
                ]);

            $pembelianSparepart->delete();

            return redirect()->route('pembelian-sparepart.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('pembelian-sparepart.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('pembelian-sparepart.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
