<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\master_penduduk;

class master_berita extends Model
{
    use HasFactory;

    protected $table = 'master_beritas'; 

    protected $fillable = [
        'id_berita',
        'judul',
        'isi',
        'image',
        'deskripsi',
        'tanggal',
        'nik',
    ];
    public function penulis()
{
    return $this->belongsTo(master_penduduk::class, 'nik', 'nik');
}
}