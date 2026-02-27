@extends('admin.layoutadm')

@section('title', 'Data Ulasan')

@section('content')

<div class="p-6 bg-[#f3ede7] min-h-screen">

    <!-- JUDUL -->
    <h1 class="text-2xl font-bold text-[#6f4e37] mb-2">
        Ulasan Dan Rating
    </h1>
    <p class="text-sm text-[#6f4e37] mb-6">
        "Lihat data ulasan & rating buku perpustakaan digital secara terstruktur dan aman."
    </p>

    <!-- GRID BUKU -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">

        @foreach($bukus as $buku)
        <div class="bg-[#d6c4ae] 
                    border-4 border-[#2d1b10] 
                    shadow-[6px_6px_0_#2d1b10] 
                    p-4 text-center">

            <!-- GAMBAR -->
            <img src="{{ asset('storage/'.$buku->gambar) }}"
                 class="w-full h-64 object-cover border-4 border-[#2d1b10] mb-3">

            <!-- JUDUL -->
            <p class="text-xs font-bold mb-2">
                {{ $buku->judul }}
            </p>

            <!-- BUTTON -->
            <button 
                onclick="openModal(
                    '{{ $buku->judul }}',
                    '{{ asset('storage/'.$buku->gambar) }}',
                    `{!! 
                        $buku->ulasan->count() 
                        ? $buku->ulasan->map(function($u){
                            return "
                            <div class='mb-4 border-b pb-2'>
                                <p class='font-bold'>{$u->user->name}</p>
                                <p class='text-yellow-600'>⭐ {$u->rating}</p>
                                <p class='text-sm'>{$u->komentar}</p>
                            </div>";
                        })->implode('')
                        : "<p>Belum ada ulasan 😢</p>"
                    !!}`
                )"
                class="mt-2 px-3 py-1 bg-[#b08968] border-2 border-[#2d1b10] hover:bg-[#a47148] text-xs">
                Lihat Ulasan
            </button>

        </div>
        @endforeach

    </div>

</div>


<!-- ================= MODAL ================= -->
<div id="ulasanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-[#f5efe6] border-4 border-[#2d1b10] p-6 w-full max-w-4xl shadow-[6px_6px_0_#2d1b10] relative">

        <!-- CLOSE -->
        <button onclick="closeModal()" 
            class="absolute top-2 right-3 text-xl font-bold">
            ✖
        </button>

        <div class="grid grid-cols-2 gap-6">

            <!-- COVER -->
            <div>
                <img id="modalCover" src="" 
                     class="w-64 border-4 border-[#2d1b10]">
            </div>

            <!-- ULASAN -->
            <div>
                <h2 id="modalJudul" class="text-xl font-bold mb-4 text-[#6f4e37]"></h2>

                <div id="modalUlasan" 
                     class="bg-[#d6c4ae] p-4 border-2 border-[#2d1b10] max-h-80 overflow-y-auto">
                </div>

                <button onclick="closeModal()" 
                    class="mt-6 px-6 py-2 bg-[#b08968] border-2 border-[#2d1b10] hover:bg-[#a47148]">
                    Tutup
                </button>
            </div>

        </div>

    </div>
</div>


<script>
function openModal(judul, gambar, ulasanHTML) {
    document.getElementById('modalJudul').innerText = judul;
    document.getElementById('modalCover').src = gambar;
    document.getElementById('modalUlasan').innerHTML = ulasanHTML;

    document.getElementById('ulasanModal').classList.remove('hidden');
    document.getElementById('ulasanModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('ulasanModal').classList.add('hidden');
    document.getElementById('ulasanModal').classList.remove('flex');
}
</script>

@endsection