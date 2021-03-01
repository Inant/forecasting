<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\HasilProduksi;
use \App\Models\BahanBaku;

class HasilProduksiController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Hasil Produksi';
        $this->param['pageTitle'] = 'Hasil Produksi';
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
        $this->param['year'] = HasilProduksi::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('hasil-produksi.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $hasilProduksi = HasilProduksi::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $hasilProduksi = HasilProduksi::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('hasil-produksi.list-hasil-produksi', ['hasilProduksi' => $hasilProduksi], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Hasil Produksi';
        $this->param['pageTitle'] = 'Hasil Produksi';
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
        $this->param['btn']['link'] = route('hasil-produksi.index');

        return \view('hasil-produksi.tambah-hasil-produksi', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_hasil_produksi' => 'required|numeric|gt:0',
        ]);
        try{
            $cekMonth = HasilProduksi::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }

            // get pemakaian by periode produksi
            $pemakaianBahanBaku = BahanBaku::select('qty_bahan_baku')->where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get()[0];
    
            $newHasilProduksi = new HasilProduksi;
    
            $newHasilProduksi->bulan = $request->get('bulan');
            $newHasilProduksi->tahun = $request->get('tahun');
            $newHasilProduksi->qty_hasil_produksi = $request->get('qty_hasil_produksi');
            $newHasilProduksi->rendemen = $request->get('qty_hasil_produksi') / $pemakaianBahanBaku->qty_bahan_baku * 100;
    
            $newHasilProduksi->save();
    
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
            $this->param['title'] = 'Edit Purchase Order';
            $this->param['pageTitle'] = 'Purchase Order';
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
            $this->param['btn']['link'] = route('hasil-produksi.index');
            $this->param['hasilProduksi'] = HasilProduksi::find($id);

            return \view('hasil-produksi.edit-hasil-produksi', $this->param);
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
        $hasilProduksi = HasilProduksi::find($id);

        $cekMonth = HasilProduksi::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $hasilProduksi->bulan && $cekMonth[0]->tahun == $hasilProduksi->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $hasilProduksi->bulan && $cekMonth[0]->tahun != $hasilProduksi->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $hasilProduksi->bulan && $cekMonth[0]->tahun == $hasilProduksi->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $hasilProduksi->bulan && $cekMonth[0]->tahun != $hasilProduksi->tahun;

        if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
            return redirect()->back()->withError('Bulan dan tahun tidak valid.');
            // echo "fail";
        }

        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_hasil_produksi' => 'required|numeric|gt:0',
        ]);
        try{

            // get pemakaian by periode produksi
            $pemakaianBahanBaku = BahanBaku::select('qty_bahan_baku')->where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get()[0];

            $hasilProduksi->bulan = $request->get('bulan');
            $hasilProduksi->tahun = $request->get('tahun');
            $hasilProduksi->qty_hasil_produksi = $request->get('qty_hasil_produksi');
            $hasilProduksi->rendemen = $request->get('qty_hasil_produksi') / $pemakaianBahanBaku->qty_bahan_baku * 100;
            
            $hasilProduksi->save();

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
            $hasilProduksi = HasilProduksi::findOrFail($id);

            $hasilProduksi->delete();

            return redirect()->route('hasil-produksi.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('hasil-produksi.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('hasil-produksi.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
