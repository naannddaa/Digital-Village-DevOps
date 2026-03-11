<?php 
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\master_penduduk;
use App\Models\master_kartukeluarga;

use PDF; 

class generate extends Controller
{

public function generateAndStorePdf($id_pengajuan)
{
    $data = DB::table('view_data')->where('id_pengajuan', $id_pengajuan)->first();
    if (!$data) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
    }

    $surat = DB::table('master_surat')->where('id_surat', $data->id_surat)->first();
    if (!$surat || !$surat->nama_surat) {
        return response()->json(['success' => false, 'message' => "Data surat tidak ditemukan."], 404);
    }

    $viewName = "generate." . strtolower(str_replace(' ', '', $surat->nama_surat));
    if (!view()->exists($viewName)) {
        return response()->json(['success' => false, 'message' => "Template surat untuk '{$surat->nama_surat}' tidak ditemukan."], 404);
    }

    $pdf = PDF::loadView($viewName, compact('data'))->setPaper('A4', 'portrait');

    $fileName = "{$data->id_surat}" . Str::slug($data->nama_lengkap) . "{$data->id_pengajuan}_" . time() . ".pdf";

    if (!Storage::disk('public')->exists('generatesurat')) {
        Storage::disk('public')->makeDirectory('generatesurat');
    }

    Storage::disk('public')->put("generatesurat/{$fileName}", $pdf->output());

    DB::table('master_pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
        'file_pdf' => $fileName,
    ]);

    return response()->json(['success' => true, 'message' => 'PDF berhasil dibuat dan disimpan.']);
}




 public function draftKK($no_kk)
{
    
    $anggota = master_penduduk::where('no_kk', $no_kk)
        ->orderByRaw("CASE WHEN status_keluarga = 'KEPALA KELUARGA' THEN 0 ELSE 1 END")
        ->orderBy('tanggal_lahir')
        ->get();

    if ($anggota->isEmpty()) {
        return response()->view('generate.errorskk', [
            'message' => 'Data dengan No. KK tersebut tidak ditemukan.'
        ]);
    }
$kepala_keluarga = $anggota->firstWhere('status_keluarga', 'KEPALA KELUARGA');

    $kk = master_kartukeluarga::where('no_kk', $no_kk)->first();

    if (!$kk) {
        return response()->view('generate.errorskk', [
            'message' => 'Data Kartu Keluarga tidak ditemukan.'
        ]);
    }

    try {
        $data = [
            'no_kk' => $kk->no_kk,
            'alamat' => $kk->alamat,
            'rt' => $kk->rt,
            'rw' => $kk->rw,
            'kode_pos' => $kk->kode_pos,
            'desa' => $kk->desa,
            'kecamatan' => $kk->kecamatan,
            'kabupaten' => $kk->kabupaten,
            'provinsi' => $kk->provinsi,
            'kk' => $kk,
            'data' => $anggota,
            'kepala_keluarga' => $kepala_keluarga,
        ];  

        $pdf = PDF::loadView('generate.draftkk', $data)->setPaper('a4', 'landscape');
        return $pdf->download("draftkk_{$no_kk}.pdf");
    } catch (\Exception $e) {
        return response()->view('generate.errorskk', [
            'message' => 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage()
        ]);
    }
}



}