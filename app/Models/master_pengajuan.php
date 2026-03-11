<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_pengajuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = ['id_pengajuan',
                            'id_surat',
                            'nik',
                            'keperluan',
                            'tanggal_diajukan',
                            'status',
                            'keterangan_ditolak',
                            'foto1',
                            'foto2',
                            'foto3',
                            'foto4',
                            'foto5',
                            'foto6',
                            'foto7',
                            'foto8',
                            'foto9',
                            'file_pdf'];
    protected $table = 'master_pengajuan';
    protected $guarded = ['created_at'];

    public $timestamps = true;

    // relasi ke table master_surat
    public function surat() {
        return $this->belongsTo(master_surat::class, 'id_surat');
    }
}
