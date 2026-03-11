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
        Schema::create('master_rt_rw', function (Blueprint $table) {
             $table->string('id_rtrw', 10);
            $table->primary('id_rtrw');
             $table->string('nik', 16);   
             $table->string('nama', 100);
             $table->string('no_hp', 15);
             $table->string('rt', 6)->nullable();
             $table->string('rw', 3);
             $table->timestamps();
             $table->foreign('nik')->references('nik')->on('master_penduduks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_rt_rw');
    }
};
