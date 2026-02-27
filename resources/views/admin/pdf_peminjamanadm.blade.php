<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        .box { border:1px solid #000; padding:20px; }
        h2 { text-align:center; }
    </style>
</head>
<body>

<h2>Bukti Peminjaman Buku</h2>

<div class="box">
    <p><strong>ID:</strong> {{ $peminjaman->id }}</p>
    <p><strong>Nama:</strong> {{ $peminjaman->nama }}</p>
    <p><strong>Email:</strong> {{ $peminjaman->email }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $peminjaman->nomor_telepon }}</p>
    <p><strong>Alamat:</strong> {{ $peminjaman->alamat }}</p>
    <p><strong>Judul Buku:</strong> {{ $peminjaman->buku->judul ?? '-' }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali }}</p>
    <p><strong>Status:</strong> {{ $peminjaman->status }}</p>
</div>

<br>
<p>Dicetak pada: {{ now() }}</p>

</body>
</html>
