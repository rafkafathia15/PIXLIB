<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class KoleksiBukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        // SEARCH (dibungkus biar OR gak rusak filter)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('penulis', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER MULTI KATEGORI
        if ($request->kategori) {
            $query->whereHas('kategoris', function ($q) use ($request) {
                $q->whereIn('kategori.id', $request->kategori);
            });
        }

        // PAGINATION
        $buku = $query->orderBy('judul')->paginate(8);

        // AMBIL SEMUA DATA KATEGORI
        $kategoris = Kategori::orderBy('nama')->get();

        return view('koleksi', compact('buku', 'kategoris'));
    }
}