<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_penduduks', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('nama_lengkap', 50);
            $table->string('jenis_kelamin', 15)->nullable();
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('golongan_darah', 3)->nullable();
            $table->string('status_perkawinan', 20)->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('status_keluarga', 20)->nullable();
            $table->string('kewarganegaraan', 5)->nullable();
            $table->string('no_paspor', 12)->nullable();
            $table->string('no_kitap', 12)->nullable();
            $table->string('nama_ayah', 50)->nullable();
            $table->string('nama_ibu', 50)->nullable();
            $table->string('no_kk', 16)->nullable();
            $table->foreign('no_kk')->references('no_kk')->on('master_kartukeluargas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_penduduks');
    }
};
