<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'sinopsis',
        'gambar',
        'stok',
    ];

    // RELASI MANY TO MANY
    public function kategoris()
    {
        return $this->belongsToMany(
            Kategori::class,
            'buku_kategori',
            'buku_id',
            'kategori_id'
        );
    }

    // RELASI KE ULASAN
    // RELASI KE ULASAN
public function ulasan()
{
    return $this->hasMany(\App\Models\Ulasan::class); // pakai model Ulasan
}


    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}


public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites');
}


public function favorit()
{
    return $this->hasMany(Favorit::class);
}




}
