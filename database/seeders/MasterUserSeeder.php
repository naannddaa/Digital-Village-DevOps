<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_akun')->insert([
            [
                'id' => 1,
                'nik' => '3508160711040002', // pastikan NIK ini ada di master_penduduks
                'no_hp' => '081234567890',
                'email' => 'akun1@example.com',
                'foto_profil' => 'default.png',
                'level' => 1,
                'password' => Hash::make('password123'), // disarankan pakai bcrypt
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'nik' => '3175091501010002',
                'no_hp' => '082345678901',
                'email' => 'akun2@example.com',
                'foto_profil' => 'default.png',
                'level' => 2,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
