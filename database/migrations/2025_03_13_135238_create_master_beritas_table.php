  <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('master_beritas', function (Blueprint $table) {
            
            $table->primary('id_berita');$table->string('id_berita', 10);
            $table->string('judul', 150);
            $table->string('tanggal');
            $table->text('deskripsi');
            $table->string('image', 100);
            $table->char('nik', 16);
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
        Schema::dropIfExists('master_berita');
    }
};
