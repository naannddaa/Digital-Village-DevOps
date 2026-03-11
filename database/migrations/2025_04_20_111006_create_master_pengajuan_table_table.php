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
        Schema::create('master_pengajuan', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->string('id_surat', 20);
            $table->string('nik', 16); 
            $table->string('keperluan', 50);
            $table->date('tanggal_diajukan')->nullable();
            $table->string('status', 25);
            $table->string('keterangan_ditolak', 50)->nullable();
            $table->string('foto1', 100)->nullable();
            $table->string('foto2', 100)->nullable();
            $table->string('foto3', 100)->nullable();
            $table->string('foto4', 100)->nullable();
            $table->string('foto5', 100)->nullable();
            $table->string('foto6', 100)->nullable();
            $table->string('foto7', 100)->nullable();
            $table->string('foto8', 100)->nullable();
            $table->string('foto9', 100)->nullable();
            $table->string('file_pdf', 100)->nullable();
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('master_penduduks')->onDelete('cascade');
             $table->foreign('id_surat')->references('id_surat')->on('master_surat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pengajuan'); // diperbaiki dari 'master_pengajuan_table'
    }
};
