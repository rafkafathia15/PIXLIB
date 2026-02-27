<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $petugas = User::where('role', 'petugas')
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%")
                          ->orWhere('email', 'like', "%{$request->search}%")
                          ->orWhere('username', 'like', "%{$request->search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.manajemenpetugas', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'petugas',
        ]);

        return back()->with('success', 'Petugas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $petugas = User::where('role', 'petugas')->findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|unique:users,username,' . $id,
        ]);

        $petugas->update([
            'name'     => $request->nama,
            'email'    => $request->email,
            'username' => $request->username,
        ]);

        return back()->with('success', 'Data petugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $petugas = User::where('role', 'petugas')->findOrFail($id);
        $petugas->delete();

        return back()->with('success', 'Petugas berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD PETUGAS
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $totalPeminjaman   = Peminjaman::count();
        $sedangDipinjam    = Peminjaman::where('status', 'Dipinjam')->count();
        $sudahDikembalikan = Peminjaman::where('status', 'Dikembalikan')->count();

        return view('petugas.dashboard', compact(
            'totalPeminjaman',
            'sedangDipinjam',
            'sudahDikembalikan'
        ));
    }

    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->latest()
            ->get();

        return view('petugas.peminjaman', compact('peminjaman'));
    }

    public function riwayat()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->where('status', 'Dikembalikan')
            ->latest()
            ->get();

        return view('petugas.riwayat', compact('peminjaman'));
    }

    public function cetakPdf($id)
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->findOrFail($id);

        $pdf = Pdf::loadView('petugas.pdf_peminjaman', compact('peminjaman'));

        return $pdf->download('bukti-peminjaman-' . $peminjaman->id . '.pdf');
    }
}