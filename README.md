<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a>
</p>

<h1 align="center">📚 PIXLIB - Sistem Perpustakaan Digital</h1>

<p align="center">
Project Tugas Laravel - Sistem Manajemen Perpustakaan Digital
</p>

---

## 📌 Deskripsi Project

**PIXLIB** adalah aplikasi perpustakaan digital berbasis Laravel yang digunakan untuk mengelola:

- 📖 Data Buku  
- 🏷️ Kategori Buku  
- 👨‍💼 Manajemen Petugas  
- 👤 Manajemen User  
- 📥 Peminjaman Buku  
- 🕒 Riwayat Peminjaman  
- 🧾 Cetak Bukti Peminjaman (PDF)  
- ⭐ Ulasan Buku  
- ❤️ Buku Favorit  

Aplikasi ini dibuat untuk memenuhi tugas pengembangan sistem berbasis framework Laravel.

---

## 🔐 Login Admin (Default)

Gunakan akun berikut untuk mengakses dashboard Admin:

**Email:**  
admin@gmail.com  

**Password:**  
admin123  

---

## 👥 Role Pengguna

### 👑 1️⃣ Admin
- Login dan Register  
- Dashboard  
- Mengelola Data User  
- Mengelola Data Petugas  
- Mengelola Data Kategori  
- Mengelola Data Buku  
- Melihat dan Mengelola Riwayat Peminjaman  
- Cetak Laporan  

---

### 🧑‍💼 2️⃣ Petugas
- Login dan Register  
- Dashboard  
- Validasi Peminjaman  
- Mengelola Data Peminjaman  
- Melihat Data Rating / Ulasan  

---

### 👤 3️⃣ User
- Login dan Register  
- Dashboard  
- Melihat Katalog Buku  
- Mengisi Formulir Peminjaman  
- Melihat Riwayat Peminjaman  
- Memberikan Ulasan Buku  
- Mengelola Profil User  
- Menambahkan Buku ke Favorit  

---

## ⚙️ Cara Instalasi & Menjalankan Project

### 1️⃣ Clone Repository

```bash
git clone https://github.com/rafkafathia15/PIXLIB.git
```

### 2️⃣ Masuk ke Folder Project

```bash
cd PIXLIB
```

### 3️⃣ Install Dependency Laravel

```bash
composer install
```

### 4️⃣ Copy File Environment

Linux / Mac:
```bash
cp .env.example .env
```

Windows (CMD):
```bash
copy .env.example .env
```

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 6️⃣ Atur Database

Buka file `.env` lalu ubah bagian berikut sesuai database kamu:

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 7️⃣ Jalankan Migrasi Database

```bash
php artisan migrate
```

Jika menggunakan seeder:

```bash
php artisan db:seed
```

### 8️⃣ Jalankan Server

```bash
php artisan serve
```

Buka di browser:

```
http://127.0.0.1:8000
```

---

## 🛠️ Teknologi yang Digunakan

- Laravel  
- PHP  
- MySQL  
- Blade Template  
- Tailwind CSS  
- JavaScript  

---

## 📂 Struktur Folder Penting

- `app/` → Controller & Model  
- `resources/views/` → Tampilan Blade  
- `routes/web.php` → Routing aplikasi  
- `database/migrations/` → Struktur tabel database  

---

## 📝 Catatan

- Folder `vendor` tidak diupload ke GitHub.  
- File `.env` tidak disertakan demi keamanan.  
- Jalankan `composer install` setelah clone project.  

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan tugas Sekolah.
