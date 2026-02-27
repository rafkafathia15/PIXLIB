<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Buku | Pixel Library</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Press Start 2P', monospace;
    image-rendering: pixelated;
}
</style>
</head>

<body class="bg-[#e6dccf] text-[#3f2a1d] min-h-screen flex flex-col">

<!-- NAVBAR -->
<nav class="bg-[#d6c4ae] border-b-4 border-[#b08968] shadow-[0_6px_0_#2d1b10]">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <h1 class="text-[#8b5e34] text-lg drop-shadow-[2px_2px_0_#f5efe6]">
            PIXLIB
        </h1>

        <div class="flex items-center space-x-6 text-xs">

            <a href="#" class="text-[#6f4e37] underline">DASHBOARD</a>
            <a href="{{ route('koleksi.buku') }}" class="hover:text-[#8b5e34]">KOLEKSI</a>
            <a href="{{ route('favorit.index') }}" class="hover:text-[#8b5e34]">FAVORIT</a>
            <a href="{{ route('riwayat.buku') }}" class="hover:text-[#8b5e34]">RIWAYAT</a>

            <!-- PROFILE -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-3 py-2 bg-[#e6dccf]
                      border-4 border-[#2d1b10]
                      shadow-[3px_3px_0_#2d1b10]
                      hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=b08968&color=2d1b10"
                     class="w-8 h-8 rounded-full border-2 border-[#2d1b10]">

                <span class="text-[#6f4e37]">
                    {{ Auth::user()->name }}
                </span>
            </a>

        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="flex-1 max-w-6xl mx-auto px-6 py-12">

    <h2 class="text-sm text-[#6f4e37] mb-8">
        RIWAYAT PEMINJAMAN BUKU
    </h2>

    @if($riwayat->isEmpty())
        <div class="bg-[#e6dccf] border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10] p-6 text-xs text-center">
            BELUM ADA RIWAYAT PEMINJAMAN 📚
        </div>
    @else

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-xs">

        @foreach($riwayat as $pinjam)

        <div class="bg-[#e6dccf] border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10] p-6
                    flex flex-row gap-6">

            <!-- GAMBAR -->
            <div class="w-32 flex-shrink-0">
                <img src="{{ asset('storage/' . $pinjam->buku->gambar) }}"
                     alt="Cover Buku"
                     class="w-full h-48 object-cover
                            border-4 border-[#2d1b10]">
            </div>

            <!-- DETAIL -->
            <div class="flex-1 space-y-3">

                <h3 class="text-[#6f4e37] text-xs">
                    {{ $pinjam->buku->judul ?? '-' }}
                </h3>

                <div class="text-[10px] text-[#8b5e34] space-y-2">

                    <p>
                        Tanggal Pinjam :
                        {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                    </p>

                    <p>
                        Tanggal Kembali :
                        {{ $pinjam->tanggal_kembali 
                            ? \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') 
                            : '-' }}
                    </p>

                </div>

                <!-- STATUS -->
                <div class="pt-2">
                    @if($pinjam->status == 'Menunggu Validasi')
                        <span class="px-3 py-1 bg-[#cbb49a]
                                     border-2 border-[#2d1b10]">
                            MENUNGGU VALIDASI
                        </span>

                    @elseif($pinjam->status == 'Dipinjam')
                        <span class="px-3 py-1 bg-[#b08968]
                                     border-2 border-[#2d1b10]">
                            DIPINJAM
                        </span>

                    @else
                        <span class="px-3 py-1 bg-[#a47148]
                                     border-2 border-[#2d1b10]">
                            {{ strtoupper($pinjam->status) }}
                        </span>
                    @endif
                </div>

                <!-- TOMBOL CETAK BUKTI -->
                <div class="pt-4">
                    <a href="{{ route('riwayat.cetak.perbuku', $pinjam->id) }}"
                       class="inline-block px-4 py-2 text-[9px]
                              bg-[#d6c4ae]
                              border-4 border-[#2d1b10]
                              shadow-[3px_3px_0_#2d1b10]
                              hover:translate-x-1 hover:translate-y-1 hover:shadow-none
                              transition">
                        CETAK BUKTI 📄
                    </a>
                </div>

            </div>

        </div>

        @endforeach

    </div>

    @endif

</main>

<!-- FOOTER -->
<footer class="bg-[#8b5e34] py-6 border-t-4 border-[#5c4033]
               shadow-[0_-6px_0_#2d1b10]">
    <div class="text-center text-[10px] text-[#f5efe6]
                drop-shadow-[1px_1px_0_#2d1b10]">
        © 2026 Pixel Library. All rights reserved.
    </div>
</footer>

</body>
</html>