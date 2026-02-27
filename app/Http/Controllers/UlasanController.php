<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
{
    $bukus = \App\Models\Buku::with(['ulasan.user'])->get();

    return view('admin.ulasan', compact('bukus'));
}

    public function store(Request $request, $id)
    {
        // HARUS LOGIN
        if (!Auth::check()) {
            return back()->with('error', 'Silakan login terlebih dahulu.');
        }

        // VALIDASI
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        // CEK SUDAH SELESAI PINJAM (status Dikembalikan)
        $sudahSelesai = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $id)
            ->where('status', 'Dikembalikan')
            ->exists();

        if (!$sudahSelesai) {
            return back()->with('error', 'Kamu hanya bisa memberi ulasan setelah buku dikembalikan.');
        }

        // CEK SUDAH PERNAH REVIEW
        $sudahReview = Ulasan::where('user_id', Auth::id())
            ->where('buku_id', $id)
            ->exists();

        if ($sudahReview) {
            return back()->with('error', 'Kamu sudah memberi ulasan untuk buku ini.');
        }

        // SIMPAN ULASAN
        Ulasan::create([
            'user_id'  => Auth::id(),
            'buku_id'  => $id,
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}
