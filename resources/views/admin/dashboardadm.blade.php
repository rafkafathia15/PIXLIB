@extends('admin.layoutadm')

@section('title', 'Dashboard Admin')

@section('content')

<h1 class="text-[#6f4e37] text-lg mb-2
           drop-shadow-[2px_2px_0_#f5efe6]">
    DASHBOARD ADMIN
</h1>

<p class="text-sm text-[#8b5e34] mb-6">
    Ringkasan aktivitas sistem perpustakaan hari ini.
</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <!-- TOTAL USER -->
    <div class="bg-[#f5efe6]
                border-4 border-[#2d1b10]
                shadow-[6px_6px_0_#2d1b10]
                p-6 hover:translate-y-1 transition duration-200">
        <p class="text-[#6f4e37] mb-2">Total User</p>
        <p class="text-3xl font-bold text-[#8b5e34]">
            {{ $totalUser ?? 0 }}
        </p>
    </div>

    <!-- TOTAL BUKU -->
    <div class="bg-[#f5efe6]
                border-4 border-[#2d1b10]
                shadow-[6px_6px_0_#2d1b10]
                p-6 hover:translate-y-1 transition duration-200">
        <p class="text-[#6f4e37] mb-2">Total Buku</p>
        <p class="text-3xl font-bold text-[#a47148]">
            {{ $totalBuku ?? 0 }}
        </p>
    </div>

    <!-- PEMINJAMAN -->
    <div class="bg-[#f5efe6]
                border-4 border-[#2d1b10]
                shadow-[6px_6px_0_#2d1b10]
                p-6 hover:translate-y-1 transition duration-200">
        <p class="text-[#6f4e37] mb-2">Peminjaman Aktif</p>
        <p class="text-3xl font-bold text-[#6f4e37]">
            {{ $totalPinjam ?? 0 }}
        </p>
    </div>

</div>

<!-- TABEL PEMINJAM TERBARU -->
<div class="bg-[#f5efe6]
            border-4 border-[#2d1b10]
            shadow-[6px_6px_0_#2d1b10]
            p-6">

    <h2 class="text-[#6f4e37] mb-1">
        Data Peminjam Terbaru
    </h2>

    <p class="text-xs text-[#8b5e34] mb-4">
        Menampilkan daftar peminjaman buku terbaru yang tercatat dalam sistem.
    </p>

    <div class="overflow-x-auto">
        <table class="w-full text-sm border-2 border-[#2d1b10]">
            <thead class="bg-[#d6c4ae]">
                <tr>
                    <th class="border-2 border-[#2d1b10] p-2 text-left">No</th>
                    <th class="border-2 border-[#2d1b10] p-2 text-left">Nama</th>
                    <th class="border-2 border-[#2d1b10] p-2 text-left">Judul Buku</th>
                    <th class="border-2 border-[#2d1b10] p-2 text-left">Tanggal Pinjam</th>
                    <th class="border-2 border-[#2d1b10] p-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamTerbaru as $index => $pinjam)
                    <tr class="hover:bg-[#e6dccf]">
                        <td class="border-2 border-[#2d1b10] p-2">
                            {{ $index + 1 }}
                        </td>
                        <td class="border-2 border-[#2d1b10] p-2">
                            {{ $pinjam->user->name ?? '-' }}
                        </td>
                        <td class="border-2 border-[#2d1b10] p-2">
                            {{ $pinjam->buku->judul ?? '-' }}
                        </td>
                        <td class="border-2 border-[#2d1b10] p-2">
                            {{ $pinjam->tanggal_pinjam ?? '-' }}
                        </td>
                        <td class="border-2 border-[#2d1b10] p-2">
                            <span class="px-2 py-1 border-2 border-[#2d1b10] bg-[#d6c4ae]">
                                {{ $pinjam->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 border-2 border-[#2d1b10]">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection