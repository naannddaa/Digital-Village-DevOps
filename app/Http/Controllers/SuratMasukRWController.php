<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratMasukRWController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil RW dari user yang login
        $rwData = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rwData) {
            return back()->with('error', 'Data RW tidak ditemukan.');
        }

        $rw = $rwData->rw;

        // Ambil semua pengajuan status "Diajukan" dari warga RW tersebut
        $query = DB::table('view_data_pengajuan')
            ->where('status', 'Disetujui RT')
            ->where('rw', $rw);

        if ($request->filled('katakunci')) {
            $query->where(function ($q) use ($request) {
                $q->where('nik', 'like', '%' . $request->katakunci . '%')
                  ->orWhere('nama_lengkap', 'like', '%' . $request->katakunci . '%')
                  ->orWhere('nama_surat', 'like', '%' . $request->katakunci . '%');
            });
        }

        $suratMasuk = $query->orderBy('id_pengajuan', 'desc')->paginate(10);

        return view('rw.suratmasuk.index', compact('suratMasuk'));
    }

    public function show($id_pengajuan)
    {
        $user = Auth::user();
        $rwData = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rwData) return back()->with('error', 'Data RW tidak ditemukan.');

        $data = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->where('rw', $rwData->rw)
            ->where('status', 'Disetujui RT')
            ->first();

        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        return view('rw.suratmasuk.view', compact('data'));
    }

public function setujui($id_pengajuan)
{
    DB::table('master_pengajuan')
        ->where('id_pengajuan', $id_pengajuan)
        ->update(['status' => 'Disetujui RW']);

    return redirect()->route('rw.suratmasuk.index')->with('success', 'Pengajuan berhasil disetujui RW.');
}


    public function destroy($id_pengajuan)
    {
        $user = Auth::user();
        $rwData = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rwData) return back()->with('error', 'Data RW tidak ditemukan.');

        // Cek apakah pengajuan milik RW ini dan masih status "Diajukan"
        $cek = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->where('rw', $rwData->rw)
            ->where('status', 'Disetujui RW')
            ->first();

        if (!$cek) {
            return back()->with('error', 'Pengajuan tidak ditemukan atau bukan wilayah Anda.');
        }

        DB::table('master_pengajuan')->where('id_pengajuan', $id_pengajuan)->delete();

        return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
    }
}