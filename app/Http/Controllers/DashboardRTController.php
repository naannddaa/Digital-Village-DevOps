<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardRTController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nik = $user->nik ?? $user->username;

        // Ambil data RT berdasarkan NIK user login
        $rtData = DB::table('master_rt_rw')->where('nik', $nik)->first();

        if (!$rtData) {
            return view('rt.dashboard')->with('error', 'Data RT tidak ditemukan');
        }

        $rt = $rtData->rt;
        $rw = $rtData->rw;

        // ✅ Ambil semua no_kk dari master_kartukeluargas yang berada di RT dan RW yang sama
        $kkList = DB::table('master_kartukeluargas')
            ->where('rt', $rt)
            ->where('rw', $rw)
            ->pluck('no_kk');

        // Ambil semua NIK yang memiliki no_kk tersebut
        $niks = DB::table('master_penduduks')
            ->whereIn('no_kk', $kkList)
            ->pluck('nik');

        // Hitung jumlah penduduk
        $jumlahPenduduk = DB::table('master_penduduks')
            ->whereIn('nik', $niks)
            ->count();

        // Hitung jumlah KK unik
        $jumlahKK = DB::table('master_penduduks')
            ->whereIn('nik', $niks)
            ->distinct('no_kk')
            ->count('no_kk');

        // Hitung jumlah penduduk pria
        $jumlahLaki = DB::table('master_penduduks')
            ->whereIn('nik', $niks)
            ->whereRaw("LOWER(jenis_kelamin) REGEXP 'laki'")
            ->count();

        // Hitung jumlah penduduk wanita
        $jumlahWanita = DB::table('master_penduduks')
            ->whereIn('nik', $niks)
            ->whereRaw("LOWER(REPLACE(jenis_kelamin, ' ', '')) = 'perempuan'")
            ->count();

        // Hitung jumlah surat yang diajukan
        $jumlahSuratMasuk = DB::table('master_pengajuan')
            ->whereIn('nik', $niks)
            ->where('status', 'Diajukan')
            ->count();

        // Hitung jumlah surat yang ditolak
        $jumlahSuratDitolak = DB::table('master_pengajuan')
            ->whereIn('nik', $niks)
            ->where('status', 'Ditolak')
            ->count();

        // Kirim data ke view
        return view('rt.dashboard', compact(
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahLaki',
            'jumlahWanita',
            'jumlahSuratMasuk',
            'jumlahSuratDitolak',
            'rt',
            'rw',
        ));
    }
}