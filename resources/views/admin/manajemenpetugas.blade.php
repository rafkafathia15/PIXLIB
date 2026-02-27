@extends('admin.layoutadm')

@section('title', 'Manajemen Petugas')

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
            Manajemen Petugas
        </h1>

        <button
            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="px-4 py-2 bg-[#6f4e37] text-[#fdfaf6]
                   border-2 border-[#2d1b10]
                   shadow-[4px_4px_0_#2d1b10]
                   hover:bg-[#5a3e2b] transition">
            + Tambah Petugas
        </button>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-5 flex gap-2">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari nama / email / username..."
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
                    <th class="p-3">No</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Username</th>
                    <th class="p-3">Role</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($petugas as $i => $p)
                <tr class="border-b border-[#b08968] hover:bg-[#f3ede7]">
                    <td class="p-3">{{ $petugas->firstItem() + $i }}</td>
                    <td class="p-3">{{ $p->name }}</td>
                    <td class="p-3">{{ $p->email }}</td>
                    <td class="p-3">{{ $p->username }}</td>
                    <td class="p-3 font-semibold text-[#6f4e37] capitalize">
                        {{ $p->role }}
                    </td>
                    <td class="p-3 text-center space-x-2">

                        <!-- EDIT -->
                        <button
                            onclick="editPetugas(
                                '{{ $p->id }}',
                                '{{ $p->name }}',
                                '{{ $p->email }}',
                                '{{ $p->username }}'
                            )"
                            class="px-2 py-1
                                   bg-[#b08968] text-[#2d1b10]
                                   border-2 border-[#2d1b10]
                                   shadow-[2px_2px_0_#2d1b10]">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <form id="deleteForm{{ $p->id }}"
                              action="{{ route('admin.petugas.destroy', $p->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    onclick="openDeleteModal('{{ $p->id }}','{{ $p->name }}')"
                                    class="px-2 py-1
                                           bg-[#8b3a2b] text-[#fdfaf6]
                                           border-2 border-[#2d1b10]
                                           shadow-[2px_2px_0_#2d1b10]">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"
                        class="p-4 text-center text-[#6f4e37] italic">
                        Data petugas tidak ditemukan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $petugas->links() }}
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah"
     class="hidden fixed inset-0 bg-[#2d1b10]/60 flex items-center justify-center z-50">
    <div class="bg-[#e6dccf] w-96 p-6 border-4 border-[#b08968] shadow-[6px_6px_0_#2d1b10]">

        <h2 class="text-sm font-bold mb-4 text-[#2d1b10]">
            Tambah Petugas
        </h2>

        <form action="{{ route('admin.petugas.store') }}" method="POST" class="space-y-3">
            @csrf
            <input name="nama" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" placeholder="Nama" required>
            <input name="email" type="email" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" placeholder="Email" required>
            <input name="username" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" placeholder="Username" required>
            <input name="password" type="password" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" placeholder="Password" required>

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
    <div class="bg-[#e6dccf] w-96 p-6 border-4 border-[#b08968] shadow-[6px_6px_0_#2d1b10]">

        <h2 class="text-sm font-bold mb-4 text-[#2d1b10]">
            Edit Petugas
        </h2>

        <form id="formEdit" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <input id="editNama" name="nama" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" required>
            <input id="editEmail" name="email" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" required>
            <input id="editUsername" name="username" class="w-full p-2 border-2 border-[#b08968] bg-[#fdfaf6]" required>

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
    <div class="bg-[#e6dccf] w-80 p-6 border-4 border-[#b08968]
                shadow-[6px_6px_0_#2d1b10] text-center">

        <h2 class="text-sm font-bold text-[#8b3a2b] mb-3">
            Hapus Akun?
        </h2>

        <p class="text-xs mb-4 text-[#2d1b10]">
            Yakin ingin menghapus petugas<br>
            <span id="deleteNama" class="font-bold"></span> ?
        </p>

        <div class="flex justify-center gap-4">
            <button onclick="closeDeleteModal()"
                    class="px-3 py-1 border-2 border-[#2d1b10]">
                Tidak
            </button>
            <button id="btnConfirmDelete"
                    class="px-3 py-1 bg-[#8b3a2b] text-white border-2 border-[#2d1b10]">
                Ya
            </button>
        </div>
    </div>
</div>

<script>
let deleteId = null;

function editPetugas(id, nama, email, username) {
    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('formEdit').action = `/admin/petugas/${id}`;
    document.getElementById('editNama').value = nama;
    document.getElementById('editEmail').value = email;
    document.getElementById('editUsername').value = username;
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