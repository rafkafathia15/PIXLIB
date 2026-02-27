<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email | Pixel Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Press Start 2P', monospace; image-rendering: pixelated; }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#0b0d14] text-[#e6e1d5] px-4">

<div class="w-full max-w-md bg-[#120a1f] border-4 border-black shadow-[6px_6px_0_#000] p-8 text-xs">

    <h2 class="text-[#ffd166] text-center mb-6">
        VERIFIKASI EMAIL
    </h2>

    <p class="text-gray-400 mb-4 leading-relaxed">
        Silakan periksa email kamu dan klik tautan verifikasi
        sebelum melanjutkan.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 text-[#c77dff]">
            Link verifikasi baru telah dikirim.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="w-full mb-4 px-4 py-3 bg-[#c77dff] text-black border-4 border-black
                       shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
            KIRIM ULANG EMAIL
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="w-full px-4 py-3 bg-[#ff4d6d] text-black border-4 border-black
                       shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
            LOGOUT
        </button>
    </form>

</div>

</body>
</html>
