<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use app\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void 
     */
    public function run()
    {
        // UserSeeder Admin
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 'admin',
        ]);

        // UserSeeder Gudang
        DB::table('users')->insert([
            'name' => 'gudang',
            'email' => 'gudang@gmail.com',
            'password' => Hash::make('gudang'),
            'level' => 'gudang',
        ]);

        // // UserSeeder Kasir
        DB::table('users')->insert([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir'),
            'level' => 'kasir',
        ]);
    }
}