<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('master_kartukeluargas', function (Blueprint $table) {
            $table->primary('no_kk', 16);
            $table->String('no_kk');
            $table->String('alamat', 50);
            $table->String('rt', 3);
            $table->String('rw', 3);
            $table->String('desa', 30);
            $table->String('kecamatan', 50);
            $table->integer('kode_pos');
            $table->String('kabupaten', 30);
            $table->String('provinsi', 30);
            $table->date('tanggal_dibuat');
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
        Schema::dropIfExists('master_kartukeluargas');
    }
};
