<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterPendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_penduduks')->insert([
            [
                'nik' => '3508160711040002',
                'nama_lengkap' => 'Ajiee',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-15',
                'agama' => 'Islam',
                'pendidikan' => 'S1',
                'pekerjaan' => 'Karyawan Swasta',
                'golongan_darah' => 'O',
                'status_perkawinan' => 'Menikah',
                'tanggal_perkawinan' => '2015-06-20',
                'status_keluarga' => 'Kepala Keluarga',
                'kewarganegaraan' => 'WNI',
                'no_paspor' => null,
                'no_kitap' => null,
                'nama_ayah' => 'Budi',
                'nama_ibu' => 'Siti',
                'no_kk' => '3175091501230001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3175091501010002',
                'nama_lengkap' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-07-10',
                'agama' => 'Islam',
                'pendidikan' => 'SMA',
                'pekerjaan' => 'Ibu Rumah Tangga',
                'golongan_darah' => 'A',
                'status_perkawinan' => 'Menikah',
                'tanggal_perkawinan' => '2016-03-18',
                'status_keluarga' => 'Istri',
                'kewarganegaraan' => 'WNI',
                'no_paspor' => null,
                'no_kitap' => null,
                'nama_ayah' => 'Ahmad',
                'nama_ibu' => 'Rina',
                'no_kk' => '3175091501230001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
