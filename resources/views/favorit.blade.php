<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Favorit | Pixel Library</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Pixel Font -->
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

            <a href="{{ route('dashboard') }}" class="text-[#6f4e37] underline">DASHBOARD</a>
            <a href="{{ route('koleksi.buku') }}" class="hover:text-[#8b5e34]">KOLEKSI</a>
            <a href="{{ route('favorit.index') }}" class="hover:text-[#8b5e34]">FAVORIT</a>
            <a href="{{ route('riwayat.buku') }}" class="hover:text-[#8b5e34]">RIWAYAT</a>

            <!-- PROFILE WITH PHOTO -->
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
<main class="flex-1 py-14">
    <div class="max-w-7xl mx-auto px-6">

        @if ($favorits->isEmpty())
            <p class="text-center text-xs text-[#6f4e37]">
                Kamu belum punya buku favorit 📭
            </p>
        @endif

        <!-- GRID -->
        <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

            @foreach ($favorits as $favorit)
            <div class="bg-[#e6dccf]
                        border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10]
                        p-4 text-[10px]
                        hover:translate-x-1 hover:translate-y-1
                        hover:shadow-none transition">

                <!-- COVER -->
                <div class="bg-[#f5efe6] border-4 border-[#2d1b10]
                            mb-4 aspect-[3/4] overflow-hidden">
                    <img src="{{ $favorit->buku->gambar
                                ? asset('storage/' . $favorit->buku->gambar)
                                : 'https://i.imgur.com/7QZ6FQy.png' }}"
                         alt="{{ $favorit->buku->judul }}"
                         class="w-full h-full object-cover">
                </div>

                <!-- JUDUL -->
                <h3 class="text-[#6f4e37] mb-2 leading-relaxed">
                    {{ $favorit->buku->judul }}
                </h3>

                <!-- PENULIS -->
                <p class="text-[#5c4033] mb-2">
                    {{ $favorit->buku->penulis }}
                </p>

                <!-- TAHUN -->
                <p class="text-[#8b5e34] mb-4">
                    {{ $favorit->buku->tahun_terbit }}
                </p>

                <!-- BUTTON DETAIL -->
                <a href="{{ route('buku.detail', $favorit->buku->id) }}"
                   class="block text-center px-3 py-2
                          bg-[#b08968] text-[#2d1b10]
                          border-4 border-[#2d1b10]
                          shadow-[3px_3px_0_#2d1b10]
                          hover:translate-x-1 hover:translate-y-1
                          hover:shadow-none transition">
                    DETAIL
                </a>
            </div>
            @endforeach

        </div>
    </div>
</main>

<!-- FOOTER -->
<footer class="bg-[#8b5e34] py-6 border-t-4 border-[#5c4033]
               shadow-[0_-6px_0_#2d1b10]">
    <p class="text-center text-xs text-[#f5efe6]
              drop-shadow-[1px_1px_0_#2d1b10]">
        © 2026 Pixel Library
    </p>
</footer>

</body>
</html>
