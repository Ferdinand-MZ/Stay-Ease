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
        Schema::create('booking', function (Blueprint $table) {
            $table->string('nomor_unik', 10);
            $table->id();
            
            $table->string('nama_tamu');
            $table->string('no_kamar'); 
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_harga')->nullable();
            $table->integer('total_transaksi')->nullable();
            $table->integer('uang_bayar');
            $table->integer('uang_kembali');
            $table->enum('status', ['Checked in', 'Checked out'])->default('Checked in');
            $table->timestamps();

            $table->foreign('no_kamar')->references('no_kamar')->on('kamar');
            $table->foreign('nama_tamu')->references('nama_tamu')->on('tamu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
};

