<?php

namespace App\Http\Controllers;


use App\Models\master_penduduk;
use App\Models\master_rw;
use App\Models\master_rt;
use Illuminate\Http\Request;

class masterAkunRwController extends Controller
{
    public $id_rtrw;

  public function index(Request $request)
{
    $katakunci = $request->katakunci ?? '';
    $jumlahbaris = 10;

    // Mulai query dasar
    $dataakunrw = master_rw::whereNull('rt');

    // Tambahkan pencarian jika kata kunci ada
    if (strlen($katakunci)) {
        $dataakunrw = $dataakunrw->where(function ($query) use ($katakunci) {
            $query->where('id_rtrw', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('nik', 'like', "%$katakunci%")
                ->orWhere('rw', 'like', "%$katakunci%");
        });
    }

    // Tambahkan urutan dan pagination
    $dataakunrw = $dataakunrw->orderBy('id_rtrw', 'desc')->paginate($jumlahbaris);

    // Membuat ID autoincrement
    $currentDate = now();
    $tahun = $currentDate->format('Y');
    $prefix = "R{$tahun}-";

    $lastAkunRw = master_rw::where('id_rtrw', 'like', "$prefix%")
        ->orderBy('id_rtrw', 'desc')
        ->first();

    $newIncrement = $lastAkunRw
        ? (int)substr($lastAkunRw->id_rtrw, strlen($prefix)) + 1
        : 1;

    $formattedIncrement = str_pad($newIncrement, 3, '0', STR_PAD_LEFT);
    $id_rtrw = $prefix . $formattedIncrement;

    // Mengambil data penduduk kepala keluarga
    $data = master_penduduk::join('master_kartukeluargas', 'master_penduduks.no_kk', '=', 'master_kartukeluargas.no_kk')
        ->select(
            'master_penduduks.nama_lengkap',
            'master_penduduks.nik',
            'master_kartukeluargas.rw'
        )
        ->get();

    // Kirim ke view
    return view('admin.MasterAkun.akun_rw', compact('dataakunrw', 'id_rtrw', 'data'));
}


    public function create()
    {
        //
        return view('admin.MasterAkun.akun_rw');
    }

    public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|exists:master_penduduks,nik|unique:master_rt_rw,nik',
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15|min_digits:10',
        'rw' => 'required|string|max:3',
    ], [
        'nik.exists' => 'NIK belum terdaftar di data penduduk, silahkan menambahkan data di master penduduk terlebih dahulu.',
        'nik.unique' => 'NIK yang anda gunakan sudah terdaftar sebagai Ketua RW.',
        'no_hp.max' => 'Panjang nomer Hp maksimal 15 karakter',
        'no_hp.min_digits' => 'Panjang nomer Hp minimal 10 karakter',
        'rw.required' => 'RW wajib diisi.',
        'rw.max' => 'Panjang RW maksimal 3 karakter',
    ]);

    // Validasi RW tidak boleh duplicate untuk Ketua RW
    $existsRw = master_rt::where('rw', $request->rw)
        ->whereNull('rt') // cari RW tanpa RT (ketua RW)
        ->exists();

    if ($existsRw) {
        return redirect()->back()->withErrors([
            'rw' => 'RW yg dipilih sudah memiliki Ketua RW.',
        ])->withInput();
    }

    $dataakunrw = [
        'id_rtrw' => $request->id_rtrw,
        'nik' => $request->nik,
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'rw' => $request->rw,
    ];

    master_rt::create($dataakunrw);

    return redirect()->route('akunrw')->with('success', 'Data Berhasil Disimpan');
}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15|min_digits:10',
        'rw' => 'required|string|max:3',
    ], [
        'nama.required' => 'Nama wajib diisi.',
        'no_hp.required' => 'Nomor HP wajib diisi.',
        'rw.required' => 'RW wajib diisi.',
    ]);

    // Cek apakah RW sudah digunakan oleh Ketua RW lain
    $existsRw = master_rw::where('rw', $request->rw)
        ->where('id_rtrw', '!=', $id) // exclude data yang sedang diedit
        ->whereNull('rt') // kalau mau pastikan hanya ketua RW, bisa tambah ini
        ->exists();

    if ($existsRw) {
        return redirect()->back()->withErrors([
            'rw' => 'RW ini sudah memiliki Ketua RW.',
        ])->withInput();
    }

    $dataakunrw = [
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'rw' => $request->rw,
    ];

    master_rw::where('id_rtrw', $id)->update($dataakunrw);

    return redirect()->route('akunrw')->with('success', 'Data Berhasil Diedit');
}


    public function destroy($id_rtrw)
    {
        master_rw::where('id_rtrw', $id_rtrw)->delete();
        return redirect()->route('akunrw')->with('success', 'Data berhasil dihapus');
    }

    // memgambil data untuk tambah data berdasarkan nama
    public function getNamaRw(Request $request){
        $nama_lengkap = $request->nama_lengkap;
        $data = master_penduduk::where('nama_lengkap', $nama_lengkap)->first();
        if ($data) {
            return response()->json([
                'success' => true,
                'nik' =>$data->nik
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan'
            ]);
        }
        }
    }