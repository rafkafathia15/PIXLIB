<aside class="w-64 bg-[#d6c4ae]
              border-r-4 border-[#b08968]
              shadow-[6px_0_0_#2d1b10]
              flex flex-col text-xs text-[#2d1b10]">

    <!-- HEADER -->
    <div class="px-6 py-4 text-[#6f4e37] font-bold text-sm
                border-b-4 border-[#b08968]
                shadow-[0_4px_0_#2d1b10]
                bg-[#e6dccf]">
        ADMIN PERPUS
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-6 space-y-3">

    <a href="{{ url('/admin') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Dashboard
    </a>

    <a href="{{ url('/admin/peminjam') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Peminjam
    </a>

    <a href="{{ url('/admin/petugas') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Manajemen Petugas
    </a>

    <!-- INI PENTING -->
    <a href="{{ url('/admin/manajemen-buku') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Manajemen Buku
    </a>

    <a href="{{ url('/admin/kategori') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Kategori
    </a>

    <a href="{{ url('/admin/ulasan') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Ulasan
    </a>

    <a href="{{ url('/admin/riwayat') }}"
       class="block px-4 py-3 bg-[#e6dccf]
              border-4 border-[#2d1b10]
              shadow-[4px_4px_0_#2d1b10]
              hover:bg-[#cbb49a]
              hover:translate-x-1 hover:translate-y-1
              hover:shadow-none transition">
        Riwayat
    </a>

</nav>


    <!-- FOOTER -->
    <div class="px-4 py-4 border-t-4 border-[#b08968] space-y-3 bg-[#e6dccf]">

        <div class="text-[#6f4e37]">
            Login sebagai <b class="text-[#2d1b10]">Admin</b>
        </div>

        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
    @csrf
    <button type="button"
        onclick="openLogoutModal()"
        class="w-full px-4 py-3
               bg-[#b08968] text-[#2d1b10]
               border-4 border-[#2d1b10]
               shadow-[4px_4px_0_#2d1b10]
               hover:bg-[#a47148]
               hover:translate-x-1 hover:translate-y-1
               hover:shadow-none transition">
        Logout
    </button>
</form>

    </div>

</aside>
<!-- LOGOUT MODAL -->
<div id="logoutModal"
     class="fixed inset-0 bg-black/50 flex items-center justify-center
            hidden z-50">

    <div class="bg-[#f5efe6]
                border-4 border-[#2d1b10]
                shadow-[6px_6px_0_#2d1b10]
                p-6 w-80 text-center">

        <p class="text-[#6f4e37] mb-6">
            Yakin ingin logout?
        </p>

        <div class="flex gap-4 justify-center">

            <!-- BATAL -->
            <button onclick="closeLogoutModal()"
                class="px-4 py-2
                       bg-[#e6dccf]
                       border-4 border-[#2d1b10]
                       shadow-[3px_3px_0_#2d1b10]
                       hover:bg-[#cbb49a]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                Tidak
            </button>

            <!-- KONFIRM -->
            <button onclick="submitLogout()"
                class="px-4 py-2
                       bg-[#b08968]
                       border-4 border-[#2d1b10]
                       shadow-[3px_3px_0_#2d1b10]
                       hover:bg-[#a47148]
                       hover:translate-x-1 hover:translate-y-1
                       hover:shadow-none transition">
                Ya
            </button>

        </div>
    </div>
</div>
<script>
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
    }

    function submitLogout() {
        document.getElementById('logoutForm').submit();
    }
</script>

