<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_buku')->constrained('buku')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status_buku', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam');
    }
};
