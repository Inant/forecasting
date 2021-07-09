<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\SetHargaLog;

class SetHargaLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hargaLog = new SetHargaLog;
        $hargaLog->harga_log = 1178022.22;
        $hargaLog->save();
    }
}
