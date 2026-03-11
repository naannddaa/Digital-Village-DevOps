<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewDataPengajuan extends Model
{
    protected $table = 'view_data_pengajuan';
    protected $primaryKey = 'id_pengajuan';

    // Jika view tidak punya primary key, disable incrementing dan timestamps
    public $incrementing = false;
    public $timestamps = false;
}
