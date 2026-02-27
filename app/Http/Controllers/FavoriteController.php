<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Buku;

class FavoriteController extends Controller
{
    // ✅ TAMPILKAN HALAMAN FAVORIT
    public function index()
    {
        $user = auth()->user();

        $favorits = Favorit::with('buku')
                    ->where('user_id', $user->id)
                    ->get();

        return view('favorit', compact('favorits'));
    }

    // ✅ TOGGLE FAVORIT
    public function toggle(Request $request, Buku $buku)
    {
        $user = auth()->user();

        $favorit = Favorit::where('user_id', $user->id)
            ->where('buku_id', $buku->id)
            ->first();

        if($favorit){
            $favorit->delete();
            return response()->json(['status' => 'deleted']);
        } else {
            Favorit::create([
                'user_id' => $user->id,
                'buku_id' => $buku->id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
