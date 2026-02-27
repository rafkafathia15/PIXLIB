<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // =========================
    // RIWAYAT (STATUS DIKEMBALIKAN)
    // =========================
    public function riwayat()
    {
        $peminjaman = Peminjaman::with('buku')
                        ->where('status', 'Dikembalikan')
                        ->latest()
                        ->get();
    
        return view('admin.riwayat', compact('peminjaman'));
    }


    // =========================
    // CETAK PDF
    // =========================
    public function cetakPdf($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        $pdf = Pdf::loadView('admin.pdf_peminjamanadm', compact('peminjaman'));

        return $pdf->download('bukti-peminjaman.pdf');
    }


    // =========================
    // DATA PEMINJAM (AMBIL DARI USERS ROLE PEMINJAM)
    // =========================
    public function peminjam(Request $request)
   {
       $query = User::where('role', 'user');
   
       if ($request->search) {
           $query->where(function($q) use ($request) {
               $q->where('name', 'like', '%' . $request->search . '%')
                 ->orWhere('username', 'like', '%' . $request->search . '%')
                 ->orWhere('email', 'like', '%' . $request->search . '%');
           });
       }
   
       $peminjam = $query->latest()->paginate(5);
   
       return view('admin.peminjam', compact('peminjam'));
   }


    // =========================
    // HAPUS PEMINJAM (USER)
    // =========================
    public function destroyPeminjam($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.peminjam.index')
            ->with('success', 'Data peminjam berhasil dihapus!');
    }

}