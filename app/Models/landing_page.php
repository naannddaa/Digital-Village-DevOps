<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landing_page extends Model
{
   protected $table = 'master_landingpage';

   public $timestamps = false;

    protected $fillable = [
        'judul',
        'deskripsi1',
        'gambar1',
        'subtittle',
        'section_text',
        'image_description1',
        'subtitle_2',
        'section_second',
        'image_description2',
        'visi',
        'misi',
        'about_us',
        'updated_at',
    ];

}