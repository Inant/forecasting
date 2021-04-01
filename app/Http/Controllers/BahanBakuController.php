<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
// use App\Models\StockOpname;

class BahanBakuController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Pemakaian Bahan Baku';
        $this->param['pageTitle'] = 'Pemakaian Bahan Baku';
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
        $this->param['year'] = BahanBaku::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('bahan-baku.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $bahanBaku = BahanBaku::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $bahanBaku = BahanBaku::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('bahan-baku.list-bahan-baku', ['bahanBaku' => $bahanBaku], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Pemakaian Bahan Baku';
        $this->param['pageTitle'] = 'Pemakaian Bahan Baku';
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
        $this->param['btn']['link'] = route('bahan-baku.index');

        return \view('bahan-baku.tambah-bahan-baku', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_bahan_baku' => 'required|numeric|gt:0',
            'nominal_bahan_baku' => 'required|numeric|gt:0',
        ]);
        try{
            $cekMonth = BahanBaku::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }
    
            $newBahanBaku = new BahanBaku;
    
            $newBahanBaku->bulan = $request->get('bulan');
            $newBahanBaku->tahun = $request->get('tahun');
            $newBahanBaku->qty_bahan_baku = $request->get('qty_bahan_baku');
            $newBahanBaku->nominal_bahan_baku = $request->get('nominal_bahan_baku');
    
            $newBahanBaku->save();

            // $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            // if ($cekStockOpname > 0) {
            //     StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
            //     ->update([
            //         'bahan_baku' => \DB::raw('bahan_baku-' . $request->get('qty_bahan_baku'))
            //     ]);
            // }
            // else{
            //     $stockOpname = new StockOpname;
            //     $stockOpname->bulan = $request->get('bulan');
            //     $stockOpname->tahun = $request->get('tahun');
            //     $stockOpname->bahan_baku = $stockOpname->bahan_baku - $request->get('qty_bahan_baku');
            //     $stockOpname->save();
            // }
    
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
            $this->param['btn']['link'] = route('bahan-baku.index');
            $this->param['bahanBaku'] = BahanBaku::find($id);

            return \view('bahan-baku.edit-bahan-baku', $this->param);
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
        $bahanBaku = BahanBaku::find($id);

        $cekMonth = BahanBaku::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $bahanBaku->bulan && $cekMonth[0]->tahun == $bahanBaku->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $bahanBaku->bulan && $cekMonth[0]->tahun != $bahanBaku->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $bahanBaku->bulan && $cekMonth[0]->tahun == $bahanBaku->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $bahanBaku->bulan && $cekMonth[0]->tahun != $bahanBaku->tahun;

        if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
            return redirect()->back()->withError('Bulan dan tahun tidak valid.');
            // echo "fail";
        }

        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_bahan_baku' => 'required|numeric|gt:0',
            'nominal_bahan_baku' => 'required|numeric|gt:0',
        ]);
        try{
            // balikan stock opname terlebih dahulu
            // StockOpname::where('bulan', $bahanBaku->bulan)->where('tahun', $bahanBaku->tahun)
            //     ->update([
            //         'bahan_baku' => \DB::raw('bahan_baku+' . $bahanBaku->qty_bahan_baku)
            //     ]);

            $bahanBaku->bulan = $request->get('bulan');
            $bahanBaku->tahun = $request->get('tahun');
            $bahanBaku->qty_bahan_baku = $request->get('qty_bahan_baku');
            $bahanBaku->nominal_bahan_baku = $request->get('nominal_bahan_baku');
            $bahanBaku->save();

            // $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            // if ($cekStockOpname > 0) {
            //     StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
            //     ->update([
            //         'bahan_baku' => \DB::raw('bahan_baku-' . $request->get('qty_bahan_baku'))
            //     ]);
            // }
            // else{
            //     StockOpname::create([
            //         'bulan' => $request->get('bulan'),
            //         'tahun' => $request->get('tahun'),
            //         'bahan_baku' => \DB::raw('bahan_baku-' . $request->get('qty_bahan_baku')),
            //         'created_at' => date('Y-m-d H:i:s')
            //     ]);
            // }

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
            $bahanBaku = BahanBaku::findOrFail($id);

            // StockOpname::where('bulan', $bahanBaku->bulan)->where('tahun', $bahanBaku->tahun)
            //     ->update([
            //         'bahan_baku' => \DB::raw('bahan_baku+' . $bahanBaku->qty_bahan_baku)
            //     ]);

            $bahanBaku->delete();

            return redirect()->route('bahan-baku.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('bahan-baku.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('bahan-baku.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
