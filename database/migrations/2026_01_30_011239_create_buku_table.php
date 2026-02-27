<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id(); // buku_id

            // DATA BUKU
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->text('sinopsis')->nullable();

            // KATEGORI (FOREIGN KEY)
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->constrained('kategori')
                  ->nullOnDelete();

            // GAMBAR BUKU
            $table->string('gambar')->nullable();

            // STOK
            $table->integer('stok')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
