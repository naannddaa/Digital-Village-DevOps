<?php

namespace App\Http\Controllers;

use App\Models\ViewDataPengajuan;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;

class SuratmasukController extends Controller
{
   public function index(Request $request)
{
    $jumlahbaris = 10;
    $katakunci = $request->katakunci;

    if (strlen($katakunci)) {
        $datapengajuan = ViewDataPengajuan::where('status', 'Disetujui RW') 
            ->where(function($query) use ($katakunci) {
                $query->where('nik', 'like', "%$katakunci%")
                    ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                    ->orWhere('nama_surat', 'like', "%$katakunci%");
            })
            ->orderBy('id_pengajuan', 'desc')
            ->paginate($jumlahbaris);
    } else {
        $datapengajuan = ViewDataPengajuan::where('status', 'Disetujui RW') 
            ->orderBy('id_pengajuan', 'desc')
            ->paginate($jumlahbaris);
    }

    return view('admin.pengajuan_surat.suratmasuk', compact('datapengajuan'));
}

   public function setuju(Request $request, $id_pengajuan)
{
    $pengajuan = ViewDataPengajuan::findOrFail($id_pengajuan);
    $pengajuan->status = 'Selesai';
    $pengajuan->save();

    return response()->json([
        'success' => true,
        'message' => 'Pengajuan berhasil disetujui.'
    ]);
}



    public function tolak(Request $request, $id_pengajuan)    {
        
        $request->validate([
            'keterangan_ditolak' => 'nullable|string|max:50',
        ]);

        $pengajuan = ViewDataPengajuan::findOrFail($id_pengajuan);

        $pengajuan->status = 'Ditolak'; // <-- langsung set di sini

        $pengajuan->keterangan_ditolak = $request->keterangan_ditolak;

        $pengajuan->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function destroy($id_pengajuan)
{
    // Cari ke model asli
    $pengajuan = master_pengajuan::findOrFail($id_pengajuan);

    $pengajuan->delete();

    return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
}

}