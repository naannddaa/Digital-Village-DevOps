<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratSelesaiRTController extends Controller
{
   public function index(Request $request)
{
    $user = Auth::user();
    $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
    if (!$rtRw) {
        return back()->with('error', 'Data RT/RW tidak ditemukan.');
    }

    $query = DB::table('view_data_pengajuan')
        ->where('status', 'Disetujui RT')
        ->where('rt', $rtRw->rt)
        ->where('rw', $rtRw->rw);

    if ($request->filled('katakunci')) {
        $query->where(function($q) use ($request) {
            $q->where('nik', 'like', '%'.$request->katakunci.'%')
              ->orWhere('nama_lengkap', 'like', '%'.$request->katakunci.'%')
              ->orWhere('nama_surat', 'like', '%'.$request->katakunci.'%');
        });
    }

    $pengajuan = $query->get();

    return view('rt.suratselesai.index', compact('pengajuan'));
}

    public function show($id_pengajuan)
    {
        $user = Auth::user();

        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) {
            return redirect()->route('suratselesai.index')->with('error', 'Data RT/RW tidak ditemukan.');
        }

        // Ambil data pengajuan berdasar ID dan wilayah RT & RW user
        $data = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->where('rt', $rtRw->rt)
            ->where('rw', $rtRw->rw)
            ->where('status', 'Disetujui RT')
            ->first();

        if (!$data) {
            return redirect()->route('suratselesai.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        return view('rt.suratselesai.show', compact('data'));
    }

    public function destroy($id_pengajuan)
    {
        $user = Auth::user();

        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) {
            return redirect()->route('suratselesai.index')->with('error', 'Data RT/RW tidak ditemukan.');
        }

        // Pastikan data pengajuan sesuai RT & RW user login
        $pengajuan = DB::table('master_pengajuan')
            ->join('view_data_pengajuan', 'master_pengajuan.id_pengajuan', '=', 'view_data_pengajuan.id_pengajuan')
            ->where('master_pengajuan.id_pengajuan', $id_pengajuan)
            ->where('view_data_pengajuan.rt', $rtRw->rt)
            ->where('view_data_pengajuan.rw', $rtRw->rw)
            ->first();

        if (!$pengajuan) {
            return redirect()->route('suratselesai.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        // Hapus data pengajuan
        DB::table('master_pengajuan')->where('id_pengajuan', $id_pengajuan)->delete();

        return redirect()->route('suratselesai.index')->with('success', 'Data berhasil dihapus!');
    }
}