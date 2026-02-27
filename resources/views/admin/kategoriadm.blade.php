@extends('admin.layoutadm')

@section('title', 'Manajemen Kategori')

@section('content')

<div class="p-6 bg-[#f3ede7] min-h-screen">

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-[#e6dccf]
                    border-2 border-[#b08968]
                    shadow-[3px_3px_0_#2d1b10]
                    text-xs text-[#2d1b10]">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-xl font-bold text-[#2d1b10] tracking-wide">
            Manajemen Kategori
        </h1>

        <button
            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="px-4 py-2 bg-[#6f4e37] text-[#fdfaf6]
                   border-2 border-[#2d1b10]
                   shadow-[4px_4px_0_#2d1b10]
                   hover:bg-[#5a3e2b] transition">
            + Tambah Kategori
        </button>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-5 flex gap-2">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari kategori..."
               class="p-2 border-2 border-[#b08968]
                      bg-[#fdfaf6] text-xs w-64
                      text-[#2d1b10] focus:outline-none">

        <button
            class="px-4 py-2 bg-[#b08968] text-[#2d1b10]
                   border-2 border-[#2d1b10]
                   shadow-[2px_2px_0_#2d1b10]">
            Cari
        </button>
    </form>

    <!-- TABLE -->
    <div class="bg-[#e6dccf]
                border-4 border-[#b08968]
                shadow-[6px_6px_0_#2d1b10]
                overflow-x-auto">

        <table class="w-full text-xs text-[#2d1b10]">
            <thead class="bg-[#d6c4ae] border-b-4 border-[#b08968]">
                <tr>
                    <th class="p-3 w-16">No</th>
                    <th class="p-3">Nama Kategori</th>
                    <th class="p-3 text-center w-40">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($kategori as $i => $k)
                <tr class="border-b border-[#b08968] hover:bg-[#f3ede7]">
                    <td class="p-3 text-center">
                        {{ $kategori->firstItem() + $i }}
                    </td>
                    <td class="p-3 font-semibold">
                        {{ $k->nama }}
                    </td>

                    <td class="p-3">
                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <button
                                onclick="editKategori('{{ $k->id }}','{{ $k->nama }}')"
                                class="px-2 py-1 bg-[#b08968] text-[#2d1b10]
                                       border-2 border-[#2d1b10]
                                       shadow-[2px_2px_0_#2d1b10]">
                                Edit
                            </button>

                            <!-- DELETE -->
                            <form id="deleteForm{{ $k->id }}"
                                  action="{{ route('admin.kategori.destroy', $k->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        onclick="openDeleteModal('{{ $k->id }}','{{ $k->nama }}')"
                                        class="px-2 py-1 bg-[#8b3a2b] text-[#fdfaf6]
                                               border-2 border-[#2d1b10]
                                               shadow-[2px_2px_0_#2d1b10]">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"
                        class="p-4 text-center text-[#6f4e37] italic">
                        Data kategori tidak ditemukan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $kategori->links() }}
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah"
     class="hidden fixed inset-0 bg-[#2d1b10]/60 flex items-center justify-center z-50">
    <div class="bg-[#e6dccf] w-96 p-6
                border-4 border-[#b08968]
                shadow-[6px_6px_0_#2d1b10]">

        <h2 class="text-sm font-bold mb-4 text-[#2d1b10]">
            Tambah Kategori
        </h2>

        <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-3">
            @csrf
            <input name="nama"
                   class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]"
                   placeholder="Nama kategori"
                   required>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button"
                        onclick="document.getElementById('modalTambah').classList.add('hidden')"
                        class="px-3 py-1 border-2 border-[#2d1b10]">
                    Batal
                </button>
                <button type="submit"
                        class="px-3 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit"
     class="hidden fixed inset-0 bg-[#2d1b10]/60 flex items-center justify-center z-50">
    <div class="bg-[#e6dccf] w-96 p-6
                border-4 border-[#b08968]
                shadow-[6px_6px_0_#2d1b10]">

        <h2 class="text-sm font-bold mb-4 text-[#2d1b10]">
            Edit Kategori
        </h2>

        <form id="formEdit" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <input id="editNama" name="nama"
                   class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]"
                   required>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button"
                        onclick="document.getElementById('modalEdit').classList.add('hidden')"
                        class="px-3 py-1 border-2 border-[#2d1b10]">
                    Batal
                </button>
                <button type="submit"
                        class="px-3 py-1 bg-[#6f4e37] text-white border-2 border-[#2d1b10]">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL DELETE ================= -->
<div id="modalDelete"
     class="hidden fixed inset-0 bg-[#2d1b10]/60 flex items-center justify-center z-50">
    <div class="bg-[#e6dccf] w-80 p-6
                border-4 border-[#b08968]
                shadow-[6px_6px_0_#2d1b10]
                text-center">

        <h2 class="text-sm font-bold text-[#8b3a2b] mb-3">
            Hapus Kategori?
        </h2>

        <p class="text-xs mb-4 text-[#2d1b10]">
            Yakin ingin menghapus kategori<br>
            <span id="deleteNama" class="font-bold"></span> ?
        </p>

        <div class="flex justify-center gap-4">
            <button onclick="closeDeleteModal()"
                    class="px-3 py-1 border-2 border-[#2d1b10]">
                Tidak
            </button>
            <button id="btnConfirmDelete"
                    class="px-3 py-1 bg-[#8b3a2b] text-white
                           border-2 border-[#2d1b10]">
                Ya
            </button>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
let deleteId = null;

function editKategori(id, nama) {
    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('formEdit').action = `/admin/kategori/${id}`;
    document.getElementById('editNama').value = nama;
}

function openDeleteModal(id, nama) {
    deleteId = id;
    document.getElementById('deleteNama').innerText = nama;
    document.getElementById('modalDelete').classList.remove('hidden');

    document.getElementById('btnConfirmDelete').onclick = function () {
        document.getElementById('deleteForm' + deleteId).submit();
    }
}

function closeDeleteModal() {
    document.getElementById('modalDelete').classList.add('hidden');
    deleteId = null;
}
</script>

@endsection
