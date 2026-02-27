<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Pixel Library</title>

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

<body class="bg-[#e6dccf] text-[#3f2a1d] min-h-screen">

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


<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
    <div>
        <h2 class="text-xl md:text-2xl leading-relaxed text-[#6f4e37]
                   drop-shadow-[3px_3px_0_#f5efe6]">
            DASHBOARD USER
        </h2>

        <p class="mt-6 text-xs text-[#5c4033] leading-relaxed">
            Selamat datang kembali,
            <span class="text-[#8b5e34]">{{ Auth::user()->name }}</span> 👋  
            Nikmati koleksi favoritmu.
        </p>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('koleksi.buku') }}"
               class="px-6 py-3 bg-[#cbb49a] text-[#2d1b10]
                      border-4 border-[#2d1b10]
                      shadow-[4px_4px_0_#2d1b10]
                      hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition">
                KOLEKSI
            </a>
        </div>
    </div>

    <div class="flex justify-center">
        <img src="{{ asset('asset/pulang.png') }}"
             alt="Dashboard"
             class="w-64 drop-shadow-[0_0_18px_#b08968]">
    </div>
</section>


<!-- RINGKASAN AKTIVITAS -->
<section class="bg-[#d6c4ae] py-16 border-t-4 border-[#b08968]">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-center text-[#6f4e37] text-lg
                   drop-shadow-[2px_2px_0_#f5efe6]">
            RINGKASAN AKTIVITAS
        </h3>

        <div class="grid md:grid-cols-3 gap-8 mt-12 text-xs">

            <!-- TOTAL BUKU -->
            <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10]">
                <h4 class="text-[#8b5e34] mb-3">📚 TOTAL BUKU</h4>
                <p class="text-[#2d1b10] text-lg">
                    {{ $totalBuku }}
                </p>
            </div>

            <!-- FAVORIT -->
            <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10]">
                <h4 class="text-[#a47148] mb-3">❤️ FAVORIT</h4>
                <p class="text-[#2d1b10] text-lg">
                    {{ $totalFavorit }}
                </p>
            </div>

            <!-- RIWAYAT -->
            <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10]">
                <h4 class="text-[#6f4e37] mb-3">⏱ RIWAYAT BACA</h4>
                <p class="text-[#2d1b10] text-lg">
                    {{ $totalRiwayat }}
                </p>
            </div>

        </div>
    </div>
</section>


<!-- FOOTER -->
<footer class="bg-[#8b5e34] py-6 border-t-4 border-[#5c4033]
               shadow-[0_-6px_0_#2d1b10]">
    <div class="text-center text-xs text-[#f5efe6]
                drop-shadow-[1px_1px_0_#2d1b10]">
        © 2026 Pixel Library. All rights reserved.
    </div>
</footer>

</body>
</html>