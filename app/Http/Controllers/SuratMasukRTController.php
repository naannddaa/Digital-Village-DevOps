<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratMasukRTController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) {
            return back()->with('error', 'Data RT/RW tidak ditemukan.');
        }

        $query = DB::table('view_data_pengajuan')
            ->where('status', 'Diajukan')
            ->where('rt', $rtRw->rt)
            ->where('rw', $rtRw->rw);

        if ($request->filled('katakunci')) {
            $query->where(function($q) use ($request) {
                $q->where('nik', 'like', '%' . $request->katakunci . '%')
                  ->orWhere('nama_lengkap', 'like', '%' . $request->katakunci . '%')
                  ->orWhere('nama_surat', 'like', '%' . $request->katakunci . '%');
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10);

        return view('rt.suratmasuk.index', compact('datapengajuan'));
    }

 public function setujui($id_pengajuan)
{
    $user = Auth::user();
    $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
    if (!$rtRw) return back()->with('error', 'Data RT/RW tidak ditemukan.');

    $pengajuan = DB::table('view_data_pengajuan')
        ->where('id_pengajuan', $id_pengajuan)
        ->where('rt', $rtRw->rt)
        ->where('rw', $rtRw->rw)
        ->where('status', 'Diajukan') // ✅ hanya pengajuan yg masih diajukan
        ->first();

    if (!$pengajuan) return back()->with('error', 'Pengajuan tidak ditemukan atau bukan wilayah Anda.');

    DB::table('master_pengajuan')
        ->where('id_pengajuan', $id_pengajuan)
        ->update(['status' => 'Disetujui RT']);

    return back()->with('success', 'Pengajuan telah disetujui.');
}

   public function tolak(Request $request, $id_pengajuan)
{
    $request->validate([
        'keterangan_ditolak' => 'required|string|max:100',
    ]);

    $user = Auth::user();
    $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
    if (!$rtRw) return back()->with('error', 'Data RT/RW tidak ditemukan.');

    $pengajuan = DB::table('view_data_pengajuan')
        ->where('id_pengajuan', $id_pengajuan)
        ->where('rt', $rtRw->rt)
        ->where('rw', $rtRw->rw)
        ->where('status', 'Diajukan')
        ->first();

    if (!$pengajuan) return back()->with('error', 'Pengajuan tidak ditemukan atau bukan wilayah Anda.');

    DB::table('master_pengajuan')
        ->where('id_pengajuan', $id_pengajuan)
        ->update([
            'status' => 'Ditolak',
            'keterangan_ditolak' => $request->keterangan_ditolak,
        ]);

    return back()->with('success', 'Pengajuan berhasil ditolak.');
}


    public function destroy($id_pengajuan)
    {
        $user = Auth::user();
        $rtRw = DB::table('master_rt_rw')->where('nik', $user->nik)->first();
        if (!$rtRw) return back()->with('error', 'Data RT/RW tidak ditemukan.');

        $pengajuan = DB::table('view_data_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->where('rt', $rtRw->rt)
            ->where('rw', $rtRw->rw)
            ->first();

        if (!$pengajuan) return back()->with('error', 'Pengajuan tidak ditemukan.');

        DB::table('master_pengajuan')
            ->where('id_pengajuan', $id_pengajuan)
            ->delete();

        return back()->with('success', 'Pengajuan berhasil dihapus.');
    }
}