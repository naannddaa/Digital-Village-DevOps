<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPengaduan extends Model
{
    use HasFactory;

    protected $table = 'master_pengaduan';
    public $timestamps = true;

    protected $fillable = [
        'nik',
        'ulasan',
        'foto1',
        'feedback',
        'kategori',
    ];

    public function penduduk()
    {
        return $this->belongsTo(master_penduduk::class, 'nik', 'nik');
    }
}