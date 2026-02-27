@extends('admin.layoutadm')

@section('title', 'Manajemen Buku')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="p-6 bg-[#f3ede7] min-h-screen">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-[#e6dccf] border-2 border-[#b08968] shadow-[3px_3px_0_#2d1b10] text-xs text-[#2d1b10]">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-[#2d1b10] tracking-wide">
        Manajemen Buku
    </h1>
    <p class="text-sm text-[#6f4e37] mt-1">
        Kelola data Buku perpustakaan digital secara terstruktur dan aman.
    </p>

    <!-- FILTERS + SEARCH + TAMBAH -->
    <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <!-- Search Bar -->
        <div class="flex-1 flex gap-2">
            <input type="text" id="searchBuku" placeholder="Cari buku..." 
                   class="flex-1 p-2 border-2 border-[#2d1b10] bg-[#fdfaf6] rounded shadow-sm">
            
            <!-- Dropdown Kategori -->
            <select id="filterKategori" class="p-2 border-2 border-[#2d1b10] bg-[#fdfaf6] rounded shadow-sm">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Tambah Buku -->
        <button onclick="openTambahBuku()"
                class="px-4 py-2 bg-[#6f4e37] text-[#fdfaf6] border-2 border-[#2d1b10] shadow-[4px_4px_0_#2d1b10] hover:bg-[#5a3e2b] transition">
            + Tambah Buku
        </button>
    </div>
</div>


    <!-- Grid Buku -->
<div id="bukuGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($bukus as $buku)
        <div class="bg-[#e6dccf] border-4 border-[#b08968] shadow-[6px_6px_0_#2d1b10] p-3 buku-card"
     data-judul="{{ strtolower($buku->judul) }}"
     data-kategori="{{ $buku->kategoris->pluck('id')->join(',') }}">

            
            <!-- Cover Buku Penuh -->
            <div class="h-64 w-full mb-3 overflow-hidden border-2 border-[#2d1b10]">
                @if($buku->gambar)
                    <img src="{{ asset('storage/'.$buku->gambar) }}" 
                         alt="{{ $buku->judul }}" 
                         class="h-full w-full object-cover cursor-pointer"
                         onclick="openDetailBuku({{ $buku->id }})" class="h-full w-full object-contain bg-[#d8c8b0]">
                         
                @else
                    <div class="h-full w-full flex items-center justify-center bg-[#d8c8b0] text-[#2d1b10]">
                        IMG / JPG
                    </div>
                @endif
            </div>

            <!-- Info Buku -->
            <h2 class="font-bold text-[#2d1b10] text-sm mb-1 truncate" title="{{ $buku->judul }}">{{ $buku->judul }}</h2>
            <p class="text-xs text-[#2d1b10] mb-2 truncate" title="{{ $buku->penulis }}">{{ $buku->penulis }}</p>

            <!-- Kategori -->
<div class="mb-2">
    <div class="flex flex-wrap gap-1 max-h-12 overflow-y-auto pr-1">
        @forelse($buku->kategoris as $k)
            <span class="px-2 py-1 bg-[#fdfaf6] border border-[#b08968] text-[10px] rounded whitespace-nowrap">
                {{ $k->nama }}
            </span>
        @empty
            <span class="text-[10px] italic text-[#6f4e37]">-</span>
        @endforelse
    </div>
</div>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

@if($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal menyimpan',
    html: `
        <ul style="text-align:left">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    `
});
</script>
@endif




            <!-- Tombol Detail, Edit & Hapus -->
