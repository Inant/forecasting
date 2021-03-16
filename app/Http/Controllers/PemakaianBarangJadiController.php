<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PemakaianBarangJadi;
use \App\Models\StockOpname;
class PemakaianBarangJadiController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Pemakaian Barang Jadi';
        $this->param['pageTitle'] = 'Pemakaian Barang Jadi';
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
        $this->param['year'] = PemakaianBarangJadi::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('pemakaian-barang-jadi.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $pemakaianBarangJadi = PemakaianBarangJadi::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $pemakaianBarangJadi = PemakaianBarangJadi::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('pemakaian-barang-jadi.list-pemakaian-barang-jadi', ['pemakaianBarangJadi' => $pemakaianBarangJadi], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Pemakaian Barang Jadi';
        $this->param['pageTitle'] = 'Pemakaian Barang Jadi';
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
        $this->param['btn']['link'] = route('pemakaian-barang-jadi.index');

        return \view('pemakaian-barang-jadi.tambah-pemakaian-barang-jadi', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_pemakaian' => 'required|numeric|gt:0',
            
        ]);
        try{
            $cekMonth = PemakaianBarangJadi::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }
    
            $newPemakaianBarangJadi = new PemakaianBarangJadi;
    
            $newPemakaianBarangJadi->bulan = $request->get('bulan');
            $newPemakaianBarangJadi->tahun = $request->get('tahun');
            $newPemakaianBarangJadi->qty_pemakaian = $request->get('qty_pemakaian');
    
            $newPemakaianBarangJadi->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'barang_jadi' => \DB::raw('barang_jadi-' . $request->get('qty_pemakaian'))
                ]);
            }
            else{
                $stockOpname = new StockOpname;
                $stockOpname->bulan = $request->get('bulan');
                $stockOpname->tahun = $request->get('tahun');
                $stockOpname->barang_jadi = $stockOpname->barang_jadi - $request->get('qty_pemakaian');
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
            $this->param['title'] = 'Edit Pemakaian Barang Jadi';
            $this->param['pageTitle'] = 'Pemakaian Barang Jadi';
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
            $this->param['btn']['link'] = route('pemakaian-barang-jadi.index');
            $this->param['pemakaianBarangJadi'] = PemakaianBarangJadi::find($id);

            return \view('pemakaian-barang-jadi.edit-pemakaian-barang-jadi', $this->param);
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
        $pemakaianBarangJadi = PemakaianBarangJadi::find($id);

        $cekMonth = PemakaianBarangJadi::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $pemakaianBarangJadi->bulan && $cekMonth[0]->tahun == $pemakaianBarangJadi->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $pemakaianBarangJadi->bulan && $cekMonth[0]->tahun != $pemakaianBarangJadi->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $pemakaianBarangJadi->bulan && $cekMonth[0]->tahun == $pemakaianBarangJadi->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $pemakaianBarangJadi->bulan && $cekMonth[0]->tahun != $pemakaianBarangJadi->tahun;

        if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
            return redirect()->back()->withError('Bulan dan tahun tidak valid.');
            // echo "fail";
        }

        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_pemakaian' => 'required|numeric|gt:0',
            
        ]);
        try{

            StockOpname::where('bulan', $pemakaianBarangJadi->bulan)->where('tahun', $pemakaianBarangJadi->tahun)
                ->update([
                    'barang_jadi' => \DB::raw('barang_jadi+' . $pemakaianBarangJadi->qty_pemakaian)
                ]);


            $pemakaianBarangJadi->bulan = $request->get('bulan');
            $pemakaianBarangJadi->tahun = $request->get('tahun');
            $pemakaianBarangJadi->qty_pemakaian = $request->get('qty_pemakaian');
            $pemakaianBarangJadi->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'barang_jadi' => \DB::raw('barang_jadi-' . $request->get('qty_pemakaian'))
                ]);
            }
            else{
                $stockOpname = new StockOpname;
                $stockOpname->bulan = $request->get('bulan');
                $stockOpname->tahun = $request->get('tahun');
                $stockOpname->barang_jadi = $stockOpname->barang_jadi - $request->get('qty_pemakaian');
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
            $pemakaianBarangJadi = PemakaianBarangJadi::findOrFail($id);
            StockOpname::where('bulan', $pemakaianBarangJadi->bulan)->where('tahun', $pemakaianBarangJadi->tahun)
                ->update([
                    'barang_jadi' => \DB::raw('barang_jadi+' . $pemakaianBarangJadi->qty_pemakaian)
                ]);

            $pemakaianBarangJadi->delete();

            return redirect()->route('pemakaian-barang-jadi.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('pemakaian-barang-jadi.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('pemakaian-barang-jadi.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
