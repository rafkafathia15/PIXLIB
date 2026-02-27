<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang | Pixel Library</title>

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
<nav class="bg-[#d6c4ae] border-b-4 border-[#b08968] shadow-[0_6px_0_#000]">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-[#8b5e34] text-lg drop-shadow-[2px_2px_0_#f5efe6]">
            PIXLIB
        </h1>
        <div class="space-x-6 text-xs">
            <a href="/" class="hover:text-[#8b5e34]">BERANDA</a>
            <a href="#" class="hover:text-[#8b5e34]">KOLEKSI</a>
            <a href="/tentang" class="text-[#6f4e37] underline">TENTANG</a>
            <a href="{{ route('login') }}" class="text-[#6f4e37] hover:text-black">
                LOGIN
            </a>
        </div>
    </div>
</nav>

<!-- HEADER -->
<section class="max-w-7xl mx-auto px-6 py-20 text-center">
    <h2 class="text-xl md:text-2xl text-[#6f4e37]
               drop-shadow-[3px_3px_0_#f5efe6] mb-6">
        TENTANG PIXEL LIBRARY
    </h2>

    <p class="text-xs text-[#5c4033] max-w-3xl mx-auto leading-relaxed">
        Pixel Library adalah perpustakaan digital dengan nuansa cafe retro pixel.
        Dirancang agar membaca terasa hangat, santai, dan nyaman seperti duduk
        di coffee shop favoritmu ☕📚
    </p>
</section>

<!-- CONTENT -->
<section class="bg-[#d6c4ae] py-16 border-t-4 border-[#b08968]">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8 text-xs">

        <!-- VISI -->
        <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10] hover:bg-[#ede3d7] transition">
            <h3 class="text-[#8b5e34] mb-4">VISI</h3>
            <p class="text-[#5c4033] leading-relaxed">
                Menjadi ruang baca digital yang nyaman,
                ramah mata, dan menyenangkan untuk semua kalangan.
            </p>
        </div>

        <!-- MISI -->
        <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10] hover:bg-[#ede3d7] transition">
            <h3 class="text-[#a47148] mb-4">MISI</h3>
            <ul class="space-y-2 text-[#5c4033]">
                <li>☕ Menyediakan akses bacaan digital</li>
                <li>📖 Desain nyaman untuk membaca lama</li>
                <li>🎮 Nuansa pixel retro yang unik</li>
            </ul>
        </div>

        <!-- KONSEP -->
        <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10] hover:bg-[#ede3d7] transition">
            <h3 class="text-[#6f4e37] mb-4">KONSEP</h3>
            <p class="text-[#5c4033] leading-relaxed">
                Menggabungkan estetika pixel art retro
                dengan suasana cafe creamy agar membaca
                terasa lebih santai dan fokus.
            </p>
        </div>

    </div>
</section>

<!-- TEAM -->
<section class="max-w-7xl mx-auto px-6 py-20 text-center">
    <h3 class="text-lg text-[#6f4e37]
               drop-shadow-[2px_2px_0_#f5efe6] mb-10">
        DIBUAT OLEH
    </h3>

    <div class="grid md:grid-cols-3 gap-8 text-xs">

        <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10]">
            <p class="text-[#8b5e34] mb-2">👤 Developer</p>
            <p class="text-[#5c4033]">Rafka Fathia Sena Wijaya</p>
        </div>

        <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10]">
            <p class="text-[#8b5e34] mb-2">🎨 Designer</p>
            <p class="text-[#5c4033]">Rafka Fathia Sena Wijaya</p>
        </div>

        <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10]">
            <p class="text-[#8b5e34] mb-2">☕ Konsep</p>
            <p class="text-[#5c4033]">Cafe Reading Space</p>
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