<div class="flex gap-2">
    <!-- Detail -->
    <button onclick="openDetailBuku({{ $buku->id }})"
            class="px-2 py-1 bg-[#fdfaf6] text-[#2d1b10] border-2 border-[#2d1b10] 
                   shadow-[2px_2px_0_#2d1b10] text-xs">
        &gt;
    </button>

    <!-- Edit -->
    <button onclick="openEditBuku({{ $buku->id }})" 
            class="flex-1 px-2 py-1 bg-[#b08968] text-[#2d1b10] border-2 border-[#2d1b10] 
                   shadow-[2px_2px_0_#2d1b10] text-xs">
        Edit
    </button>

    <!-- Hapus -->
    <button type="button" onclick="openHapusBuku({{ $buku->id }})"
            class="flex-1 px-2 py-1 bg-[#8b3a2b] text-[#fdfaf6] border-2 border-[#2d1b10] 
                   shadow-[2px_2px_0_#2d1b10] text-xs">
        Hapus
    </button>
</div>
</div>
    @empty
        <p class="col-span-full text-center text-[#6f4e37] italic">Data buku belum tersedia</p>
    @endforelse
</div>


@foreach($bukus as $buku)
<div id="modalDetailBuku{{ $buku->id }}"
     class="hidden fixed inset-0 bg-[#2d1b10]/70 flex items-center justify-center z-50 overflow-y-auto">

    <div class="bg-[#efe5d8] w-[900px] p-6 border-4 border-[#6f4e37]
                shadow-[8px_8px_0_#2d1b10] max-h-[90vh]">

        <h2 class="text-center font-bold text-[#2d1b10] mb-4 tracking-wide text-lg">
            Detail Buku
        </h2>

        <!-- TAB -->
        <div class="flex justify-center gap-4 mb-5 text-sm font-semibold">
            <button id="tabRincian{{ $buku->id }}"
                class="px-4 py-1 border-2 border-[#2d1b10] bg-[#6f4e37] text-white"
                onclick="showDetail({{ $buku->id }}, 'rincian')">
                Rincian
            </button>

            <button id="tabDetail{{ $buku->id }}"
                class="px-4 py-1 border-2 border-[#2d1b10] bg-[#d8c8b0]"
                onclick="showDetail({{ $buku->id }}, 'detail')">
                Detail
            </button>
        </div>

        <div class="grid grid-cols-12 gap-6 text-xs">

            <!-- COVER -->
            <div class="col-span-3 text-center">
                <div class="h-64 w-full mb-2 overflow-hidden border-2 border-[#2d1b10]
                            flex items-center justify-center bg-[#d8c8b0] text-[#2d1b10]">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/'.$buku->gambar) }}"
                             class="h-full w-full object-cover">
                    @else
                        IMG / JPG
                    @endif
                </div>
                <p class="text-[10px]">Cover Buku</p>
            </div>

            <!-- ================= RINCIAN ================= -->
            <div id="rincian{{ $buku->id }}"
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

                    <div>
                        <label>Kategori</label>
                        <div class="mt-1 p-2 border-2 border-[#2d1b10] bg-[#efe5d8]">
                            {{ $buku->kategoris->pluck('nama')->join(', ') ?: '-' }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= DETAIL ================= -->
            <div id="detail{{ $buku->id }}"
                 class="col-span-9 hidden opacity-0 translate-x-6
                        transition-all duration-300 ease-out">

                <div class="bg-[#d8c8b0] p-4 border-2 border-[#2d1b10]">
                    <label>Sinopsis</label>
                    <div class="mt-2 p-4 border-2 border-[#2d1b10] bg-[#efe5d8]
                                h-[300px] overflow-y-auto text-sm leading-relaxed">
                        {{ $buku->sinopsis ?? 'Sinopsis belum tersedia.' }}
                    </div>
                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="flex justify-center gap-6 mt-6">
            <button type="button"
                onclick="closeDetailBuku({{ $buku->id }})"
                class="px-4 py-1 bg-[#d8c8b0] border-2 border-[#2d1b10]
                       shadow-[2px_2px_0_#2d1b10]">
                Tutup
            </button>
        </div>

    </div>
</div>
@endforeach








<!-- ================= MODAL TAMBAH BUKU ================= -->
<div id="modalTambahBuku" class="hidden fixed inset-0 bg-[#2d1b10]/70 flex items-center justify-center z-50 overflow-y-auto">
    <div class="bg-[#efe5d8] w-[900px] p-6 border-4 border-[#6f4e37] shadow-[8px_8px_0_#2d1b10] max-h-[90vh]">
        <h2 class="text-center font-bold text-[#2d1b10] mb-4 tracking-wide text-lg">Tambah Buku</h2>
        <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-12 gap-6 text-xs">

                <!-- Cover -->
                <div class="col-span-3 text-center">
                    <div id="previewCover" class="h-64 w-full mb-2 overflow-hidden border-2 border-[#2d1b10] flex items-center justify-center bg-[#d8c8b0] text-[#2d1b10]">
                        IMG / JPG
                    </div>

                    <!-- Tombol custom file -->
                    <label class="w-full inline-block px-4 py-2 bg-[#b08968] text-white font-semibold text-sm text-center cursor-pointer border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10] hover:bg-[#8b3a2b]">
                        Pilih Cover Buku
                        <input type="file" name="gambar" id="inputCover" class="hidden" accept="image/*">
                    </label>
                    <p class="mt-1 text-[10px]">Cover Buku </p>
                </div>

                <!-- Form Kiri -->
                <div class="col-span-5 space-y-3">
                    <div>
                        <label>Judul Buku</label>
                        <input type="text" name="judul" required class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Penulis</label>
                        <input type="text" name="penulis" required class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Stok</label>
                        <input type="number" name="stok" min="0" required class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Kategori</label>
                        <div class="bg-[#d8c8b0] border-2 border-[#2d1b10] p-2 space-y-1 max-h-[130px] overflow-y-auto">
                            @foreach($kategoris as $k)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="kategori_ids[]" value="{{ $k->id }}">
                                    {{ $k->nama }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Form Kanan -->
                <div class="col-span-4 space-y-3">
                    <div>
                        <label>Penerbit</label>
                        <input type="text" name="penerbit" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Sinopsis</label>
                        <textarea name="sinopsis" rows="5" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]"></textarea>
                    </div>
                </div>

            </div>

            <div class="flex justify-center gap-6 mt-6">
                <button type="button" onclick="closeTambahBuku()" class="px-4 py-1 bg-[#d8c8b0] border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">Batal</button>
                <button type="submit" class="px-4 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- ================= MODAL EDIT BUKU ================= -->
@foreach($bukus as $buku)
<div id="modalEditBuku{{ $buku->id }}" class="hidden fixed inset-0 bg-[#2d1b10]/70 flex items-center justify-center z-50 overflow-y-auto">
    <div class="bg-[#efe5d8] w-[900px] p-6 border-4 border-[#6f4e37] shadow-[8px_8px_0_#2d1b10] max-h-[90vh]">
        <h2 class="text-center font-bold text-[#2d1b10] mb-2 tracking-wide text-lg">Edit Buku</h2>
        <p class="text-center text-xs text-[#6f4e37] mb-4">Perbarui data buku perpustakaan secara akurat</p>

        <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-12 gap-4 text-xs">

                <!-- Cover -->
                <div class="col-span-3 text-center">
                    <div class="h-64 w-full mb-2 overflow-hidden border-2 border-[#2d1b10]">
                        @if($buku->gambar)
                            <img src="{{ asset('storage/'.$buku->gambar) }}" class="h-full w-full object-contain bg-[#d8c8b0]">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-[#d8c8b0] text-[#2d1b10]">IMG / JPG</div>
                        @endif
                    </div>

                    <!-- Tombol custom file -->
                    <label class="w-full inline-block px-4 py-2 bg-[#b08968] text-white font-semibold text-sm text-center cursor-pointer border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10] hover:bg-[#8b3a2b]">
                        Ganti Cover Buku
                        <input type="file" name="gambar" class="hidden">
                    </label>
                    <p class="mt-1 text-[10px]">Opsional</p>
                </div>

                <!-- Info Utama -->
                <div class="col-span-5 space-y-2">
                    <div>
                        <label>Judul Buku</label>
                        <input type="text" name="judul" required value="{{ $buku->judul }}" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Penulis</label>
                        <input type="text" name="penulis" required value="{{ $buku->penulis }}" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Stok</label>
                        <input type="number" name="stok" min="0" required value="{{ $buku->stok }}" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Kategori</label>
                        <div class="bg-[#d8c8b0] border-2 border-[#2d1b10] p-2 space-y-1 max-h-[130px] overflow-y-auto">
                            @foreach ($kategoris as $k)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="kategori_ids[]" value="{{ $k->id }}" 
                                        {{ $buku->kategoris->contains($k->id) ? 'checked' : '' }}>
                                    {{ $k->nama }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="col-span-4 space-y-2">
                    <div>
                        <label>Penerbit</label>
                        <input type="text" name="penerbit" value="{{ $buku->penerbit }}" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">
                    </div>
                    <div>
                        <label>Sinopsis</label>
                        <textarea name="sinopsis" rows="5" class="w-full p-2 border-2 border-[#2d1b10] bg-[#d8c8b0]">{{ $buku->sinopsis }}</textarea>
                    </div>
                </div>

            </div>

            <div class="flex justify-center gap-4 mt-4">
                <button type="button" onclick="closeEditBuku({{ $buku->id }})" class="px-4 py-1 bg-[#d8c8b0] border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">Batal</button>
                <button type="submit" class="px-4 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- ================= MODAL HAPUS BUKU ================= -->
@foreach($bukus as $buku)
<div id="modalHapusBuku{{ $buku->id }}" class="hidden fixed inset-0 bg-[#2d1b10]/70 flex items-center justify-center z-50">
    <div class="bg-[#efe5d8] w-96 p-6 border-4 border-[#6f4e37] shadow-[6px_6px_0_#2d1b10] text-center">
        <h2 class="text-lg font-bold text-[#2d1b10] mb-2">Hapus Buku</h2>
        <p class="text-xs text-[#6f4e37] mb-4">
            Apakah Anda yakin ingin menghapus buku <span class="font-semibold">{{ $buku->judul }}</span>?
        </p>
        <div class="flex justify-center gap-4">
            <button onclick="closeHapusBuku({{ $buku->id }})" class="px-4 py-1 bg-[#d8c8b0] border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">
                Batal
            </button>
            <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-1 bg-[#8b3a2b] text-[#fdfaf6] border-2 border-[#2d1b10] shadow-[2px_2px_0_#2d1b10]">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
function openHapusBuku(id) {
    document.getElementById('modalHapusBuku' + id).classList.remove('hidden');
}
function closeHapusBuku(id) {
    document.getElementById('modalHapusBuku' + id).classList.add('hidden');
}
</script>

<script>
    // Preview gambar sebelum submit
    const inputCover = document.getElementById('inputCover');
    const previewCover = document.getElementById('previewCover');

    inputCover.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
                previewCover.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
            }
            reader.readAsDataURL(file);
        } else {
            previewCover.innerHTML = 'IMG / JPG';
        }
    });
</script>

<script>
function openDetailBuku(id){
    const modal = document.getElementById('modalDetailBuku'+id);
    modal.classList.remove('hidden');
    showDetail(id, 'rincian');
}

function closeDetailBuku(id){
    document.getElementById('modalDetailBuku'+id).classList.add('hidden');
}

function showDetail(id, type) {
    const rincian = document.getElementById('rincian' + id);
    const detail  = document.getElementById('detail' + id);

    const tabR = document.getElementById('tabRincian' + id);
    const tabD = document.getElementById('tabDetail' + id);

    if (type === 'rincian') {
        // tab aktif
        tabR.classList.add('bg-[#6f4e37]', 'text-white');
        tabR.classList.remove('bg-[#d8c8b0]');
        tabD.classList.add('bg-[#d8c8b0]');
        tabD.classList.remove('bg-[#6f4e37]', 'text-white');

        // animasi
        detail.classList.add('opacity-0','translate-x-6');
        setTimeout(() => {
            detail.classList.add('hidden');
            rincian.classList.remove('hidden','opacity-0','translate-x-6');
        }, 200);

    } else {
        tabD.classList.add('bg-[#6f4e37]', 'text-white');
        tabD.classList.remove('bg-[#d8c8b0]');
        tabR.classList.add('bg-[#d8c8b0]');
        tabR.classList.remove('bg-[#6f4e37]', 'text-white');

        rincian.classList.add('opacity-0','translate-x-6');
        setTimeout(() => {
            rincian.classList.add('hidden');
            detail.classList.remove('hidden','opacity-0','translate-x-6');
        }, 200);
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput   = document.getElementById('searchBuku');
    const kategoriSelect = document.getElementById('filterKategori');
    const bukuCards     = document.querySelectorAll('.buku-card');

    function filterBuku() {
        const keyword = searchInput.value.toLowerCase();
        const kategoriDipilih = kategoriSelect.value;

        bukuCards.forEach(card => {
            const judul = card.dataset.judul;
            const kategoriList = card.dataset.kategori.split(',');

            const cocokJudul = judul.includes(keyword);
            const cocokKategori = 
                kategoriDipilih === '' || kategoriList.includes(kategoriDipilih);

            card.style.display = (cocokJudul && cocokKategori)
                ? 'block'
                : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterBuku);
    kategoriSelect.addEventListener('change', filterBuku);

});
</script>










<script>
function openTambahBuku() { document.getElementById('modalTambahBuku').classList.remove('hidden'); }
function closeTambahBuku() { document.getElementById('modalTambahBuku').classList.add('hidden'); }
function openEditBuku(id) { document.getElementById('modalEditBuku'+id).classList.remove('hidden'); }
function closeEditBuku(id) { document.getElementById('modalEditBuku'+id).classList.add('hidden'); }
</script>

@endsection
