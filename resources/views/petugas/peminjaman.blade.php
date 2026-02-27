@extends('petugas.layoutptg')

@section('title', 'Data Peminjaman')

@section('content')

<h1 class="text-2xl font-bold text-[#6f4e37] mb-6">
    Data Peminjaman Buku
</h1>

<div class="bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[6px_6px_0_#2d1b10] p-6 overflow-x-auto">

    <table class="w-full border-2 border-[#2d1b10] text-sm">
        <thead class="bg-[#d6c4ae]">
            <tr>
                <th class="border border-[#2d1b10] p-2">No</th>
                <th class="border border-[#2d1b10] p-2">Nama Peminjam</th>
                <th class="border border-[#2d1b10] p-2">Judul Buku</th>
                <th class="border border-[#2d1b10] p-2">Tanggal Pinjam</th>
                <th class="border border-[#2d1b10] p-2">Status</th>
                <th class="border border-[#2d1b10] p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $index => $item)
            <tr class="bg-[#f5efe6]">
                <td class="border border-[#2d1b10] p-2 text-center">{{ $index + 1 }}</td>
                <td class="border border-[#2d1b10] p-2">{{ $item->nama ?? '-' }}</td>
                <td class="border border-[#2d1b10] p-2">{{ $item->buku->judul ?? '-' }}</td>
                <td class="border border-[#2d1b10] p-2">{{ $item->tanggal_pinjam }}</td>
                <td class="border border-[#2d1b10] p-2 text-center">
                    @if($item->status == 'Dikembalikan')
                        <span class="px-2 py-1 bg-green-400 border-2 border-[#2d1b10]">{{ $item->status }}</span>
                    @elseif($item->status == 'Terlambat')
                        <span class="px-2 py-1 bg-red-400 border-2 border-[#2d1b10]">{{ $item->status }}</span>
                    @else
                        <span class="px-2 py-1 bg-yellow-300 border-2 border-[#2d1b10]">{{ $item->status }}</span>
                    @endif
                </td>
                <td class="border border-[#2d1b10] p-2 text-center">

                    @php
                        $detailItem = [
                            'id' => $item->id,
                            'nama' => $item->nama ?? '-',
                            'email' => $item->email ?? '-',
                            'nomor_telepon' => $item->nomor_telepon ?? '-',
                            'alamat' => $item->alamat ?? '-',
                            'tanggal_pinjam' => $item->tanggal_pinjam ?? '-',
                            'tanggal_kembali' => $item->tanggal_kembali ?? '-',
                            'status' => $item->status ?? 'Dipinjam',
                            'buku' => [
                                'judul' => $item->buku->judul ?? '-',
                                'gambar' => $item->buku->gambar ?? null
                            ]
                        ];
                    @endphp

                    <button 
                        class="px-3 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10] hover:opacity-80"
                        data-detail='@json($detailItem, JSON_HEX_APOS | JSON_HEX_QUOT)'
                        onclick="openDetailModal(this.dataset.detail)">
                        Detail
                    </button>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center p-4">Belum ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

<!-- MODAL DETAIL -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-[#f5efe6] border-4 border-[#2d1b10] p-6 w-full max-w-3xl shadow-[6px_6px_0_#2d1b10] flex flex-col md:flex-row gap-6">
        
        <!-- Cover Buku -->
        <div class="w-full md:w-1/3">
            <img id="coverBuku" src="/default-cover.png" alt="Cover Buku" class="w-full h-auto border-2 border-[#2d1b10] object-contain">
        </div>

        <!-- Detail -->
        <div class="w-full md:w-2/3 space-y-2 text-sm">
            <h2 class="text-lg font-bold text-[#6f4e37] mb-2">Detail Peminjaman</h2>

            <p><strong>ID:</strong> <span id="detailId"></span></p>
            <p><strong>Judul Buku:</strong> <span id="detailJudul"></span></p>
            <p><strong>Nama:</strong> <span id="detailNama"></span></p>
            <p><strong>Email:</strong> <span id="detailEmail"></span></p>
            <p><strong>Nomor Telepon:</strong> <span id="detailNomor"></span></p>
            <p><strong>Alamat:</strong> <span id="detailAlamat"></span></p>
            <p><strong>Tanggal Pinjam:</strong> <span id="detailPinjam"></span></p>
            <p><strong>Tanggal Kembali:</strong> <span id="detailKembali"></span></p>

            <form id="statusForm" method="POST" class="mt-2">
                @csrf
                @method('PUT')
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" id="statusSelect" class="w-full border-2 border-[#2d1b10] p-2 bg-[#e6dccf]">
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                    <option value="Terlambat">Terlambat</option>
                    <option value="Menunggu Validasi">Menunggu Validasi</option>
                </select>
                <div class="flex justify-end mt-3 gap-2">
                    <button type="button" onclick="closeDetailModal()" class="px-3 py-1 border-2 border-[#2d1b10]">Tutup</button>
                    <button type="submit" class="px-3 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10] hover:opacity-80">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openDetailModal(detail) {
    const item = JSON.parse(detail);
    const modal = document.getElementById('detailModal');
    const buku = item.buku || {};

    document.getElementById('coverBuku').src = buku.gambar
        ? `/storage/${buku.gambar}`
        : '/default-cover.png';

    document.getElementById('detailId').innerText = item.id || '-';
    document.getElementById('detailJudul').innerText = buku.judul || '-';
    document.getElementById('detailNama').innerText = item.nama || '-';
    document.getElementById('detailEmail').innerText = item.email || '-';
    document.getElementById('detailNomor').innerText = item.nomor_telepon || '-';
    document.getElementById('detailAlamat').innerText = item.alamat || '-';
    document.getElementById('detailPinjam').innerText = item.tanggal_pinjam || '-';
    document.getElementById('detailKembali').innerText = item.tanggal_kembali || '-';

    document.getElementById('statusSelect').value = item.status || 'Dipinjam';
    document.getElementById('statusForm').action = `/petugas/peminjaman/${item.id}`;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection
