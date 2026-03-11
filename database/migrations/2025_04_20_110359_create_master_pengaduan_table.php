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
        Schema::create('master_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16); 
            $table->text('ulasan');
            $table->string('foto1', 100);
            $table->text('feedback')->nullable();
            $table->string('kategori', 25);
            $table->foreign('nik')->references('nik')->on('master_penduduks')->onDelete('cascade');
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
        Schema::dropIfExists('master_pengaduan');
    }
};
