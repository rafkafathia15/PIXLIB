@extends('admin.layoutadm')

@section('title', 'Data Riwayat Peminjaman')

@section('content')

<h1 class="text-2xl font-bold text-[#6f4e37] mb-6">
    Data Riwayat Peminjaman Buku
</h1>

<div class="bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[6px_6px_0_#2d1b10] p-6 overflow-x-auto">

    <table class="w-full border-2 border-[#2d1b10] text-sm">
        <thead class="bg-[#d6c4ae]">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama Peminjam</th>
                <th class="border p-2">Judul Buku</th>
                <th class="border p-2">Tanggal Pinjam</th>
                <th class="border p-2">Tanggal Kembali</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($peminjaman as $item)
                @if ($item->status === 'Dikembalikan')
                <tr class="bg-[#f5efe6]">
                    <td class="border p-2 text-center">{{ $no++ }}</td>
                    <td class="border p-2">{{ $item->nama }}</td>
                    <td class="border p-2">{{ $item->buku->judul ?? '-' }}</td>
                    <td class="border p-2">{{ $item->tanggal_pinjam }}</td>
                    <td class="border p-2">{{ $item->tanggal_kembali }}</td>
                    <td class="border p-2 text-center">
                        <span class="px-2 py-1 bg-green-400 border-2 border-[#2d1b10] text-white">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="border p-2 text-center space-x-2">
                        <button 
                            onclick='openDetailModal(@json($item))'
                            class="px-3 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10] hover:opacity-80">
                            Detail
                        </button>

                        <a href="{{ route('admin.peminjaman.pdf', $item->id) }}"
                           class="px-3 py-1 bg-green-500 text-white border-2 border-[#2d1b10] hover:opacity-80">
                           PDF
                        </a>
                    </td>
                </tr>
                @endif
            @endforeach
            @if($peminjaman->where('status','Dikembalikan')->count() == 0)
                <tr>
                    <td colspan="7" class="text-center p-4">
                        Belum ada riwayat peminjaman yang dikembalikan.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</div>

<!-- MODAL DETAIL -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-[#f5efe6] border-4 border-[#2d1b10] p-6 w-full max-w-3xl shadow-[6px_6px_0_#2d1b10] flex flex-col md:flex-row gap-6">
        
        <!-- Cover Buku -->
        <div class="w-full md:w-1/3">
            <img id="coverBuku" src="/default-cover.png"
                 class="w-full h-auto border-2 border-[#2d1b10] object-contain">
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

            <!-- STATUS ONLY VIEW -->
            <div class="mt-3">
                <label class="block font-semibold mb-1">Status</label>
                <span id="detailStatus"
                      class="px-3 py-1 bg-green-400 border-2 border-[#2d1b10] inline-block">
                </span>
            </div>

            <div class="flex justify-end mt-4">
                <button type="button"
                        onclick="closeDetailModal()"
                        class="px-3 py-1 border-2 border-[#2d1b10]">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<script>
function openDetailModal(item) {

    const modal = document.getElementById('detailModal');
    const buku = item.buku || {};

    document.getElementById('coverBuku').src = buku.gambar
        ? `/storage/${buku.gambar}`
        : '/default-cover.png';

    document.getElementById('detailId').innerText = item.id ?? '-';
    document.getElementById('detailJudul').innerText = buku.judul ?? '-';
    document.getElementById('detailNama').innerText = item.nama ?? '-';
    document.getElementById('detailEmail').innerText = item.email ?? '-';
    document.getElementById('detailNomor').innerText = item.nomor_telepon ?? '-';
    document.getElementById('detailAlamat').innerText = item.alamat ?? '-';
    document.getElementById('detailPinjam').innerText = item.tanggal_pinjam ?? '-';
    document.getElementById('detailKembali').innerText = item.tanggal_kembali ?? '-';
    document.getElementById('detailStatus').innerText = item.status ?? '-';

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