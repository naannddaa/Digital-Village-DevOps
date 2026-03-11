<?php

namespace App\Http\Controllers;
use App\Models\landing_page;
use App\Models\master_berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use App\Models\MasterBerita;


class landing_pageController extends Controller
{
    public function index()
    {
        $data = landing_page::first();

       
        if (!$data) {
            $data = new landing_page(); 
        }

        return view('admin.landingpage.index', compact('data'));
    }

    public function tampil() {
        $data = landing_page::first();
        $beritas = master_berita::all();

        return view('landing_page.index', compact('data', 'beritas'));

}

    public function update(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'subtittle' => 'nullable|string',
        'section_text' => 'nullable|string',
        'subtitle_2' => 'nullable|string',
        'section_second' => 'nullable|string',
        'about_content' => 'nullable|string',
        'hero_image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'image_description1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'image_description2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'visi' => 'nullable|string',
        'misi' => 'nullable|string',
    ]);

    // Cari data pertama atau buat baru jika tidak ada
    $content = landing_page::first();

    if (!$content) {
        // Jika tidak ada data, buat data baru dengan id = 1
        $content = new landing_page();
    }

    // Update teks
    $content->judul = $request->title;
    $content->deskripsi1 = $request->description;
    $content->subtittle = $request->subtittle;
    $content->section_text = $request->section_text;
    $content->subtitle_2 = $request->subtitle_2;
    $content->section_second = $request->section_second;
    $content->about_us = $request->about_content;
    $content->visi = $request->visi;
    $content->misi = $request->misi;

    // Upload hero image jika ada
    if ($request->hasFile('hero_image')) {
        // Hapus gambar lama jika ada
        if ($content->gambar1) {
            Storage::delete('public/' . $content->gambar1);
        }
        $paths = [];
        foreach ($request->file('hero_image') as $file) {
            $paths[] = $file->store('landingpage/hero_images', 'public');
        }
        $content->gambar1 = json_encode($paths);
    }

    // Upload image_description1 jika ada
    if ($request->hasFile('image_description1')) {
        // Hapus gambar lama jika ada
        if ($content->image_description1) {
            Storage::delete('public/' . $content->image_description1);
        }
        $content->image_description1 = $request->file('image_description1')->store('landingpage/description_images', 'public');
    }

    // Upload image_description2 jika ada
    if ($request->hasFile('image_description2')) {
        // Hapus gambar lama jika ada
        if ($content->image_description2) {
            Storage::delete('public/' . $content->image_description2);
        }
        $content->image_description2 = $request->file('image_description2')->store('landingpage/description_images', 'public');
    }

        // Simpan perubahan
        $content->save();

    return redirect()->back()->with('success', 'Konten berhasil diperbarui!');
}


}