@extends('admin.layoutadm')

@section('title', 'Data Peminjam')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-[#6f4e37]">
        Manajemen Data Peminjam
    </h1>
    <p class="text-sm text-gray-600 mt-1">
        Daftar seluruh akun dengan role user yang terdaftar di sistem perpustakaan.
    </p>
</div>

<!-- SEARCH -->
<div class="mb-4 flex justify-between items-center">
    <form method="GET" action="{{ route('admin.peminjam.index') }}">
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama, username, atau email..."
            class="px-3 py-2 border-2 border-[#2d1b10] bg-[#f5efe6] text-sm w-64 focus:outline-none"
        >
        <button class="px-3 py-2 bg-[#6f4e37] text-white border-2 border-[#2d1b10] text-sm">
            Cari
        </button>
    </form>
</div>

<div class="bg-[#e6dccf] border-4 border-[#2d1b10] shadow-[6px_6px_0_#2d1b10] p-6 overflow-x-auto">

    <table class="w-full border-2 border-[#2d1b10] text-sm">
        <thead class="bg-[#d6c4ae]">
            <tr>
                <th class="border border-[#2d1b10] p-2">No</th>
                <th class="border border-[#2d1b10] p-2">Nama</th>
                <th class="border border-[#2d1b10] p-2">Username</th>
                <th class="border border-[#2d1b10] p-2">Email</th>
                <th class="border border-[#2d1b10] p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjam as $index => $item)
            <tr class="bg-[#f5efe6]">
                <td class="border border-[#2d1b10] p-2 text-center">
                    {{ $peminjam->firstItem() + $index }}
                </td>
                <td class="border border-[#2d1b10] p-2">{{ $item->name }}</td>
                <td class="border border-[#2d1b10] p-2">{{ $item->username }}</td>
                <td class="border border-[#2d1b10] p-2">{{ $item->email }}</td>
                <td class="border border-[#2d1b10] p-2 text-center space-x-2">

                    <button 
                        onclick="openDeleteModal({{ $item->id }})"
                        class="px-3 py-1 bg-red-500 text-white border-2 border-[#2d1b10] hover:opacity-80">
                        Hapus
                    </button>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4">
                    Belum ada data peminjam.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $peminjam->links() }}
    </div>

</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-[#f5efe6] border-4 border-[#2d1b10] p-6 w-full max-w-md shadow-[6px_6px_0_#2d1b10]">
        
        <h2 class="text-lg font-bold text-[#6f4e37] mb-3">
            Konfirmasi Hapus
        </h2>

        <p class="text-sm mb-4">
            Apakah kamu yakin ingin menghapus akun ini?
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeDeleteModal()" 
                    class="px-3 py-1 border-2 border-[#2d1b10]">
                    Batal
                </button>

                <button type="submit"
                    class="px-3 py-1 bg-red-500 text-white border-2 border-[#2d1b10]">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openDeleteModal(id) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');

    form.action = `/admin/peminjam/${id}`;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection