<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // =========================
    // TAMPILKAN FORM PEMINJAMAN
    // =========================
    public function create($id)
    {
        $buku = Buku::findOrFail($id);
        return view('formpeminjam', compact('buku'));
    }

    // =========================
    // SIMPAN DATA PEMINJAMAN
    // =========================
    public function store(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:' . now()->addDays(14)->format('Y-m-d'),
        ]);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis 😢');
        }

        $masihAktif = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $id)
            ->whereIn('status', ['Menunggu Validasi', 'Dipinjam'])
            ->exists();

        if ($masihAktif) {
            return back()->with('error', 'Kamu masih memiliki peminjaman aktif untuk buku ini.');
        }

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Menunggu Validasi',
        ]);

        session()->flash('success', [
            'id' => $peminjaman->id,
            'nama' => $peminjaman->nama,
            'email' => $peminjaman->email,
            'nomor_telepon' => $peminjaman->nomor_telepon,
            'alamat' => $peminjaman->alamat,
            'judul_buku' => $buku->judul,
            'tanggal_pinjam' => Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d'),
            'tanggal_kembali' => Carbon::parse($peminjaman->tanggal_kembali)->format('Y-m-d'),
            'status' => $peminjaman->status,
        ]);

        return redirect()->route('buku.detail', $id);
    }

    // =========================
    // UPDATE STATUS (ADMIN)
    // =========================
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);

        $peminjaman->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    // =========================
    // RIWAYAT USER
    // =========================
    public function riwayat()
    {
        $riwayat = Peminjaman::with('buku')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('riwayatbuku', compact('riwayat'));
    }

    // =========================
    // CETAK BUKTI PER BUKU (AMAN)
    // =========================
    public function cetakPerBuku($id)
    {
        $pinjam = Peminjaman::with('buku')
                    ->where('user_id', Auth::id()) // penting biar aman
                    ->findOrFail($id);

        $pdf = Pdf::loadView('riwayat.cetak_perbuku', compact('pinjam'));

        return $pdf->stream("Bukti_Peminjaman_{$pinjam->id}.pdf");
    }
}