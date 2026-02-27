<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Pixel Library</title>
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
        <h1 class="text-lg text-[#8b5e34] mb-6
                   drop-shadow-[2px_2px_0_#f5efe6]">
            PIXLIB
        </h1>
        <p class="text-xs text-[#5c4033] leading-relaxed mb-8">
            Sistem perpustakaan digital dengan nuansa cafe,
            nyaman untuk membaca lama.
        </p>
        <img src="{{ asset('asset/pulang.png') }}"
     alt="Pixel Books"
     class="w-48 mx-auto drop-shadow-[0_0_14px_#b08968]">

    </div>

    <!-- RIGHT -->
    <div class="p-8 md:p-10">
        <h2 class="text-lg text-[#6f4e37] mb-2
                   drop-shadow-[2px_2px_0_#f5efe6]">
            Login
        </h2>
        <p class="text-xs text-[#5c4033] mb-6">
            Silakan masuk untuk melanjutkan
        </p>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="mb-4 text-xs text-red-700 bg-[#e6dccf]
                        p-3 border-2 border-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf

            <!-- FAKE INPUT (ANTI AUTOFILL) -->
            <input type="text" name="fakeuser" style="display:none">
            <input type="password" name="fakepass" style="display:none">

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-xs mb-2">Email</label>
                <input type="email" name="email" required autofocus
                       autocomplete="off"
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="block text-xs mb-2">Password</label>
                <input type="password" name="password" required
                       autocomplete="new-password"
                       class="w-full px-3 py-2 bg-[#e6dccf]
                              border-2 border-[#2d1b10] text-xs
                              focus:outline-none focus:border-[#8b5e34]">
            </div>

            <!-- REMEMBER -->
            <div class="flex items-center justify-between mb-6 text-xs">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                           class="accent-[#8b5e34]">
                    Ingat saya
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-[#6f4e37] hover:underline">
                        Lupa password
                    </a>
                @endif
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full py-3 bg-[#b08968] text-[#2d1b10] text-xs
                           border-4 border-[#2d1b10]
                           shadow-[4px_4px_0_#2d1b10]
                           hover:translate-x-1 hover:translate-y-1
                           hover:shadow-none transition">
                MASUK
            </button>
        </form>

        <!-- REGISTER -->
        <p class="mt-6 text-center text-xs text-[#5c4033]">
            Belum memiliki akun?
            <a href="{{ route('register') }}"
               class="text-[#6f4e37] hover:underline">
                Daftar
            </a>
        </p>
    </div>

</div>

</body>
</html>
