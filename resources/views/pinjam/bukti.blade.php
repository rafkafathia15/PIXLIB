<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Bukti Peminjaman Buku</h1>

    <p><strong>ID Peminjaman:</strong> {{ $peminjaman->id }}</p>
    <p><strong>Nama:</strong> {{ $peminjaman->nama }}</p>
    <p><strong>Email:</strong> {{ $peminjaman->email }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $peminjaman->nomor_telepon }}</p>
    <p><strong>Alamat:</strong> {{ $peminjaman->alamat }}</p>

    <table>
        <tr>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>{{ $peminjaman->buku->judul }}</td>
            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}</td>
            <td>{{ $peminjaman->status }}</td>
        </tr>
    </table>

    <p style="text-align:center; margin-top:30px;">
        Terima kasih telah meminjam buku di perpustakaan kami 📚
    </p>
</body>
</html>