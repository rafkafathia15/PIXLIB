<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman | Pixel Library</title>

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
<header class="bg-[#d6c4ae] border-b-4 border-[#b08968] shadow-[0_6px_0_#2d1b10]">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('buku.detail', $buku->id) }}"
           class="px-4 py-2 text-xs bg-[#b08968] border-4 border-[#2d1b10]
                  shadow-[3px_3px_0_#2d1b10]
                  hover:translate-x-1 hover:translate-y-1">
            BACK
        </a>
        <h1 class="text-sm text-[#8b5e34]">FORM PEMINJAMAN</h1>
    </div>
</header>

<main class="flex-grow flex items-start justify-center px-6 py-16">

<div class="w-full max-w-7xl grid md:grid-cols-3 gap-8 bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[8px_8px_0_#2d1b10] p-8 text-xs">

    <!-- KIRI: COVER BUKU -->
    <div class="flex flex-col items-center text-center space-y-4 border-r-4 border-[#2d1b10] pr-6">
        <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://i.imgur.com/7QZ6FQy.png' }}"
             class="w-40 aspect-[3/4] border-4 border-[#2d1b10] object-cover shadow-[4px_4px_0_#2d1b10]">
        <div class="space-y-2">
            <div>
                <p class="text-[#8b5e34]">Judul</p>
                <p>{{ $buku->judul }}</p>
            </div>
            <div>
                <p class="text-[#8b5e34]">Penulis</p>
                <p>{{ $buku->penulis }}</p>
            </div>
            <div>
                <p class="text-[#8b5e34]">Stok</p>
                <p>{{ $buku->stok }}</p>
            </div>
        </div>
    </div>

    <!-- TENGAH: FORM PEMINJAMAN -->
    <div class="space-y-6">
        @if(session('error'))
            <div class="bg-red-200 border-4 border-[#2d1b10] p-3">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pinjam.store', $buku->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <p class="text-[#8b5e34] mb-2">Nama Peminjam</p>
                <input type="text" name="nama"
                    class="w-full bg-[#f5efe6] border-4 border-[#2d1b10] p-3" required>
            </div>

            <div>
                <p class="text-[#8b5e34] mb-2">Email</p>
                <input type="email" name="email"
                    class="w-full bg-[#f5efe6] border-4 border-[#2d1b10] p-3" required>
            </div>

            <div>
                <p class="text-[#8b5e34] mb-2">Nomor Telepon</p>
                <input type="text" name="nomor_telepon"
                    class="w-full bg-[#f5efe6] border-4 border-[#2d1b10] p-3" required>
            </div>

            <div>
                <p class="text-[#8b5e34] mb-2">Alamat</p>
                <textarea name="alamat" rows="3"
                    class="w-full bg-[#f5efe6] border-4 border-[#2d1b10] p-3" required></textarea>
            </div>

            <div>
                <p class="text-[#8b5e34] mb-2">Tanggal Pinjam</p>
                <input type="date" name="tanggal_pinjam"
                    value="{{ now()->format('Y-m-d') }}" readonly
                    class="w-full bg-[#f5efe6] border-4 border-[#2d1b10] p-3">
            </div>

            <div>
                <p class="text-[#8b5e34] mb-2">Tanggal Kembali (Minimal 14 Hari)</p>
                <input type="date" name="tanggal_kembali"
                    min="{{ now()->addDays(14)->format('Y-m-d') }}" required
                    class="w-full bg-[#f5efe6] border-4 border-[#2d1b10] p-3">
            </div>

            <input type="hidden" name="status" value="Dipinjam">

            <div class="flex justify-between pt-6">
                <a href="{{ route('buku.detail', $buku->id) }}"
                   class="px-6 py-3 bg-gray-400 border-4 border-[#2d1b10] shadow-[3px_3px_0_#2d1b10] hover:translate-x-1 hover:translate-y-1">
                    BATAL
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-[#b08968] border-4 border-[#2d1b10] shadow-[3px_3px_0_#2d1b10] hover:translate-x-1 hover:translate-y-1 active:shadow-none">
                    📚 KONFIRMASI PINJAM
                </button>
            </div>
        </form>
    </div>

    <!-- KANAN: ATURAN -->
    <div class="bg-[#f5efe6] border-4 border-[#2d1b10] shadow-[4px_4px_0_#2d1b10] p-6 text-xs max-h-[80vh] overflow-y-auto">
        <h2 class="text-[#8b5e34] text-sm font-bold mb-3">Informasi dan Aturan</h2>
        <p class="mb-3">
            Setiap peminjam WAJIB menjaga buku yang dipinjam dan DILARANG:
            <br>❌ Menghilangkan buku
            <br>❌ Merusak buku, termasuk namun tidak terbatas pada:
            <ul class="list-disc list-inside ml-4">
                <li>Sobek</li>
                <li>Basah</li>
                <li>Coretan</li>
                <li>Sampul rusak</li>
                <li>Halaman hilang</li>
            </ul>
            ❌ Menjual, menyewakan, menggadaikan, atau mengalihkan kepemilikan buku kepada pihak lain dalam bentuk apa pun
        </p>

        <p class="mb-3">
            <strong>2️. Tanggung Jawab Peminjam</strong>
            <br>Buku yang dipinjam sepenuhnya menjadi tanggung jawab peminjam. Kerusakan atau kehilangan baik disengaja maupun tidak disengaja tetap menjadi tanggung jawab peminjam.
        </p>

        <p class="mb-3">
            <strong>3️. Sanksi Pelanggaran</strong>
            <br>Jika terjadi pelanggaran, maka peminjam WAJIB:
            <br>🔁 Mengganti buku dengan judul dan edisi yang sama ATAU 💰 Membayar denda sesuai harga buku + biaya administrasi
            <br>Tambahan sanksi:
            <ul class="list-disc list-inside ml-4">
                <li>Hak peminjaman dibekukan sementara</li>
                <li>Akun dapat dinonaktifkan jika pelanggaran berulang</li>
            </ul>
        </p>

        <p class="mb-3">
            <strong>4️. Ketentuan Khusus</strong>
            <br>Buku yang telah dijual atau dialihkan dianggap hilang
            <br>Buku yang dikembalikan dalam kondisi rusak tidak dapat dipinjam ulang
            <br>Keputusan akhir berada pada pihak perpustakaan
        </p>

        <p>
            <strong>5️. Pernyataan Persetujuan</strong>
            <br>Dengan melakukan peminjaman, peminjam dianggap telah membaca, memahami, dan menyetujui seluruh peraturan perpustakaan.
        </p>
    </div>

</div>



<!-- POPUP SUCCESS DENGAN BUKTI PEMINJAMAN -->
@if(session('success'))
<div id="popupSuccess"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-[#e6dccf] border-4 border-[#2d1b10]
                shadow-[8px_8px_0_#2d1b10]
                p-6 text-xs text-center max-w-sm">

        <p class="text-[#8b5e34] mb-4 text-sm font-bold">📚 PINJAMAN BERHASIL 💛</p>

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
            <button onclick="closePopup()"
                class="px-4 py-2 bg-[#b08968] border-4 border-[#2d1b10]
                       shadow-[3px_3px_0_#2d1b10] hover:translate-x-1 hover:translate-y-1">
                TUTUP
            </button>

            <form action="{{ route('pinjam.cetak', session('success')['id']) }}" method="POST" target="_blank">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-[#8b5e34] border-4 border-[#2d1b10]
                           shadow-[3px_3px_0_#2d1b10] hover:translate-x-1 hover:translate-y-1">
                    CETAK BUKTI
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function closePopup() {
    document.getElementById('popupSuccess').style.display = 'none';
}
</script>
@endif

</body>
</html>