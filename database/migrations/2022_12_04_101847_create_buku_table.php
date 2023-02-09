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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string("isbn", 13)->unique();
            $table->string("judul", 128);
            $table->json("gambar")->nullable();
            $table->string("penulis", 64);
            $table->integer("tahun_terbit");
            $table->string("penerbit", 128);
            $table->integer("jumlah");
            $table->text("resume")->nullable();
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
        Schema::dropIfExists('buku');
    }
};