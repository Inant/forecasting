<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\HasilProduksi;
use Illuminate\Http\Request;
// use \App\Models\StockOpname;

class PurchaseOrderController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List Purchase Order';
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
        $this->param['year'] = PurchaseOrder::select('tahun')->orderBy('tahun', 'DESC')->groupBy('tahun')->get();
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('purchase-order.create');

        try {
            $month = $request->get('month');
            $year = $request->get('year');
            if ($month) {
                $purchaseOrder = PurchaseOrder::where('bulan', '=', $month)->where('tahun', '=', $year)->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
            else{
                $purchaseOrder = PurchaseOrder::orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('purchase-order.list-purchase-order', ['purchaseOrder' => $purchaseOrder], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah Purchase Order';
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
        $this->param['btn']['link'] = route('purchase-order.index');

        return \view('purchase-order.tambah-purchase-order', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_po' => 'required|numeric|gt:0',
            'nominal_po' => 'required|numeric|gt:0',
        ],
        [
            'min' => 'Kurang dari minimum'
        ] );
        try{
            $cekMonth = PurchaseOrder::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
            
            if (count($cekMonth) > 0) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
                echo "fail";
            }

            if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
                return redirect()->back()->withError('Bulan dan tahun tidak valid.');
                // echo "fail";
            }

            // get hasil produksi by periode produksi
            $hasilProduksi = HasilProduksi::select('qty_hasil_produksi')->where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            if ($hasilProduksi == 0) {
                return back()->withError('Produksi Bahan Jadi Untuk Periode Tersebut Belum Diinput.');
            }

            $newPurchaseOrder = new PurchaseOrder;
    
            $newPurchaseOrder->bulan = $request->get('bulan');
            $newPurchaseOrder->tahun = $request->get('tahun');
            $newPurchaseOrder->qty_po = $request->get('qty_po');
            $newPurchaseOrder->nominal_po = $request->get('nominal_po');
            // $newPurchaseOrder->stock_opname = $stockOpname->stock_opname + $hasilProduksi->qty_hasil_produksi - $request->get('qty_po');
    
            $newPurchaseOrder->save();

            // $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            // if ($cekStockOpname > 0) {
            //     StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
            //     ->update([
            //         'barang_jadi' => \DB::raw('barang_jadi-' . $request->get('qty_po'))
            //     ]);
            // }
            // else{
            //     $stockOpname = new StockOpname;
            //     $stockOpname->bulan = $request->get('bulan');
            //     $stockOpname->tahun = $request->get('tahun');
            //     $stockOpname->barang_jadi = $stockOpname->barang_jadi - $request->get('qty_po');
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
            $this->param['btn']['link'] = route('purchase-order.index');
            $this->param['purchaseOrder'] = PurchaseOrder::find($id);

            return \view('purchase-order.edit-purchase-order', $this->param);
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
        $purchaseOrder = PurchaseOrder::find($id);

        $cekMonth = PurchaseOrder::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get();
        
        if (count($cekMonth) > 0) {
            if ($cekMonth[0]->bulan != $purchaseOrder->bulan && $cekMonth[0]->tahun == $purchaseOrder->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            elseif ($cekMonth[0]->bulan == $purchaseOrder->bulan && $cekMonth[0]->tahun != $purchaseOrder->tahun) {
                return redirect()->back()->withError('Data untuk bulan '.$request->get('bulan'). ' tahun ' . $request->get('tahun') . ' telah diinput.');
            }
            
            // echo "<pre>";
            // print_r ($cekMonth[0]->tahun);
            // echo "</pre>";
            // echo $cekMonth[0]->bulan != $purchaseOrder->bulan && $cekMonth[0]->tahun == $purchaseOrder->tahun;
            
        }
        // echo $cekMonth[0]->bulan == $purchaseOrder->bulan && $cekMonth[0]->tahun != $purchaseOrder->tahun;

        if ($request->get('bulan') > date('m') && $request->get('tahun') >= date('Y')) {
            return redirect()->back()->withError('Bulan dan tahun tidak valid.');
            // echo "fail";
        }

        
        $validatedData = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'qty_po' => 'required|numeric|gt:0',
            'nominal_po' => 'required|numeric|gt:0',
        ]);
        try{
            // StockOpname::where('bulan', $purchaseOrder->bulan)->where('tahun', $purchaseOrder->tahun)
            //     ->update([
            //         'barang_jadi' => \DB::raw('barang_jadi+' . $purchaseOrder->qty_po)
            //     ]);
            // get hasil produksi by periode produksi
            $hasilProduksi = HasilProduksi::select('qty_hasil_produksi')->where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->get()[0];

            if ($request->get('bulan') == '01') {
                $bulanSebelumnya = '12';
                $tahunSebelumnya = $request->get('tahun') - 1;
            }
            else{
                $bulanSebelumnya = $request->get('bulan') - 1;
                $tahunSebelumnya = $request->get('tahun');
            }

            // get stock opname di periode sebelumnya
            // $stockOpname = PurchaseOrder::select('stock_opname')->where('bulan', $bulanSebelumnya)->where('tahun', $tahunSebelumnya)->get()[0];

            $purchaseOrder->bulan = $request->get('bulan');
            $purchaseOrder->tahun = $request->get('tahun');
            $purchaseOrder->qty_po = $request->get('qty_po');
            $purchaseOrder->nominal_po = $request->get('nominal_po');
            // $purchaseOrder->stock_opname = $stockOpname->stock_opname + $hasilProduksi->qty_hasil_produksi - $request->get('qty_po');
            $purchaseOrder->save();

            // $cekStockOpname = StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))->count();

            // if ($cekStockOpname > 0) {
            //     StockOpname::where('bulan', $request->get('bulan'))->where('tahun', $request->get('tahun'))
            //     ->update([
            //         'barang_jadi' => \DB::raw('barang_jadi-' . $request->get('qty_po'))
            //     ]);
            // }
            // else{
            //     $stockOpname = new StockOpname;
            //     $stockOpname->bulan = $request->get('bulan');
            //     $stockOpname->tahun = $request->get('tahun');
            //     $stockOpname->barang_jadi = $stockOpname->barang_jadi - $request->get('qty_po');
            //     $stockOpname->save();
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
            $purchaseOrder = PurchaseOrder::findOrFail($id);

            // StockOpname::where('bulan', $purchaseOrder->bulan)->where('tahun', $purchaseOrder->tahun)
            //     ->update([
            //         'barang_jadi' => \DB::raw('barang_jadi+' . $purchaseOrder->qty_pemakaian)
            //     ]);

            $purchaseOrder->delete();   

            return redirect()->route('purchase-order.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('purchase-order.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('purchase-order.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
