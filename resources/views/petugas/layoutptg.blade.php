<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Petugas Panel | Pixel Library')</title>
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

<body class="bg-[#e6dccf] text-[#2d1b10] text-xs">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('petugas.sidebarptg')

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">

        <div class="bg-[#f5efe6]
                    border-4 border-[#2d1b10]
                    shadow-[6px_6px_0_#2d1b10]
                    p-6 min-h-screen">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>