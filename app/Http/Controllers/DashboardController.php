<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalBuku = Buku::count();
        $totalPinjam = Peminjaman::where('status', 'dipinjam')->count();

        $peminjamTerbaru = Peminjaman::with(['user', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboardadm', compact(
            'totalUser',
            'totalBuku',
            'totalPinjam',
            'peminjamTerbaru'
        ));
    }
}