<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administator = new User;
        $administator->nama = 'Administrator';
        $administator->email = 'administrator@mail.com';
        $administator->password = Hash::make('administrator');
        $administator->save();
    }
}
