<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | Cafe Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<body class="min-h-screen flex items-center justify-center 
             bg-[#f3ede7] text-[#3b2f2f] px-4">

<div class="w-full max-w-md 
            bg-[#e6dccf]
            border-4 border-[#6f4e37]
            shadow-[6px_6px_0_#3b2f2f]
            p-8 text-xs rounded-sm">

    <!-- JUDUL -->
    <h2 class="text-[#6f4e37] text-center mb-6
               drop-shadow-[1px_1px_0_#fff]">
        LUPA PASSWORD
    </h2>

    <!-- DESKRIPSI -->
    <p class="text-[#5a4634] mb-4 leading-relaxed">
        Masukkan email akun kamu.
        Kami akan kirim link untuk reset password.
    </p>

    <!-- STATUS -->
    @if (session('status'))
        <div class="mb-4 text-[#8b5e3c]">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="text-[#6f4e37]">Email</label>
            <input type="email" name="email" required autofocus
                   class="mt-2 w-full px-3 py-2
                          bg-[#fdf8f3]
                          border-4 border-[#6f4e37]
                          text-[#3b2f2f]
                          focus:outline-none">
            @error('email')
                <div class="mt-2 text-[#b23a48]">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="mt-6">
            <button type="submit"
                class="w-full px-4 py-3
                       bg-[#6f4e37] text-[#fdf8f3]
                       border-4 border-[#3b2f2f]
                       shadow-[4px_4px_0_#3b2f2f]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                KIRIM LINK RESET
            </button>
        </div>

        <!-- BACK -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}"
               class="text-[#8b5e3c] hover:text-[#3b2f2f]">
                Kembali ke Login
            </a>
        </div>
    </form>
</div>

</body>
</html>
