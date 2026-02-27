<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Koleksi Buku | Pixel Library</title>

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
        <h1 class="text-[#8b5e34] text-lg drop-shadow-[2px_2px_0_#f5efe6]">PIXLIB</h1>

        <div class="flex items-center space-x-6 text-xs">
            <a href="{{ route('dashboard') }}" class="hover:text-[#8b5e34]">DASHBOARD</a>
            <a href="{{ route('koleksi.buku') }}" class="underline">KOLEKSI</a>
            <a href="{{ route('favorit.index') }}" class="hover:text-[#8b5e34]">FAVORIT</a>
            <a href="{{ route('riwayat.buku') }}" class="hover:text-[#8b5e34]">RIWAYAT</a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-3 py-2 bg-[#e6dccf]
                      border-4 border-[#2d1b10]
                      shadow-[3px_3px_0_#2d1b10]
                      hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=b08968&color=2d1b10"
                     class="w-8 h-8 rounded-full border-2 border-[#2d1b10]">

                <span class="text-[#6f4e37]">{{ Auth::user()->name }}</span>
            </a>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="flex-1 py-14">
    <div class="max-w-7xl mx-auto px-6">

    <!-- HEADER SECTION -->
<div class="mb-10 text-center">
    <h2 class="text-sm text-[#8b5e34] mb-4 drop-shadow-[2px_2px_0_#f5efe6]">
        📚 JELAJAHI KOLEKSI BUKU
    </h2>
    <p class="text-[10px] text-[#6f4e37] leading-relaxed max-w-xl mx-auto">
        Temukan buku favoritmu, cari berdasarkan judul atau penulis,
        lalu pilih kategori yang kamu suka yaa ✨
    </p>
</div>

        <!-- SEARCH & MULTI FILTER -->
        <form method="GET" class="mb-10 space-y-6">

            <!-- SEARCH -->
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="CARI JUDUL / PENULIS..."
                   class="w-full px-4 py-3 text-xs
                          bg-[#f5efe6] border-4 border-[#2d1b10]
                          shadow-[3px_3px_0_#2d1b10] focus:outline-none">

            <!-- KATEGORI MULTI SELECT -->
            <div class="flex flex-wrap gap-3">
                @foreach($kategoris as $kategori)
                    <label class="cursor-pointer">
                        <input type="checkbox"
                               name="kategori[]"
                               value="{{ $kategori->id }}"
                               class="hidden peer"
                               {{ in_array($kategori->id, request('kategori', [])) ? 'checked' : '' }}>

                        <span class="px-3 py-2 text-[10px]
                                     bg-[#f5efe6]
                                     border-4 border-[#2d1b10]
                                     shadow-[3px_3px_0_#2d1b10]
                                     peer-checked:bg-[#b08968]
                                     peer-checked:translate-x-1
                                     peer-checked:translate-y-1
                                     peer-checked:shadow-none
                                     transition inline-block">
                            {{ strtoupper($kategori->nama) }}
                        </span>
                    </label>
                @endforeach
            </div>

            <!-- TOMBOL FILTER & REFRESH -->
            <div class="flex gap-4">
                <button type="submit"
                        class="px-6 py-3 text-xs bg-[#b08968] text-[#2d1b10]
                               border-4 border-[#2d1b10]
                               shadow-[3px_3px_0_#2d1b10]
                               hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
                    FILTER
                </button>

                <a href="{{ route('koleksi.buku') }}"
                   class="px-6 py-3 text-xs bg-[#f5efe6] text-[#2d1b10]
                          border-4 border-[#2d1b10]
                          shadow-[3px_3px_0_#2d1b10]
                          hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition text-center">
                    REFRESH
                </a>
            </div>

        </form>

        @if ($buku->isEmpty())
            <p class="text-center text-xs text-[#6f4e37]">Belum ada buku tersedia 📭</p>
        @endif

        <!-- GRID -->
        <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($buku as $item)
                <div class="bg-[#e6dccf] border-4 border-[#2d1b10]
                            shadow-[6px_6px_0_#2d1b10] p-4 text-[10px]
                            hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">

                    <div class="bg-[#f5efe6] border-4 border-[#2d1b10]
                                mb-4 aspect-[3/4] overflow-hidden">
                        <img src="{{ $item->gambar
                                    ? asset('storage/' . $item->gambar)
                                    : 'https://i.imgur.com/7QZ6FQy.png' }}"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-[#6f4e37] mb-2 leading-relaxed">{{ $item->judul }}</h3>

                    <div class="mb-2">
                        @foreach($item->kategoris as $kat)
                            <span class="px-2 py-1 text-[8px] bg-[#d6c4ae]
                                         border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">
                                {{ strtoupper($kat->nama) }}
                            </span>
                        @endforeach
                    </div>

                    <p class="text-[#5c4033] mb-2">{{ $item->penulis }}</p>
                    <p class="text-[#8b5e34] mb-4">{{ $item->tahun_terbit }}</p>

                    <a href="{{ route('buku.detail', $item->id) }}"
                       class="block text-center px-3 py-2 bg-[#b08968] text-[#2d1b10]
                              border-4 border-[#2d1b10]
                              shadow-[3px_3px_0_#2d1b10]
                              hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
                        DETAIL
                    </a>
                </div>
            @endforeach
        </div>

        <!-- PAGINATION -->
        <div class="mt-14 text-xs">
            {{ $buku->withQueryString()->links() }}
        </div>

    </div>
</main>

<footer class="bg-[#8b5e34] py-6 border-t-4 border-[#5c4033]
               shadow-[0_-6px_0_#2d1b10]">
    <p class="text-center text-xs text-[#f5efe6] drop-shadow-[1px_1px_0_#2d1b10]">
        © 2026 Pixel Library. All rights reserved.
    </p>
</footer>

</body>
</html>