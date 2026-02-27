<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Buku | Pixel Library</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Press Start 2P', monospace;
    image-rendering: pixelated;
    background-color: #e6dccf;
}

.ulasan-scroll {
    display: flex;
    gap: 1.5rem;
    overflow-x: auto;
    padding-bottom: 1rem;
}

.ulasan-scroll::-webkit-scrollbar {
    height: 8px;
}

.ulasan-scroll::-webkit-scrollbar-track {
    background: #d6c4ae;
}

.ulasan-scroll::-webkit-scrollbar-thumb {
    background: #b08968;
    border: 2px solid #2d1b10;
}

.pixel-box {
    background: #e6dccf;
    border: 4px solid #2d1b10;
    box-shadow: 6px 6px 0 #2d1b10;
}

.pixel-inner {
    background: #f5efe6;
    border: 4px solid #2d1b10;
}

.hover-card:hover {
    transform: translateY(-4px);
    transition: 0.2s ease;
}

.hover-btn:hover {
    transform: translate(2px,2px);
    transition: 0.1s ease;
}

/* Flash popup */
@keyframes slide-in {
    0% {opacity: 0; transform: translateY(-20px);}
    100% {opacity: 1; transform: translateY(0);}
}
.animate-slide-in {
    animation: slide-in 0.3s ease forwards;
}
</style>
</head>

<body class="min-h-screen flex flex-col text-[#3f2a1d]">

<!-- HEADER -->
<header class="bg-[#d6c4ae] border-b-4 border-[#b08968] shadow-[0_6px_0_#2d1b10]">
    <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">
        <a href="{{ route('koleksi.buku') }}"
        class="px-4 py-2 text-xs bg-[#b08968] border-4 border-[#2d1b10]
                shadow-[3px_3px_0_#2d1b10] hover-btn">
            BACK
        </a>

        <h1 class="text-sm text-[#8b5e34]">DETAIL</h1>
    </div>
</header>

<!-- DETAIL -->
<main class="max-w-6xl mx-auto px-6 py-16">

<div class="pixel-box p-10 flex flex-col md:flex-row gap-12">

    <!-- COVER -->
    <div class="flex-shrink-0 flex flex-col items-center gap-4">
        <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://i.imgur.com/7QZ6FQy.png' }}"
            class="w-56 aspect-[3/4] object-cover border-4 border-[#2d1b10]">
        <p class="text-xs text-[#6f4e37]">COVER BUKU</p>
    </div>

    <!-- INFO -->
    <div class="flex-1 flex flex-col gap-8">

        <div>
            <p class="text-xs mb-3 text-[#8b5e34]">JUDUL</p>
            <div class="pixel-inner p-4 text-xs">
                {{ $buku->judul }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-xs mb-3 text-[#8b5e34]">PENULIS</p>
                <div class="pixel-inner p-4 text-xs">
                    {{ $buku->penulis }}
                </div>
            </div>
            <div>
                <p class="text-xs mb-3 text-[#8b5e34]">TAHUN</p>
                <div class="pixel-inner p-4 text-xs">
                    {{ $buku->tahun_terbit }}
                </div>
            </div>
        </div>

        <div class="text-xs text-[#6f4e37]">
            ⭐ {{ $rataRating ? number_format($rataRating,1) : '0' }}
            ({{ $jumlahUlasan }} ULASAN)
        </div>

        <!-- BUTTON AREA -->
<div class="flex gap-4 items-center">

    <!-- TOMBOL MATA -->
    <button onclick="openModal()"
        class="px-4 py-3 bg-[#8b5e34] border-4 border-[#2d1b10]
        shadow-[3px_3px_0_#2d1b10] hover-btn flex items-center justify-center text-white">

        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="w-6 h-6">
            <path d="M12 4.5c-5 0-9.27 3.11-11 7.5 1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.75A5.25 5.25 0 1112 6.75a5.25 5.25 0 010 10.5z"/>
        </svg>

    </button>

    @auth
    <a href="{{ route('pinjam.create', $buku->id) }}"
    class="px-6 py-3 bg-[#b08968] border-4 border-[#2d1b10]
            shadow-[3px_3px_0_#2d1b10] text-xs hover-btn">
        PINJAM
    </a>

    <!-- TOMBOL FAVORIT -->
<button id="btnFavorit" data-buku="{{ $buku->id }}"
class="px-4 py-3 bg-[#c19a6b] border-4 border-[#2d1b10]
shadow-[3px_3px_0_#2d1b10] hover-btn text-xs flex items-center justify-center text-white">

<svg xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="currentColor"
    class="w-5 h-5 mr-1"
    id="iconFavorit">
    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
</svg>

Favorit
</button>

<!-- MODAL FLASH -->
<div id="flashFavorit" class="fixed top-10 right-10 bg-[#c19a6b] text-[#3f2a1d] px-6 py-4 border-4 border-[#2d1b10] shadow-[3px_3px_0_#2d1b10] hidden rounded-lg z-50">
    Buku berhasil ditambahkan ke favorit ❤️
</div>

    @else
    <a href="{{ route('login') }}"
    class="px-6 py-3 bg-red-400 border-4 border-[#2d1b10]
            shadow-[3px_3px_0_#2d1b10] text-xs hover-btn">
        LOGIN
    </a>
    @endauth

</div>


    </div>
</div>
</main>

<!-- ULASAN SECTION -->
<main class="max-w-6xl mx-auto px-6 pb-24">

<div class="pixel-box p-8">

<h2 class="text-sm text-[#6f4e37] mb-8">
    ULASAN PEMBACA
</h2>

<div class="grid md:grid-cols-2 gap-10">

    <!-- LIST ULASAN -->
    <div>
        <div class="ulasan-scroll">

        @forelse($buku->ulasan as $u)
        <div class="w-[260px] shrink-0 pixel-box p-5 hover-card flex flex-col min-h-[220px]">

            <div class="flex justify-between items-center mb-4 text-xs">
                <span>{{ $u->user->name ?? 'User' }}</span>
                <span class="text-yellow-600">⭐ {{ $u->rating }}/5</span>
            </div>

            <div class="pixel-inner p-4 text-xs flex-1 overflow-y-auto leading-relaxed">
                {{ $u->komentar }}
            </div>

        </div>
        @empty
        <p class="text-xs text-[#5c4033]">BELUM ADA ULASAN</p>
        @endforelse

        </div>
    </div>

    <!-- FORM ULASAN -->
    <div>
    @auth
        @if($sudahSelesaiPinjam && !$sudahPinjamUlasan)

        <div class="pixel-inner p-6">
            <form action="{{ route('ulasan.store', $buku->id) }}"
                method="POST"
                class="flex flex-col gap-4 text-xs">
                @csrf

                <p class="text-[#6f4e37]">BERI ULASAN</p>

                <select name="rating" required
                    class="pixel-inner p-2 border-4 border-[#2d1b10]">
                    <option value="">Pilih Rating</option>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                </select>

                <textarea name="komentar"
                    placeholder="Tulis ulasan..."
                    required
                    class="pixel-inner p-3 border-4 border-[#2d1b10] min-h-[120px]"></textarea>

                <button type="submit"
                    class="px-4 py-3 bg-[#b08968] border-4 border-[#2d1b10]
                    shadow-[3px_3px_0_#2d1b10] hover-btn">
                    KIRIM ULASAN
                </button>
            </form>
        </div>

        @elseif(!$sudahSelesaiPinjam)
            <p class="text-xs text-red-500">
                Harus menyelesaikan peminjaman dulu.
            </p>
        @elseif($sudahPinjamUlasan)
            <p class="text-xs text-green-600">
                Kamu sudah memberi ulasan.
            </p>
        @endif
    @endauth
    </div>

</div>

</div>
</main>

<!-- MODAL DETAIL -->
<div id="detailModal"
class="hidden fixed inset-0 bg-[#2d1b10]/70 flex items-center justify-center z-50 overflow-y-auto">

    <div class="bg-[#efe5d8] w-[900px] p-6 border-4 border-[#6f4e37]
                shadow-[8px_8px_0_#2d1b10] max-h-[90vh]">

        <h2 class="text-center font-bold text-[#2d1b10] mb-4 tracking-wide text-lg">
            Detail Buku
        </h2>

        <!-- TAB -->
        <div class="flex justify-center gap-4 mb-5 text-sm font-semibold">
            <button id="tabRincian"
                class="px-4 py-1 border-2 border-[#2d1b10] bg-[#6f4e37] text-white"
                onclick="showTab('rincian')">
                Rincian
            </button>

            <button id="tabSinopsis"
                class="px-4 py-1 border-2 border-[#2d1b10] bg-[#d8c8b0]"
                onclick="showTab('sinopsis')">
                Sinopsis
            </button>
        </div>

        <div class="grid grid-cols-12 gap-6 text-xs">

            <!-- COVER -->
            <div class="col-span-3 text-center">
                <div class="h-64 w-full mb-2 overflow-hidden border-2 border-[#2d1b10]
                            flex items-center justify-center bg-[#d8c8b0]">
                    <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://i.imgur.com/7QZ6FQy.png' }}"
                         class="h-full w-full object-cover">
                </div>
                <p class="text-[10px]">Cover Buku</p>
            </div>

            <!-- RINCIAN -->
            <div id="rincianContent"
                 class="col-span-9 transition-all duration-300 ease-out">

                <div class="grid grid-cols-2 gap-4 bg-[#d8c8b0]
                            p-4 border-2 border-[#2d1b10]">

                    <div>
                        <label>Judul Buku</label>
                        <div class="mt-1 p-2 border-2 border-[#2d1b10] bg-[#efe5d8]">
                            {{ $buku->judul }}
                        </div>
                    </div>

                    <div>
                        <label>Penulis</label>
                        <div class="mt-1 p-2 border-2 border-[#2d1b10] bg-[#efe5d8]">
                            {{ $buku->penulis }}
                        </div>
                    </div>

                    <div>
                        <label>Penerbit</label>
                        <div class="mt-1 p-2 border-2 border-[#2d1b10] bg-[#efe5d8]">
                            {{ $buku->penerbit ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label>Tahun Terbit</label>
                        <div class="mt-1 p-2 border-2 border-[#2d1b10] bg-[#efe5d8]">
                            {{ $buku->tahun_terbit ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label>Stok</label>
                        <div class="mt-1 p-2 border-2 border-[#2d1b10] bg-[#efe5d8]">
                            {{ $buku->stok }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- SINOPSIS -->
            <div id="sinopsisContent"
                 class="col-span-9 hidden opacity-0 translate-x-6
                        transition-all duration-300 ease-out">

                <div class="bg-[#d8c8b0] p-4 border-2 border-[#2d1b10]">
                    <label>Sinopsis</label>
                    <div class="mt-2 p-4 border-2 border-[#2d1b10] bg-[#efe5d8]
                                h-[300px] overflow-y-auto leading-relaxed">
                        {{ $buku->sinopsis ?? 'Sinopsis belum tersedia.' }}
                    </div>
                </div>

            </div>

        </div>

        <div class="flex justify-center mt-6">
            <button onclick="closeModal()"
                class="px-4 py-1 bg-[#d8c8b0] border-2 border-[#2d1b10]
                       shadow-[2px_2px_0_#2d1b10]">
                Tutup
            </button>
        </div>

    </div>
</div>




<script>
function openModal() {
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailModal').classList.add('flex');
    showRincian(); // default buka rincian
}

function closeModal() {
    document.getElementById('detailModal').classList.remove('flex');
    document.getElementById('detailModal').classList.add('hidden');
}

function showRincian() {
    document.getElementById('rincianContent').classList.remove('hidden');
    document.getElementById('detailContent').classList.add('hidden');

    document.getElementById('btnRincian').classList.add('bg-[#f5efe6]');
    document.getElementById('btnDetail').classList.remove('bg-[#f5efe6]');
}

function showDetail() {
    document.getElementById('rincianContent').classList.add('hidden');
    document.getElementById('detailContent').classList.remove('hidden');

    document.getElementById('btnDetail').classList.add('bg-[#f5efe6]');
    document.getElementById('btnRincian').classList.remove('bg-[#f5efe6]');
}

// FAVORIT + FLASH
document.getElementById('btnFavorit').addEventListener('click', function(){
    const bukuId = this.dataset.buku;
    const btn = this;
    const icon = document.getElementById('iconFavorit');
    const flash = document.getElementById('flashFavorit');

    fetch(`/buku/${bukuId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
    if(data.status === 'added'){
        // JADI FAVORIT → MERAH
        btn.classList.remove('bg-[#c19a6b]');
        btn.classList.add('bg-red-400');
        flash.textContent = 'Buku berhasil ditambahkan ke favorit ❤️';
    } else {
        // DIHAPUS → KEMBALI COKLAT
        btn.classList.remove('bg-red-400');
        btn.classList.add('bg-[#c19a6b]');
        flash.textContent = 'Buku dihapus dari favorit 💔';
    }

    flash.classList.remove('hidden');
    flash.classList.add('animate-slide-in');

    setTimeout(() => {
        flash.classList.add('hidden');
    }, 2000);
})
    .catch(err => {
        alert('Terjadi kesalahan! 😢');
        console.error(err);
    });
});
</script>

<script>
function showTab(type) {
    const rincian = document.getElementById('rincianContent');
    const sinopsis = document.getElementById('sinopsisContent');
    const tabR = document.getElementById('tabRincian');
    const tabS = document.getElementById('tabSinopsis');

    if (type === 'rincian') {

        tabR.classList.add('bg-[#6f4e37]', 'text-white');
        tabR.classList.remove('bg-[#d8c8b0]');
        tabS.classList.add('bg-[#d8c8b0]');
        tabS.classList.remove('bg-[#6f4e37]', 'text-white');

        sinopsis.classList.add('opacity-0','translate-x-6');
        setTimeout(() => {
            sinopsis.classList.add('hidden');
            rincian.classList.remove('hidden','opacity-0','translate-x-6');
        }, 200);

    } else {

        tabS.classList.add('bg-[#6f4e37]', 'text-white');
        tabS.classList.remove('bg-[#d8c8b0]');
        tabR.classList.add('bg-[#d8c8b0]');
        tabR.classList.remove('bg-[#6f4e37]', 'text-white');

        rincian.classList.add('opacity-0','translate-x-6');
        setTimeout(() => {
            rincian.classList.add('hidden');
            sinopsis.classList.remove('hidden','opacity-0','translate-x-6');
        }, 200);
    }
}
</script>

{{-- POPUP SUCCESS PINJAMAN TERBARU --}}
@if(session('success'))
<div id="popupPinjamDetail"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-[#efe5d8] border-4 border-[#2d1b10]
                shadow-[8px_8px_0_#2d1b10]
                p-6 text-xs text-center max-w-sm">

        <p class="text-[#6f4e37] mb-4 font-bold text-sm">📚 PEMINJAMAN BERHASIL 💛</p>

        <div class="text-left mb-4">
            <p><strong>Nama:</strong> {{ session('success')['nama'] }}</p>
            <p><strong>Email:</strong> {{ session('success')['email'] }}</p>
            <p><strong>Nomor Telepon:</strong> {{ session('success')['nomor_telepon'] }}</p>
            <p><strong>Alamat:</strong> {{ session('success')['alamat'] }}</p>
            <p><strong>Buku:</strong> {{ session('success')['judul_buku'] }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ session('success')['tanggal_pinjam'] }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ session('success')['tanggal_kembali'] }}</p>
            <p><strong>Status:</strong> {{ session('success')['status'] }}</p>
        </div>

        <div class="flex justify-between gap-3">
            <button onclick="closePopupDetail()"
                class="px-4 py-2 bg-[#b08968] border-4 border-[#2d1b10]
                       shadow-[3px_3px_0_#2d1b10] hover-btn">
                TUTUP
            </button>

            <!-- tombol CETAK BUKTI -->
<form action="{{ route('pinjam.cetak', session('success')['id']) }}" method="GET" target="_blank">
    <button type="submit"
        class="px-4 py-2 bg-[#8b5e34] border-4 border-[#2d1b10]
               shadow-[3px_3px_0_#2d1b10] hover-btn">
        CETAK BUKTI
    </button>
</form>
        </div>

    </div>
</div>

<script>
function closePopupDetail(){
    document.getElementById('popupPinjamDetail').style.display = 'none';
}
</script>
@endif



</body>
</html>
