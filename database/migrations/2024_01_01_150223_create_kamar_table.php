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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('foto_kamar');
            $table->string('no_kamar')->unique();
            $table->enum('tipe_kamar',['standar', 'executive','luxury']);
            $table->integer('harga');
            $table->string('fasilitas');
            $table->enum('status',['free', 'booked'])->default('free');;
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
        Schema::dropIfExists('kamar');
    }
};
