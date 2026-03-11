<?php

namespace App\Http\Controllers;

use App\Models\master_berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class beritaController extends Controller
{
    public $filename;
    public $idBerita;

    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;

        // untuk search, cek apakah user mencari data
        if (strlen($katakunci)) {
            $databerita = master_berita::where('id_berita', 'like', "%$katakunci%")
                ->orWhere('judul', 'like', "%$katakunci%")
                ->orWhere('deskripsi', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);

        // jika user tidak mencari data, menampilkan berdasarkan berita terbaru
        } else {
            $databerita = master_berita::orderBy('id_berita', 'desc')->paginate($jumlahbaris);
        }

        return view('admin.berita.index', compact('databerita'));
    }

    public function create()
    {
        // Generate ID Berita dengan format B[bulan]-001
        $currentDate = now();
        $tahun = $currentDate->format('Y');
        $prefix = "B{$tahun}-";

        // mengambil id berita terakhir
        $lastBerita = master_berita::where('id_berita', 'like', "$prefix%")
            ->orderBy('id_berita', 'desc')
            ->first();

        // untk membuat digit terakhirnya
        $newIncrement = $lastBerita
            ? (int)substr($lastBerita->id_berita, strlen($prefix)) + 1
            : 1;
        // str pad untuk menambahkan nol didepan angka
        $formattedIncrement = str_pad($newIncrement, 4, '000', STR_PAD_LEFT);
        // menggabungkan nomor yg telah dibuat
        $idBerita = $prefix . $formattedIncrement;

        return view('admin.berita.create', compact('idBerita'));
    }

    public function store(Request $request)
    {
      
        // melakukan validasi
        $request->validate([
            'id_berita' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'tanggal' => 'required|date',
        ]);

        //cek apakah user upload pada form image
        if ($request->hasFile('image')) {
            
            // mengambil file yg di upload dan menyimpan di variabl file
            $file = $request->file('image');
            $this->filename = date('YmdHi') . '-' . $file->getClientOriginalName();

            // menyimpan file pada storage/image
            $data['image'] = $file->storeAs('public/imageberita', $this->filename);
        } else {
            $this->filename = null;
        }

        $nik = Auth::user()->nik;

        // menyimpannya ke database berdasarkan inputan dari form
        $databerita = [
            'id_berita' => $request->id_berita,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $this->filename,
            'tanggal' => $request->tanggal,
            'nik' => $nik,
            'created_at' => now(),
        ];

        master_berita::create($databerita);
        return redirect('admin/berita')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $databerita = master_berita::where('id_berita', $id)->first();
        return view('admin.berita.edit', compact('databerita'));
    }

    public function update(Request $request, $id)
    {
        // validasi
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required|date',
        ]);

       $databerita = master_berita::where('id_berita', $id)->firstOrFail(); 

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $this->filename = time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('public/imageberita', $this->filename);

        } else {
        $filename = $databerita->image; // Pakai gambar lama
    }


        $databerita = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $this->filename ?? $databerita->image,
            'tanggal' => $request->tanggal,
            'updated_at' => now(),
        ];

        master_berita::where('id_berita', $id)->update($databerita);
        return redirect('admin/berita')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy($id)
    {
       // Temukan data berdasarkan 'id_berita'
    $berita = master_berita::where('id_berita', $id)->first();
    
    if ($berita && $berita->image) {
        // Path gambar
        $imagePath = public_path('storage/imageberita/' . $berita->image);

        if (file_exists($imagePath)) {
            // Hapus file gambar
            unlink($imagePath);
        }
    }

    // Hapus data berdasarkan 'id_berita'
    master_berita::where('id_berita', $id)->delete();

    return redirect('admin/berita')->with('success', 'Data Berhasil Dihapus');
}
}