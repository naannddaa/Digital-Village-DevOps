<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('master_landingpage', function (Blueprint $table) {
           $table->id(); // ini otomatis akan jadi primary key dan autoincrement
            $table->string('judul');
            $table->text('deskripsi1')->nullable();
            $table->json('gambar1')->nullable();
            $table->text('subtittle')->nullable();
            $table->text('section_text')->nullable();
            $table->string('image_description1',100)->nullable();
            $table->text('subtitle_2')->nullable();
            $table->text('section_second')->nullable();
            $table->string('image_description2',100)->nullable();
            $table->text('about_us')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_landingpage');
    }
};
