<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Bukti Peminjaman</title>
<style>
    body { font-family: sans-serif; font-size: 12px; }
    .box { border: 2px solid #000; padding: 20px; }
</style>
</head>
<body>

<div class="box">
    <h2>Bukti Peminjaman Buku</h2>
    <hr>

    <p><strong>Nama Peminjam:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Judul Buku:</strong> {{ $pinjam->buku->judul }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $pinjam->tanggal_pinjam }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $pinjam->tanggal_kembali ?? '-' }}</p>
    <p><strong>Status:</strong> {{ $pinjam->status }}</p>

    <br><br>
    <p>Terima kasih telah meminjam di Pixel Library 📚</p>
</div>

</body>
</html>