<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_surat;
use Illuminate\Support\Str;

class Master_suratController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci ?? ''; 
        $jumlahbaris = 10; 

        if (strlen($katakunci)) {
            $datasurat = master_surat::where('id_surat', 'like', "%$katakunci%")
                ->orWhere('nama_surat', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $datasurat = master_surat::orderBy('id_surat', 'asc')->paginate($jumlahbaris);
        }

        // Generate ID Surat otomatis
        $tahun = now()->format('Y');  
        $prefix = "S{$tahun}-";  

        $lastSurat = master_surat::where('id_surat', 'like', "$prefix%")
            ->orderBy('id_surat', 'desc')
            ->first();

        $newIncrement = 1;

        if ($lastSurat && preg_match('/^' . preg_quote($prefix, '/') . '(\d{3})$/', $lastSurat->id_surat, $matches)) {
            $newIncrement = (int)$matches[1] + 1;
        }

        $formattedIncrement = str_pad($newIncrement, 3, '0', STR_PAD_LEFT);  
        $id_surat = $prefix . $formattedIncrement; 

        return view('admin.master_surat.index', compact('datasurat', 'id_surat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required|unique:master_surat,id_surat',
            'nama_surat' => 'required|string|max:255|unique:master_surat,nama_surat',
        ]);

        master_surat::create([
            'id_surat' => $request->id_surat,
            'nama_surat' => $request->nama_surat,
        ]);

        return redirect()->route('mastersurat.index')->with('success', 'Data Surat Berhasil Disimpan');
    }

    public function update(Request $request, $id_surat)
    {
        $surat = master_surat::where('id_surat', $id_surat)->firstOrFail();

        $request->validate([
            'nama_surat' => 'required|string|max:255',
        ]);

        $data = [
            'nama_surat' => $request->nama_surat,
        ];

        $surat->update($data);

        return redirect()->route('mastersurat.index')->with('success', 'Data Surat Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $surat = master_surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('mastersurat.index')->with('success', 'Data Surat Berhasil Dihapus');
    }
}
