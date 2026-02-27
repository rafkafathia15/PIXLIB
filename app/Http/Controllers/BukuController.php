<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Peminjaman;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategoris')
            ->orderBy('id', 'desc')
            ->get();

        $kategoris = Kategori::orderBy('nama')->get();

        return view('admin.manajemenbuku', compact('bukus', 'kategoris'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'judul'           => 'required|string',
        'penulis'         => 'required|string',
        'penerbit'        => 'required|string',
        'tahun_terbit'    => 'required|digits:4',
        'stok'            => 'required|integer|min:0',

        // opsional
        'sinopsis'        => 'nullable|string',
        'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        // kategori wajib
        'kategori_ids'    => 'required|array',
        'kategori_ids.*'  => 'exists:kategori,id',
    ]);

    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('buku', 'public');
    }

    $buku = Buku::create($validated);

    $buku->kategoris()->sync($request->kategori_ids);

    return redirect()
        ->route('admin.buku.index')
        ->with('success', 'Buku berhasil ditambahkan');
}


    public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);

    $validated = $request->validate([
        'judul'           => 'required|string',
        'penulis'         => 'required|string',
        'penerbit'        => 'required|string',
        'tahun_terbit'    => 'required|digits:4',
        'stok'            => 'required|integer|min:0',

        // opsional
        'sinopsis'        => 'nullable|string',
        'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        // kategori wajib
        'kategori_ids'    => 'required|array',
        'kategori_ids.*'  => 'exists:kategori,id',
    ]);

    if ($request->hasFile('gambar')) {
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }
        $validated['gambar'] = $request->file('gambar')->store('buku', 'public');
    }

    $buku->update($validated);
    $buku->kategoris()->sync($request->kategori_ids);

    return redirect()
        ->route('admin.buku.index')
        ->with('success', 'Buku berhasil diperbarui');
}


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    public function koleksi(Request $request)
{
    $query = Buku::query();

    // SEARCH (dibungkus supaya OR tidak merusak filter)
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('penulis', 'like', '%' . $request->search . '%');
        });
    }

    // MULTI KATEGORI
    if ($request->kategori) {
        $query->whereHas('kategoris', function ($q) use ($request) {
            $q->whereIn('kategori.id', $request->kategori);
        });
    }

    // PAGINATION
    $buku = $query->orderBy('judul')->paginate(8);

    $kategoris = Kategori::orderBy('nama')->get();

    return view('koleksibuku', compact('buku', 'kategoris'));
}



public function show($id)
{
    $buku = Buku::with(['ulasan.user'])->findOrFail($id);

    // Rating
    $rataRating = $buku->ulasan->avg('rating');
    $jumlahUlasan = $buku->ulasan->count();

    $sudahPinjam = false;
    $sudahSelesaiPinjam = false;
    $sudahPinjamUlasan = false; // <-- inisialisasi dulu

    if (auth()->check()) {
        $userId = auth()->id();

        // Cek sudah pernah pinjam atau dikembalikan
        $sudahPinjam = Peminjaman::where('user_id', $userId)
            ->where('buku_id', $id)
            ->whereIn('status', ['Dipinjam', 'Dikembalikan'])
            ->exists();

        // Cek khusus yang sudah dikembalikan
        $sudahSelesaiPinjam = Peminjaman::where('user_id', $userId)
            ->where('buku_id', $id)
            ->where('status', 'Dikembalikan')
            ->exists();

        // Cek apakah sudah pernah beri ulasan
        $sudahPinjamUlasan = $buku->ulasan()->where('user_id', $userId)->exists();
    }

    return view('detailbuku', compact(
        'buku',
        'sudahPinjam',
        'sudahSelesaiPinjam',
        'sudahPinjamUlasan', // <-- kirim ke view
        'rataRating',
        'jumlahUlasan'
    ));
}








}
