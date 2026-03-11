<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratSelesaiRWController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil data RW berdasarkan NIK user yang login
        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) {
            return back()->with('error', 'Data RT/RW tidak ditemukan.');
        }

        $query = DB::table('view_data_pengajuan')
            ->where('status', 'Disetujui RW')
            ->where('rw', $rtRw->rw);

        // Jika ada kata kunci pencarian
        if ($request->filled('katakunci')) {
            $katakunci = $request->katakunci;
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $pengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10);

        return view('rw.suratselesai.index', compact('pengajuan'));
    }

    public function show($id_pengajuan)
    {
        $user = Auth::user();

        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) {
            return redirect()->route('rw.suratselesai.index')->with('error', 'Data RT/RW tidak ditemukan.');
        }

        $data = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->where('rw', $rtRw->rw)
            ->where('status', 'Disetujui RW')
            ->first();

        if (!$data) {
            return redirect()->route('rw.suratselesai.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        return view('rw.suratselesai.show', compact('data'));
    }

    public function destroy($id_pengajuan)
    {
        $user = Auth::user();

        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) {
            return redirect()->route('rw.suratselesai.index')->with('error', 'Data RT/RW tidak ditemukan.');
        }

        // Pastikan surat yang akan dihapus milik RW dan berstatus "Disetujui RW"
        $pengajuan = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->where('rw', $rtRw->rw)
            ->where('status', 'Disetujui RW')
            ->first();

        if (!$pengajuan) {
            return redirect()->route('rw.suratselesai.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        // Hapus dari tabel utama
        DB::table('master_pengajuan')->where('id_pengajuan', $id_pengajuan)->delete();

        return redirect()->route('rw.suratselesai.index')->with('success', 'Data berhasil dihapus!');
    }
}