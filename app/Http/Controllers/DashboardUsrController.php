<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Favorit;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardUsrController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalBuku = Buku::count();
        $totalFavorit = Favorit::where('user_id', $userId)->count();
        $totalRiwayat = Peminjaman::where('user_id', $userId)
                            ->where('status', 'Dikembalikan')
                            ->count();

        return view('dashboard', compact(
            'totalBuku',
            'totalFavorit',
            'totalRiwayat'
        ));
    }
}