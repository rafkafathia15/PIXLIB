<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
    ];

    // RELASI MANY TO MANY
    public function buku()
    {
        return $this->belongsToMany(
            Buku::class,
            'buku_kategori',
            'kategori_id',
            'buku_id'
        );
    }
}
