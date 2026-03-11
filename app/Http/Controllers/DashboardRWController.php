<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardRWController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nik = $user->nik ?? $user->username;

        // Ambil data RW berdasarkan NIK user login
        $rwData = DB::table('master_rt_rw')->where('nik', $nik)->first();

        if (!$rwData) {
            return view('rw.dashboard')->with('error', 'Data RW tidak ditemukan');
        }

        $rw = $rwData->rw;

        // ✅ Ambil semua no_kk dari RW
        $kkList = DB::table('master_kartukeluargas')
            ->where('rw', $rw)
            ->pluck('no_kk');

        // ✅ Ambil semua NIK dari KK tersebut
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
            ->where('status', 'Disetujui RT')
            ->count();

        // Hitung jumlah surat yang ditolak
        $jumlahSuratDitolak = DB::table('master_pengajuan')
            ->whereIn('nik', $niks)
            ->where('status', 'Disetujui RW')
            ->count();

        // Kirim data ke view
        return view('rw.dashboard', compact(
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahLaki',
            'jumlahWanita',
            'jumlahSuratMasuk',
            'jumlahSuratDitolak',
            'rw'
        ));
    }
}