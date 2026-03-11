<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterKartuKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('master_kartukeluargas')->insert([
            [
                'no_kk' => '3175091501230001',
                'alamat' => 'Jl. Melati No. 45',
                'rt' => '001',
                'rw' => '002',
                'desa' => 'Desa Sukamaju',
                'kecamatan' => 'Kecamatan Sukamakmur',
                'kode_pos' => 12345,
                'kabupaten' => 'Kabupaten Subur',
                'provinsi' => 'Jawa Barat',
                'tanggal_dibuat' => Carbon::now()->subYears(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230002',
                'alamat' => 'Jl. Mawar No. 12',
                'rt' => '002',
                'rw' => '003',
                'desa' => 'Desa Mekarsari',
                'kecamatan' => 'Kecamatan Harapan',
                'kode_pos' => 54321,
                'kabupaten' => 'Kabupaten Makmur',
                'provinsi' => 'Jawa Tengah',
                'tanggal_dibuat' => Carbon::now()->subMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
    
}
