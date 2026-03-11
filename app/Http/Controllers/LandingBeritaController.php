<?php

namespace App\Http\Controllers;

use App\Models\master_berita;
use Illuminate\Http\Request;

class LandingBeritaController extends Controller
{
    public function index()
    {
        // Ambil semua berita beserta data penulis (relasi ke master_penduduk)
        $beritas = master_berita::with('penulis')->orderBy('created_at', 'desc')->get();
        return view('landing_page.detail-berita', compact('beritas'));
    }

    public function show($id_berita)
    {
        // Ambil satu berita beserta data penulis
        $berita = master_berita::with('penulis')->where('id_berita', $id_berita)->firstOrFail();
        return view('landing_page.detail-berita', compact('berita'));
    }
}