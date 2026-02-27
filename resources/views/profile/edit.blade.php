<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profile | Pixel Library</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Press Start 2P', monospace;
    image-rendering: pixelated;
}
</style>
</head>

<body class="bg-[#e6dccf] text-[#3f2a1d] min-h-screen flex flex-col">

<!-- HEADER -->
<header class="bg-[#d6c4ae] border-b-4 border-[#b08968]
              shadow-[0_6px_0_#2d1b10]">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

        <a href="{{ route('dashboard') }}"
           class="px-3 py-2 text-xs bg-[#e6dccf] text-[#6f4e37]
                  border-4 border-[#2d1b10]
                  shadow-[3px_3px_0_#2d1b10]
                  hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
            ◀ BACK
        </a>

        <h1 class="text-sm text-[#8b5e34]">
            PROFILE
        </h1>
    </div>
</header>

<!-- CONTENT -->
<main class="flex-1 max-w-6xl mx-auto px-6 py-12">

<div class="grid md:grid-cols-3 gap-8">

    <!-- PROFILE CARD -->
    <div class="bg-[#e6dccf] border-4 border-[#2d1b10]
               shadow-[6px_6px_0_#2d1b10] p-6 text-center">

        <div class="flex justify-center mb-4">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=b08968&color=2d1b10"
                 class="w-24 h-24 rounded-full border-4 border-[#2d1b10]">
        </div>

        <h2 class="text-[#6f4e37] text-xs mb-2">
            {{ auth()->user()->name }}
        </h2>

        <p class="text-[10px] text-[#8b5e34] mb-4">
            {{ auth()->user()->email }}
        </p>

        <div class="text-[10px] text-[#6f4e37] border-t-4 border-[#2d1b10] pt-4">
            MEMBER SINCE <br>
            {{ auth()->user()->created_at->format('d M Y') }}
        </div>
    </div>

    <!-- RIGHT SETTINGS -->
    <div class="md:col-span-2 space-y-8">

        <!-- PROFILE INFO -->
        <section class="bg-[#e6dccf] border-4 border-[#2d1b10]
                       shadow-[6px_6px_0_#2d1b10] p-6 text-xs">
            <h2 class="text-[#6f4e37] mb-4">PROFILE INFO</h2>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <input type="text" name="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           class="w-full px-4 py-3 bg-[#f5efe6]
                                  border-4 border-[#2d1b10]">

                    <input type="email" name="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="w-full px-4 py-3 bg-[#f5efe6]
                                  border-4 border-[#2d1b10]">

                    <button type="submit"
                            class="px-5 py-3 bg-[#b08968]
                                   border-4 border-[#2d1b10]
                                   shadow-[4px_4px_0_#2d1b10]
                                   hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
                        SAVE
                    </button>
                </div>
            </form>
        </section>

        <!-- UPDATE PASSWORD -->
        <section class="bg-[#e6dccf] border-4 border-[#2d1b10]
                       shadow-[6px_6px_0_#2d1b10] p-6 text-xs">
            <h2 class="text-[#6f4e37] mb-4">UPDATE PASSWORD</h2>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <input type="password" name="current_password"
                           placeholder="CURRENT PASSWORD"
                           class="w-full px-4 py-3 bg-[#f5efe6]
                                  border-4 border-[#2d1b10]">

                    <input type="password" name="password"
                           placeholder="NEW PASSWORD"
                           class="w-full px-4 py-3 bg-[#f5efe6]
                                  border-4 border-[#2d1b10]">

                    <input type="password" name="password_confirmation"
                           placeholder="CONFIRM PASSWORD"
                           class="w-full px-4 py-3 bg-[#f5efe6]
                                  border-4 border-[#2d1b10]">

                    <button type="submit"
                            class="px-5 py-3 bg-[#cbb49a]
                                   border-4 border-[#2d1b10]
                                   shadow-[4px_4px_0_#2d1b10]
                                   hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
                        UPDATE
                    </button>
                </div>
            </form>
        </section>

        <!-- LOGOUT SECTION -->
        <section class="bg-[#e6dccf] border-4 border-[#2d1b10]
                       shadow-[6px_6px_0_#2d1b10] p-6 text-xs text-center">
            <button onclick="openLogoutModal()"
                class="px-5 py-3 bg-[#a47148]
                       border-4 border-[#2d1b10]
                       shadow-[4px_4px_0_#2d1b10]
                       hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition">
                LOGOUT
            </button>
        </section>

    </div>
</div>

</main>

<!-- FOOTER -->
<footer class="bg-[#8b5e34] py-6 border-t-4 border-[#5c4033]
               shadow-[0_-6px_0_#2d1b10]">
    <div class="text-center text-[10px] text-[#f5efe6]
                drop-shadow-[1px_1px_0_#2d1b10]">
        © 2026 Pixel Library. All rights reserved.
    </div>
</footer>

<!-- LOGOUT MODAL -->
<div id="logoutModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-[#e6dccf] p-6 border-4 border-[#2d1b10]
                shadow-[6px_6px_0_#2d1b10]
                text-center w-[280px]">

        <p class="text-[#6f4e37] mb-6 text-xs">
            YAKIN LOGOUT?
        </p>

        <div class="flex justify-center gap-4">

            <button onclick="closeLogoutModal()"
                class="px-4 py-2 bg-[#cbb49a]
                       border-4 border-[#2d1b10]
                       shadow-[3px_3px_0_#2d1b10]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                NO
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-[#b08968]
                           border-4 border-[#2d1b10]
                           shadow-[3px_3px_0_#2d1b10]
                           hover:translate-x-1 hover:translate-y-1
                           hover:shadow-none transition">
                    YES
                </button>
            </form>

        </div>
    </div>
</div>

<script>
function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden')
    document.getElementById('logoutModal').classList.add('flex')
}

function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden')
    document.getElementById('logoutModal').classList.remove('flex')
}
</script>

</body>
</html>
