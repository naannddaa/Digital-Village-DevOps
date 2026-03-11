<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratDitolakRTController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();

        if (!$rtRw) {
            return back()->with('error', 'Data RT/RW tidak ditemukan.');
        }

        $query = DB::table('view_data_pengajuan')
            ->where('status', 'Ditolak')
            ->where('rt', $rtRw->rt)
            ->where('rw', $rtRw->rw);

        if ($request->filled('katakunci')) {
            $query->where(function ($q) use ($request) {
                $q->where('nik', 'like', '%'.$request->katakunci.'%')
                  ->orWhere('nama_lengkap', 'like', '%'.$request->katakunci.'%')
                  ->orWhere('nama_surat', 'like', '%'.$request->katakunci.'%');
            });
        }

        $pengajuan = $query->get();

        return view('RT.suratditolak.index', compact('pengajuan'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();

        if (!$rtRw) {
            return redirect()->route('rt.suratditolak.index')->with('error', 'Data RT/RW tidak ditemukan.');
        }

        $data = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id)
            ->where('rt', $rtRw->rt)
            ->where('rw', $rtRw->rw)
            ->where('status', 'Ditolak')
            ->first();

        if (!$data) {
            return redirect()->route('rt.suratditolak.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        return view('RT.suratditolak.show', compact('data'));
    }

    public function alasanPenolakan(Request $request)
    {
        $request->validate([
            'id_pengajuan' => 'required|integer',
            'alasan' => 'required|string',
        ]);

        $user = Auth::user();
        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();

        if (!$rtRw) {
            return redirect()->route('rt.suratditolak.index')->with('error', 'Data RT/RW tidak ditemukan.');
        }

        // Pastikan pengajuan sesuai wilayah RT/RW
        $pengajuan = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $request->id_pengajuan)
            ->where('rt', $rtRw->rt)
            ->where('rw', $rtRw->rw)
            ->where('status', 'Ditolak')
            ->first();

        if (!$pengajuan) {
            return redirect()->route('rt.suratditolak.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
        }

        DB::table('master_pengajuan')
            ->where('id_pengajuan', $request->id_pengajuan)
            ->update(['alasan_penolakan' => $request->alasan]);

        return redirect()->route('rt.suratditolak.index')->with('success', 'Alasan penolakan berhasil diperbarui.');
    }
    public function destroy($id)
{
    $user = Auth::user();
    $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();

    if (!$rtRw) {
        return redirect()->route('rt.suratditolak.index')->with('error', 'Data RT/RW tidak ditemukan.');
    }

    $pengajuan = DB::table('view_data_pengajuan')
        ->where('id_pengajuan', $id)
        ->where('rt', $rtRw->rt)
        ->where('rw', $rtRw->rw)
        ->where('status', 'Ditolak')
        ->first();

    if (!$pengajuan) {
        return redirect()->route('rt.suratditolak.index')->with('error', 'Data tidak ditemukan atau bukan wilayah Anda.');
    }

    // Hapus dari master_pengajuan (bukan dari view)
    DB::table('master_pengajuan')->where('id_pengajuan', $id)->delete();

    return redirect()->route('rt.suratditolak.index')->with('success', 'Data pengajuan berhasil dihapus.');
}

}