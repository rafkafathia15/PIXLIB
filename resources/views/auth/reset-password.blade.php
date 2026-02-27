<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Pixel Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Press Start 2P', monospace; image-rendering: pixelated; }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#0b0d14] text-[#e6e1d5] px-4">

<div class="w-full max-w-md bg-[#120a1f] border-4 border-black shadow-[6px_6px_0_#000] p-8 text-xs">

    <h2 class="text-[#ffd166] text-center mb-6 drop-shadow-[2px_2px_0_#000]">
        RESET PASSWORD
    </h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="text-[#ffd166]">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $request->email) }}" required
                   class="mt-2 w-full px-3 py-2 bg-[#0b0d14] border-4 border-black text-[#e6e1d5]">
            @error('email') <div class="mt-2 text-[#ff4d6d]">{{ $message }}</div> @enderror
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="text-[#ffd166]">Password Baru</label>
            <input type="password" name="password" required
                   class="mt-2 w-full px-3 py-2 bg-[#0b0d14] border-4 border-black text-[#e6e1d5]">
            @error('password') <div class="mt-2 text-[#ff4d6d]">{{ $message }}</div> @enderror
        </div>

        <!-- CONFIRM -->
        <div class="mb-6">
            <label class="text-[#ffd166]">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                   class="mt-2 w-full px-3 py-2 bg-[#0b0d14] border-4 border-black text-[#e6e1d5]">
        </div>

        <button class="w-full px-4 py-3 bg-[#ff4d6d] text-black border-4 border-black
                       shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
            RESET PASSWORD
        </button>
    </form>
</div>

</body>
</html>
