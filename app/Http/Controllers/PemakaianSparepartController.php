<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PemakaianSparepart;
use App\Models\StockOpname;
class PemakaianSparepartController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Pemakaian Bahan Penunjang';
        $this->param['pageTitle'] = 'Pemakaian Bahan Penunjang';
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
        $this->param['year'] = PemakaianSparepart::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('pemakaian-sparepart.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $pemakaianSparepart = PemakaianSparepart::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $pemakaianSparepart = PemakaianSparepart::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('pemakaian-sparepart.list-pemakaian-sparepart', ['pemakaianSparepart' => $pemakaianSparepart], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Pemakaian Bahan Penunjang';
        $this->param['pageTitle'] = 'Pemakaian Bahan Penunjang';
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
        $this->param['btn']['link'] = route('pemakaian-sparepart.index');

        return \view('pemakaian-sparepart.tambah-pemakaian-sparepart', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_pemakaian' => 'required|numeric|gt:0',
            'nominal_pemakaian' => 'required|numeric|gt:0',
        ]);
        try{
            $cekMonth = PemakaianSparepart::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }
    
            $newPemakaianSparepart = new PemakaianSparepart;
    
            $newPemakaianSparepart->bulan = $request->get('bulan');
            $newPemakaianSparepart->tahun = $request->get('tahun');
            $newPemakaianSparepart->qty_pemakaian = $request->get('qty_pemakaian');
            $newPemakaianSparepart->nominal_pemakaian = $request->get('nominal_pemakaian');
    
            $newPemakaianSparepart->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'sparepart' => \DB::raw('sparepart-' . $request->get('qty_pemakaian'))
                ]);
            }
            else{
                $stockOpname = new StockOpname;
                $stockOpname->bulan = $request->get('bulan');
                $stockOpname->tahun = $request->get('tahun');
                $stockOpname->sparepart = $stockOpname->sparepart - $request->get('qty_pemakaian');
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
            $this->param['title'] = 'Edit Pemakaian Bahan Penunjang';
            $this->param['pageTitle'] = 'Pemakaian Bahan Penunjang';
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
            $this->param['btn']['link'] = route('pemakaian-sparepart.index');
            $this->param['pemakaianSparepart'] = PemakaianSparepart::find($id);

            return \view('pemakaian-sparepart.edit-pemakaian-sparepart', $this->param);
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
        $pemakaianSparepart = PemakaianSparepart::find($id);

        $cekMonth = PemakaianSparepart::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $pemakaianSparepart->bulan && $cekMonth[0]->tahun == $pemakaianSparepart->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $pemakaianSparepart->bulan && $cekMonth[0]->tahun != $pemakaianSparepart->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $pemakaianSparepart->bulan && $cekMonth[0]->tahun == $pemakaianSparepart->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $pemakaianSparepart->bulan && $cekMonth[0]->tahun != $pemakaianSparepart->tahun;

        if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
            return redirect()->back()->withError('Bulan dan tahun tidak valid.');
            // echo "fail";
        }

        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_pemakaian' => 'required|numeric|gt:0',
            'nominal_pemakaian' => 'required|numeric|gt:0',
        ]);
        try{

            StockOpname::where('bulan', $pemakaianSparepart->bulan)->where('tahun', $pemakaianSparepart->tahun)
                ->update([
                    'sparepart' => \DB::raw('sparepart+' . $pemakaianSparepart->qty_pemakaian)
                ]);

            $pemakaianSparepart->bulan = $request->get('bulan');
            $pemakaianSparepart->tahun = $request->get('tahun');
            $pemakaianSparepart->qty_pemakaian = $request->get('qty_pemakaian');
            $pemakaianSparepart->nominal_pemakaian = $request->get('nominal_pemakaian');
            $pemakaianSparepart->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'sparepart' => \DB::raw('sparepart-' . $request->get('qty_pemakaian'))
                ]);
            }
            else{
                $stockOpname = new StockOpname;
                $stockOpname->bulan = $request->get('bulan');
                $stockOpname->tahun = $request->get('tahun');
                $stockOpname->sparepart = $stockOpname->sparepart - $request->get('qty_pemakaian');
                $stockOpname->save();
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
            $pemakaianSparepart = PemakaianSparepart::findOrFail($id);

            StockOpname::where('bulan', $pemakaianSparepart->bulan)->where('tahun', $pemakaianSparepart->tahun)
                ->update([
                    'sparepart' => \DB::raw('sparepart+' . $pemakaianSparepart->qty_pemakaian)
                ]);

            $pemakaianSparepart->delete();

            return redirect()->route('pemakaian-sparepart.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('pemakaian-sparepart.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('pemakaian-sparepart.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
