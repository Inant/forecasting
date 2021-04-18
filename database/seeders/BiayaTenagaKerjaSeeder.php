<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\BiayaTenagaKerja;

class BiayaTenagaKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $biayaTenagaKerja = new BiayaTenagaKerja;
        $biayaTenagaKerja->jumlah_karyawan = 433;
        $biayaTenagaKerja->gaji_per_karyawan = 1955000;
        $biayaTenagaKerja->save();
    }
}
