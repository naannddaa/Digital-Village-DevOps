<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert satu baris kosong untuk trigger auto-increment di master_landingpage
        DB::table('master_landingpage')->insert([
            // Tidak perlu field karena misalnya hanya butuh trigger ID otomatis
        ]);

        // Panggil seeder lain
        $this->call([
            MasterKartuKeluargaSeeder::class,
            MasterPendudukSeeder::class,
            MasterUserSeeder::class,
        ]);
    }
}
