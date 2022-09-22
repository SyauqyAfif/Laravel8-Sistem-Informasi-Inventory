<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StokBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // migrasi database barang
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_stok_barang')->nullable();
            $table->integer('id_kategori');
            $table->string('nama_barang')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('stok')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('harga_jual')->nullable();
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
        Schema::dropIfExists('stok_barang');
    }
}