@extends('petugas.layoutptg')

@section('title', 'Dashboard Petugas')

@section('content')

<h1 class="text-2xl font-bold text-[#6f4e37] mb-6">
    Dashboard Petugas
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Total Peminjaman --}}
    <div class="bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[6px_6px_0_#2d1b10] p-6">
        <h2 class="text-sm font-bold text-[#6f4e37]">Total Peminjaman</h2>
        <p class="text-3xl font-bold mt-2">{{ $totalPeminjaman ?? 0 }}</p>
    </div>

    {{-- Buku Dipinjam --}}
    <div class="bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[6px_6px_0_#2d1b10] p-6">
        <h2 class="text-sm font-bold text-[#6f4e37]">Sedang Dipinjam</h2>
        <p class="text-3xl font-bold mt-2">{{ $sedangDipinjam ?? 0 }}</p>
    </div>

    {{-- Buku Dikembalikan --}}
    <div class="bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[6px_6px_0_#2d1b10] p-6">
        <h2 class="text-sm font-bold text-[#6f4e37]">Sudah Dikembalikan</h2>
        <p class="text-3xl font-bold mt-2">{{ $sudahDikembalikan ?? 0 }}</p>
    </div>

</div>

@endsection
