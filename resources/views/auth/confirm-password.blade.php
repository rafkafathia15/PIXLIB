<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Password | Pixel Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Press Start 2P', monospace; image-rendering: pixelated; }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#0b0d14] text-[#e6e1d5] px-4">

<div class="w-full max-w-md bg-[#120a1f] border-4 border-black shadow-[6px_6px_0_#000] p-8 text-xs">

    <h2 class="text-[#ffd166] text-center mb-6">
        KONFIRMASI PASSWORD
    </h2>

    <p class="text-gray-400 mb-4">
        Masukkan password untuk melanjutkan.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-6">
            <label class="text-[#ffd166]">Password</label>
            <input type="password" name="password" required
                   class="mt-2 w-full px-3 py-2 bg-[#0b0d14] border-4 border-black text-[#e6e1d5]">
            @error('password') <div class="mt-2 text-[#ff4d6d]">{{ $message }}</div> @enderror
        </div>

        <button class="w-full px-4 py-3 bg-[#ff4d6d] text-black border-4 border-black
                       shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
            KONFIRMASI
        </button>
    </form>
</div>

</body>
</html>
