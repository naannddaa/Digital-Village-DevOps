<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_data_pengajuan AS
            SELECT 
                p.nik AS nik,
                p.nama_lengkap AS nama_lengkap,
                p.jenis_kelamin AS jenis_kelamin,
                CONCAT(p.tempat_lahir, ', ', DATE_FORMAT(p.tanggal_lahir, '%d/%m/%Y')) AS tempat_tanggal_lahir,
                CONCAT(p.kewarganegaraan, ' / ', p.agama) AS warga_agama,
                k.rt AS rt,
                k.rw AS rw,
                pg.id_pengajuan AS id_pengajuan,
                pg.id_surat AS id_surat,
                s.nama_surat AS nama_surat,
                pg.keperluan AS keperluan,
                DATE_FORMAT(pg.tanggal_diajukan, '%d/%m/%Y') AS tanggal_diajukan,
                pg.status AS status,
                pg.keterangan_ditolak AS keterangan_ditolak,
                pg.foto1 AS foto1,
                pg.foto2 AS foto2,
                pg.foto3 AS foto3,
                pg.foto4 AS foto4,
                pg.foto5 AS foto5,
                pg.foto6 AS foto6,
                pg.foto7 AS foto7,
                pg.foto8 AS foto8
            FROM 
                percobaan.master_penduduks p
            JOIN 
                percobaan.master_kartukeluargas k ON p.no_kk = k.no_kk
            JOIN 
                percobaan.master_pengajuan pg ON p.nik = pg.nik
            JOIN 
                percobaan.master_surat s ON pg.id_surat = s.id_surat
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS my_view_name");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
};
