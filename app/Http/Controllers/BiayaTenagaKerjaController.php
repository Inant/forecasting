<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\BiayaTenagaKerja;

class BiayaTenagaKerjaController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'Biaya Tenaga Kerja';
        $this->param['pageTitle'] = 'Biaya Tenaga Kerja';
        

        try {
            $biayaTenagaKerja = BiayaTenagaKerja::first();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi Kesalahan ' . $e->getMessage());
        }
                
        return \view('biaya-tenaga-kerja.list-biaya-tenaga-kerja', ['biayaTenagaKerja' => $biayaTenagaKerja], $this->param);
        
        // echo "<pre>";
        // print_r ($biayaTenagaKerja);
        // echo "</pre>";
        
    }

    public function edit($id)
    {
        try{
            $this->param['title'] = 'Edit Biaya Tenaga Kerja';
            $this->param['pageTitle'] = 'Edit Biaya Tenaga Kerja';
            $this->param['btn']['text'] = 'Lihat Data';
            $this->param['btn']['link'] = route('biaya-tenaga-kerja.index');
            $this->param['biayaTenagaKerja'] = BiayaTenagaKerja::first();
            return \view('biaya-tenaga-kerja.edit-biaya-tenaga-kerja', $this->param);
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
            'jumlah_karyawan' => 'required',
            'gaji_per_karyawan' => 'required',
            ]);

        try{
            $biayaTenagaKerja = BiayaTenagaKerja::find($id);

            $biayaTenagaKerja->jumlah_karyawan = $request->get('jumlah_karyawan');
            $biayaTenagaKerja->gaji_per_karyawan = $request->get('gaji_per_karyawan');
            $biayaTenagaKerja->save();

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
