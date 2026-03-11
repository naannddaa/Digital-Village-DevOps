<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_penduduk extends Model
{
    use HasFactory;

    protected $table = 'master_penduduks';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'golongan_darah',
        'status_perkawinan',
        'tanggal_perkawinan',
        'status_keluarga',
        'kewarganegaraan',
        'no_paspor',
        'no_kitap',
        'nama_ayah',
        'nama_ibu',
        'no_kk',

    ];
    
}
