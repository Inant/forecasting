<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\SetHargaLog;

class SetHargaLogController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'Set Harga Log';
        $this->param['pageTitle'] = 'Set Harga Log';
        

        try {
            $this->param['hargaLog'] = SetHargaLog::first();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('set-harga-log.edit-harga-log', $this->param);
        
        // echo "<pre>";
        // print_r ($hargaLog);
        // echo "</pre>";
        
    }

    public function edit($id)
    {
        try{
            $this->param['title'] = 'Edit Harga Log';
            $this->param['pageTitle'] = 'Edit Harga Log';
            $this->param['btn']['text'] = 'Lihat Data';
            $this->param['btn']['link'] = route('set-harga-log.index');
            $this->param['hargaLog'] = SetHargaLog::first();
            return \view('set-harga-log.edit-set-harga-log', $this->param);
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
        
        $validatedData = $request->validate([
            'harga_log' => 'required|numeric|gt:100000',
            ]);

        try{
            $hargaLog = SetHargaLog::find($id);

            $hargaLog->harga_log = $request->get('harga_log');
            $hargaLog->save();

            return redirect()->back()->withStatus('Data berhasil diperbarui.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }
}
