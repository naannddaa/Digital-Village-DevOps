<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotifikasiPengajuan extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_pengajuan';

    protected $fillable = [
        'nik',
        'jenis',
        'id_ref',
        'pesan',
    ];

    public $timestamps = true;
}