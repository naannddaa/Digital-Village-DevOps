<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\master_kartukeluarga;
use App\Models\master_penduduk;
use App\Models\master_akunrtrw;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah KK
        $jumlahKK = master_kartukeluarga::count();

        // Hitung jumlah penduduk
        $jumlahPenduduk = master_penduduk::count();

        // Hitung jumlah laki-laki
        $jumlahLaki = master_penduduk::where('jenis_kelamin', 'Laki-laki')->count();

        // Hitung jumlah perempuan
        $jumlahPerempuan = master_penduduk::where('jenis_kelamin', 'Perempuan')->count();

        // Hitung Jumlah RT
        $jumlahRT = master_akunrtrw::whereNotNull('rt')->count();

        // Hitung Jumlah RW
        $jumlahRW = master_akunrtrw::whereNull('rt')->count();

        // Statistik pria & wanita per bulan (6 bulan terakhir)
        $statistikPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i)->format('Y-m');

            $pria = master_penduduk::where('jenis_kelamin', 'Laki-laki')
                ->whereYear('created_at', Carbon::parse($bulan)->year)
                ->whereMonth('created_at', Carbon::parse($bulan)->month)
                ->count();

            $wanita = master_penduduk::where('jenis_kelamin', 'Perempuan')
                ->whereYear('created_at', Carbon::parse($bulan)->year)
                ->whereMonth('created_at', Carbon::parse($bulan)->month)
                ->count();

            $statistikPerBulan[] = [
                'bulan' => Carbon::parse($bulan)->translatedFormat('F Y'),
                'pria' => $pria,
                'wanita' => $wanita,
            ];
        }

        return view('admin.dashboard.index', compact(
            'jumlahKK',
            'jumlahPenduduk',
            'jumlahLaki',
            'jumlahPerempuan',
            'jumlahRT',
            'jumlahRW',
            'statistikPerBulan'
        ));
    }
}