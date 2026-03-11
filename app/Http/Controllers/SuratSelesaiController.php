<?php

namespace App\Http\Controllers;

use App\Models\ViewDataPengajuan;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;

class SuratSelesaiController extends Controller
{
    public function index(Request $request)
    {
        $jumlahbaris = 10;
        $katakunci = $request->katakunci;
    
        if (strlen($katakunci)) {
            $datapengajuan = ViewDataPengajuan::where('status', 'Selesai') // Tambahkan ini
                ->where(function($query) use ($katakunci) {
                    $query->where('nik', 'like', "%$katakunci%")
                        ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                        ->orWhere('nama_surat', 'like', "%$katakunci%");
                })
                ->orderBy('id_pengajuan', 'desc')
                ->paginate($jumlahbaris);
        } else {
            $datapengajuan = ViewDataPengajuan::where('status', 'Selesai') // Tambahkan ini juga
                ->orderBy('id_pengajuan', 'desc')
                ->paginate($jumlahbaris);
        }
    
        return view('admin.pengajuan_surat.suratselesai', compact('datapengajuan'));
    }
    
        public function destroy($id_pengajuan)
    {
        // Cari ke model asli
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
    
        $pengajuan->delete();
    
        return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
    }
}
    