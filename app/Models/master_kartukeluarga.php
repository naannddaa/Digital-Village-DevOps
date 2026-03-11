<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_kartukeluarga extends Model
{
    use HasFactory;

    protected $table = 'master_kartukeluargas';
    protected $primaryKey = 'no_kk'; // Definisikan no_kk sebagai primary key
    public $incrementing = false; // Karena no_kk bukan auto-increment
    protected $keyType = 'string'; // Jika no_kk bertipe string
    public $timestamps = false;


    protected $fillable = [
        'no_kk',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kode_pos',
        'kabupaten',
        'provinsi',
        'tanggal_dibuat',
    ];

    public function penduduk() {
    return $this->hasOne(master_penduduk::class, 'no_kk', 'no_kk');
    }
}


