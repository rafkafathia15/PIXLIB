<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Pixel Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Pixel Font -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Press Start 2P', monospace;
            image-rendering: pixelated;
        }
    </style>
</head>

<body class="min-h-screen bg-[#e6dccf] flex items-center justify-center text-[#3f2a1d]">

<div class="w-full max-w-4xl bg-[#d6c4ae] border-4 border-[#2d1b10]
            shadow-[8px_8px_0_#2d1b10] grid md:grid-cols-2">

    <!-- LEFT -->
    <div class="hidden md:flex flex-col justify-center p-10 bg-[#cbb49a]
                border-r-4 border-[#2d1b10]">
        <h1 class="text-lg text-[#8b5e34] mb-6 drop-shadow-[2px_2px_0_#f5efe6]">
            PIXLIB
        </h1>
        <p class="text-xs text-[#5c4033] leading-relaxed mb-8">
            Pendaftaran akun untuk mengakses
            perpustakaan digital bernuansa cafe.
        </p>
        <img src="{{ asset('asset/pulang.png') }}"
             alt="Pixel Books"
             class="w-48 mx-auto drop-shadow-[0_0_14px_#b08968]">
    </div>

    <!-- RIGHT -->
    <div class="p-8 md:p-10">
        <h2 class="text-lg text-[#6f4e37] mb-2 drop-shadow-[2px_2px_0_#f5efe6]">
            Registrasi Akun
        </h2>
        <p class="text-xs text-[#5c4033] mb-6">
            Silakan lengkapi data berikut
        </p>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="mb-4 text-xs text-red-700 bg-[#e6dccf]
                        p-3 border-2 border-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAME -->
            <div class="mb-4">
                <label class="block text-xs mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- USERNAME -->
            <div class="mb-4">
                <label class="block text-xs mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-xs mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="block text-xs mb-2">Password</label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-6">
                <label class="block text-xs mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full py-3 bg-[#b08968] text-[#2d1b10] text-xs
                           border-4 border-[#2d1b10]
                           shadow-[4px_4px_0_#2d1b10]
                           hover:translate-x-1 hover:translate-y-1
                           hover:shadow-none transition">
                DAFTAR
            </button>
        </form>

        <!-- LOGIN LINK -->
        <p class="mt-6 text-center text-xs text-[#5c4033]">
            Sudah memiliki akun?
            <a href="{{ route('login') }}"
               class="text-[#6f4e37] hover:underline">
                Login
            </a>
        </p>
    </div>

</div>

</body>
</html>
