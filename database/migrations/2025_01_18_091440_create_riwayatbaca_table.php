<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_buku')->constrained('buku')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('riwayat');
    }
};
