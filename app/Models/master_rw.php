<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_rw extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['id_rtrw', 'nik', 'nama', 'no_hp', 'rt', 'rw'];
    protected $table ='master_rt_rw';
    public $timestamps = false;
}
