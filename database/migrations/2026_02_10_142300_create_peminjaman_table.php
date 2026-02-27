<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            // RELASI
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade');

            // DATA PEMINJAM
            $table->string('nama');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->text('alamat'); // <-- TAMBAHAN ALAMAT

            // TANGGAL
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');

            // STATUS
            $table->enum('status', [
                'Menunggu Validasi',
                'Dipinjam',
                'Dikembalikan',
                'Tidak Dikembalikan'
            ])->default('Menunggu Validasi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
