<?php

namespace App\Http\Controllers;

use App\Models\PembelianBahanBaku;
use App\Models\StockOpname;
use Illuminate\Http\Request;

class PembelianBahanBakuController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Pembelian Bahan Baku';
        $this->param['pageTitle'] = 'Pembelian Bahan Baku';
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
        $this->param['year'] = PembelianBahanBaku::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('pembelian-bahan-baku.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $pembelianBahanBaku = PembelianBahanBaku::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $pembelianBahanBaku = PembelianBahanBaku::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('pembelian-bahan-baku.list-pembelian-bahan-baku', ['pembelianBahanBaku' => $pembelianBahanBaku], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Pembelian Bahan Baku';
        $this->param['pageTitle'] = 'Pembelian Bahan Baku';
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
        $this->param['btn']['link'] = route('pembelian-bahan-baku.index');

        return \view('pembelian-bahan-baku.tambah-pembelian-bahan-baku', $this->param);
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
            $cekMonth = PembelianBahanBaku::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }
    
            $newPembelianBahanBaku = new PembelianBahanBaku;
    
            $newPembelianBahanBaku->bulan = $request->get('bulan');
            $newPembelianBahanBaku->tahun = $request->get('tahun');
            $newPembelianBahanBaku->qty_pembelian = $request->get('qty_pembelian');
            $newPembelianBahanBaku->nominal_pembelian = $request->get('nominal_pembelian');

            $newPembelianBahanBaku->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'bahan_baku' => \DB::raw('bahan_baku+' . $request->get('qty_pembelian'))
                ]);
            }
            else{
                $stockOpname = new StockOpname;
                $stockOpname->bulan = $request->get('bulan');
                $stockOpname->tahun = $request->get('tahun');
                $stockOpname->bahan_baku = $request->get('qty_pembelian');
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
            $this->param['btn']['link'] = route('pembelian-bahan-baku.index');
            $this->param['pembelianBahanBaku'] = PembelianBahanBaku::find($id);

            return \view('pembelian-bahan-baku.edit-pembelian-bahan-baku', $this->param);
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
        $pembelianBahanBaku = PembelianBahanBaku::find($id);

        $cekMonth = PembelianBahanBaku::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $pembelianBahanBaku->bulan && $cekMonth[0]->tahun == $pembelianBahanBaku->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $pembelianBahanBaku->bulan && $cekMonth[0]->tahun != $pembelianBahanBaku->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $pembelianBahanBaku->bulan && $cekMonth[0]->tahun == $pembelianBahanBaku->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $pembelianBahanBaku->bulan && $cekMonth[0]->tahun != $pembelianBahanBaku->tahun;

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
            // balikan stock opname terlebih dahulu
            StockOpname::where('bulan', $pembelianBahanBaku->bulan)->where('tahun', $pembelianBahanBaku->tahun)
                ->update([
                    'bahan_baku' => \DB::raw('bahan_baku-' . $pembelianBahanBaku->qty_pembelian)
                ]);

            $pembelianBahanBaku->bulan = $request->get('bulan');
            $pembelianBahanBaku->tahun = $request->get('tahun');
            $pembelianBahanBaku->qty_pembelian = $request->get('qty_pembelian');
            $pembelianBahanBaku->nominal_pembelian = $request->get('nominal_pembelian');
            $pembelianBahanBaku->save();

            $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($cekStockOpname > 0) {
                StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
                ->update([
                    'bahan_baku' => \DB::raw('bahan_baku+' . $request->get('qty_pembelian'))
                ]);
            }
            else{
                StockOpname::create([
                    'bulan' => $request->get('bulan'),
                    'tahun' => $request->get('tahun'),
                    'bahan_baku' => $request->get('qty_pembelian'),
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
            $pembelianBahanBaku = PembelianBahanBaku::findOrFail($id);

            StockOpname::where('bulan', $pembelianBahanBaku->bulan)->where('tahun', $pembelianBahanBaku->tahun)
                ->update([
                    'bahan_baku' => \DB::raw('bahan_baku-' . $pembelianBahanBaku->qty_pembelian)
                ]);

            $pembelianBahanBaku->delete();

            return redirect()->route('pembelian-bahan-baku.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('pembelian-bahan-baku.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('pembelian-bahan-baku.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
