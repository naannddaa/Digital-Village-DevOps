<?php

namespace App\Http\Controllers;

use App\Models\master_penduduk;
use App\Models\master_kartukeluarga;
use Illuminate\Http\Request;

class master_kartukeluargaController extends Controller
{
    // Menampilkan daftar data dengan fitur pencarian
    public function index(Request $request)
{
    $keyword = $request->katakunci;

    $query = master_kartukeluarga::join(
        'master_penduduks', function($join) {
            $join->on('master_kartukeluargas.no_kk', '=', 'master_penduduks.no_kk')
                 ->where('master_penduduks.status_keluarga', '=', 'KEPALA KELUARGA');
        }
    )->select(
        'master_kartukeluargas.no_kk',
        'master_kartukeluargas.alamat',
        'master_kartukeluargas.rt',
        'master_kartukeluargas.rw',
        'master_kartukeluargas.kode_pos',
        'master_kartukeluargas.desa',
        'master_kartukeluargas.kecamatan',
        'master_kartukeluargas.kabupaten',
        'master_kartukeluargas.provinsi',
        'master_kartukeluargas.tanggal_dibuat',
        'master_penduduks.nama_lengkap',
        'master_penduduks.nik'
    );

    if (!empty($keyword)) {
        $query->where(function($q) use ($keyword) {
            $q->where('master_kartukeluargas.no_kk', 'LIKE', '%' . $keyword . '%')
              ->orWhere('master_penduduks.nama_lengkap', 'LIKE', '%' . $keyword . '%');
        });
    }

    $master_kartukeluarga = $query->paginate(8); 

    return view('admin.master_kartukeluarga.index', compact('master_kartukeluarga'));
}


    // Memasukkan data baru ke dalam database, ini smaa macam masuk, guna untuk insert data
    public function masuk(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|numeric|unique:master_kartukeluargas,no_kk',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required|numeric',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tanggal_dibuat' => 'required|date',
            'nik' => 'required|numeric|digits:16|unique:master_penduduks,nik',
            'nama_lengkap' => 'required'
        ]);

        // Simpan data ke master_kartukeluarga
        $master_kartukeluarga = master_kartukeluarga::create($request->only([
            'no_kk', 'alamat', 'rt', 'rw', 'desa', 'kecamatan', 'kode_pos', 'kabupaten', 'provinsi', 'tanggal_dibuat'
        ]));

        // Simpan data ke master_penduduk
        master_penduduk::create([
            'no_kk' => $master_kartukeluarga->no_kk,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'status_keluarga' => 'KEPALA KELUARGA'
        ]);

        return redirect(url('admin/master_kartukeluarga'))->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $no_kk_lama) {
        // Ambil data penduduk lama (kepala keluarga)
        $pendudukLama = master_penduduk::where('no_kk', $no_kk_lama)
                        ->where('status_keluarga', 'KEPALA KELUARGA')
                        ->first();
        
        if (!$pendudukLama) {
            return redirect('admin/master_kartukeluarga')->with('error', 'Data kepala keluarga tidak ditemukan');
        }
    
        // Cek apakah NIK berubah dan sudah ada di database
        $nikBaru = $request->input('nik');
        if ($nikBaru != $pendudukLama->nik) {
            $cekNik = master_penduduk::where('nik', $nikBaru)->exists();
            if ($cekNik) {
                return back()->withErrors(['nik' => 'NIK sudah digunakan'])->withInput();
            }
        }
    
        // Validasi input tanpa validasi unique untuk NIK
        $request->validate([
            'no_kk' => 'required|digits:16',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required|numeric',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required',
            'tanggal_dibuat' => 'required|date'
        ]);
    
        // Cek apakah nomor KK berubah dan sudah ada di database (kecuali KK saat ini)
        $no_kk_baru = $request->input('no_kk');
        if ($no_kk_baru != $no_kk_lama) {
            $cekKK = master_kartukeluarga::where('no_kk', $no_kk_baru)->exists();
            if ($cekKK) {
                return back()->withErrors(['no_kk' => 'Nomor KK sudah digunakan'])->withInput();
            }
        }
    
        // Update master_kartukeluarga
        master_kartukeluarga::where('no_kk', $no_kk_lama)->update([
            'no_kk' => $no_kk_baru,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'tanggal_dibuat' => $request->tanggal_dibuat
        ]);
    
        // Update semua penduduk dalam KK untuk ubah no_kk saja
        master_penduduk::where('no_kk', $no_kk_lama)->update([
            'no_kk' => $no_kk_baru
        ]);
    
        // Update khusus untuk kepala keluarga (NIK dan nama)
        master_penduduk::where('nik', $pendudukLama->nik)->update([
            'nik' => $nikBaru,
            'nama_lengkap' => $request->nama_lengkap
        ]);
    
        return redirect('admin/master_kartukeluarga')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data berdasarkan No KK
    public function delete($no_kk)
    {
        master_penduduk::where('no_kk', $no_kk)->delete();
        master_kartukeluarga::where('no_kk', $no_kk)->delete();

        return redirect(url('admin/master_kartukeluarga'))->with('success', 'Data berhasil dihapus');
    }
}
