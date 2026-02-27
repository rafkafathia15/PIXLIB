<?php

// app/Models/Favorit.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    protected $table = 'favorites'; // sesuaikan dengan DB
    protected $fillable = ['user_id','buku_id'];

    public function buku()
    {
        return $this->belongsTo(\App\Models\Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
