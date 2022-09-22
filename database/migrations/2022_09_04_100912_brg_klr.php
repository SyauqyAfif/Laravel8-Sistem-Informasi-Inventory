<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrgKlr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brg_klr', function (Blueprint $table) {
            $table->id();
            $table->string('no_brg_klr');
            $table->integer('id_stok_barang');
            $table->integer('id_user');
            $table->date('tgl_brg_klr')->nullable();
            $table->integer('jml_brg_klr')->nullable();
            $table->bigInteger('total')->nullable();
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
        Schema::dropIfExists('brg_klr');
    }
}
