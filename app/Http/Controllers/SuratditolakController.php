<?php

namespace App\Http\Controllers;

use App\Models\ViewDataPengajuan;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;

class SuratditolakController extends Controller
{
    public function index(Request $request)
{
    $jumlahbaris = 10;
    $katakunci = $request->katakunci;

    if (strlen($katakunci)) {
        $datapengajuan = ViewDataPengajuan::where('status', 'Ditolak') // Tambahkan ini
            ->where(function($query) use ($katakunci) {
                $query->where('nik', 'like', "%$katakunci%")
                    ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                    ->orWhere('nama_surat', 'like', "%$katakunci%");
            })
            ->orderBy('id_pengajuan', 'desc')
            ->paginate($jumlahbaris);
    } else {
        $datapengajuan = ViewDataPengajuan::where('status', 'Ditolak') // Tambahkan ini juga
            ->orderBy('id_pengajuan', 'desc')
            ->paginate($jumlahbaris);
    }

    return view('admin.pengajuan_surat.suratditolak', compact('datapengajuan'));
}

    public function destroy($id_pengajuan)
{
    // Cari ke model asli
    $pengajuan = master_pengajuan::findOrFail($id_pengajuan);

    $pengajuan->delete();

    return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
}
}