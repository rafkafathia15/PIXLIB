<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Library</title>

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
            <a href="#" class="hover:text-[#8b5e34]">BERANDA</a>
            <a href="{{ route('koleksi.buku') }}" class="hover:text-[#8b5e34]">KOLEKSI</a>
            <a href="{{ route('tentang') }}" class="hover:text-[#8b5e34]">TENTANG</a>
            <a href="{{ route('login') }}" class="text-[#6f4e37] hover:text-black">
                LOGIN
            </a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
    <div>
        <h2 class="text-xl md:text-2xl leading-relaxed text-[#6f4e37]
                   drop-shadow-[3px_3px_0_#f5efe6]">
            PERPUSTAKAAN DIGITAL
        </h2>

        <p class="mt-6 text-xs text-[#5c4033] leading-relaxed">
            Perpustakaan digital bernuansa cafe.
            Creamy, hangat, dan nyaman untuk membaca lama.
        </p>

        <div class="mt-8 flex space-x-4">
            <button onclick="openLoginPopup()"
                class="px-6 py-3 bg-[#b08968] text-[#2d1b10]
                       border-4 border-[#2d1b10]
                       shadow-[4px_4px_0_#2d1b10]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                MULAI
            </button>

            <button onclick="openLoginPopup()"
                class="px-6 py-3 bg-[#c8ad8d] text-[#2d1b10]
                       border-4 border-[#2d1b10]
                       shadow-[4px_4px_0_#2d1b10]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                KOLEKSI
            </button>
        </div>
    </div>

    <div class="flex justify-center">
        <img src="{{ asset('asset/pulang.png') }}"
             alt="Books"
             class="w-64 drop-shadow-[0_0_18px_#b08968]">
    </div>
</section>

<!-- FEATURES -->
<section class="bg-[#d6c4ae] py-16 border-t-4 border-[#b08968]">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-center text-[#6f4e37] text-lg
                   drop-shadow-[2px_2px_0_#f5efe6]">
            FITUR UTAMA
        </h3>

        <div class="grid md:grid-cols-3 gap-8 mt-12 text-xs">

            <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10] hover:bg-[#ede3d7] transition">
                <h4 class="text-[#8b5e34] mb-3">KOLEKSI DIGITAL</h4>
                <p class="text-[#5c4033]">
                    Koleksi bacaan dengan nuansa coffee shop.
                </p>
            </div>

            <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10] hover:bg-[#ede3d7] transition">
                <h4 class="text-[#a47148] mb-3">PENCARIAN</h4>
                <p class="text-[#5c4033]">
                    Cari buku tanpa silau di mata.
                </p>
            </div>

            <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                        shadow-[6px_6px_0_#2d1b10] hover:bg-[#ede3d7] transition">
                <h4 class="text-[#6f4e37] mb-3">AKSES ONLINE</h4>
                <p class="text-[#5c4033]">
                    Akses fleksibel, nyaman seperti cafe.
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

<!-- LOGIN POPUP -->
<div id="loginPopup"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-[#e6dccf] border-4 border-[#2d1b10]
                shadow-[6px_6px_0_#2d1b10]
                p-6 w-[90%] max-w-md text-center">

        <h3 class="text-[#6f4e37] text-sm mb-4
                   drop-shadow-[2px_2px_0_#f5efe6]">
            PERINGATAN
        </h3>

        <p class="text-xs text-[#5c4033] leading-relaxed mb-6">
            Harap <b>login terlebih dahulu</b><br>
            untuk pengalaman membaca yang lebih baik ☕📚
        </p>

        <div class="flex justify-center space-x-4">
            <button onclick="closeLoginPopup()"
                class="px-4 py-2 bg-[#cbb49a]
                       border-4 border-[#2d1b10]
                       shadow-[3px_3px_0_#2d1b10]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                NANTI
            </button>

            <a href="{{ route('login') }}"
               class="px-4 py-2 bg-[#b08968]
                      border-4 border-[#2d1b10]
                      shadow-[3px_3px_0_#2d1b10]
                      hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition">
                LOGIN
            </a>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function openLoginPopup() {
        document.getElementById('loginPopup').classList.remove('hidden');
        document.getElementById('loginPopup').classList.add('flex');
    }

    function closeLoginPopup() {
        document.getElementById('loginPopup').classList.add('hidden');
        document.getElementById('loginPopup').classList.remove('flex');
    }
</script>

</body>
</html>
