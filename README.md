---
title: TokoBuku Mongodb
emoji: 🏆
colorFrom: pink
colorTo: indigo
sdk: docker
pinned: false
license: mit
---

# 📚 TokoBuku – MongoDB-Powered Book Store & Management System

[![PHP Version](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-MongoDB%20Atlas-47A248?style=for-the-badge&logo=mongodb&logoColor=white)](https://www.mongodb.com/)
[![Docker](https://img.shields.io/badge/Container-Docker%20Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![UI Framework](https://img.shields.io/badge/UI-Bootstrap%205.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**TokoBuku** adalah aplikasi sistem katalog pustaka publik dan panel manajemen toko buku modern yang dibangun menggunakan **PHP Native dengan arsitektur MVC (Model-View-Controller)** dan terintegrasi secara langsung dengan **MongoDB (NoSQL)** melalui driver resmi `mongodb/mongodb`. 

Aplikasi ini mengoptimalkan keunggulan database NoSQL untuk menangani skema dokumen dinamis (seperti harga, diskon, stok, dan sinopsis), dilengkapi antarmuka modern yang responsif, visualisasi grafik analitik, serta keamanan kredensial terenkapsulasi.

---

## ✨ Fitur Utama (Key Features)

### 🌐 Katalog Publik (Public Catalog)
- **Desain Grid Responsif**: Katalog buku modern berbasis Bootstrap 5 dengan kartu berlatar rapi dan simetris.
- **Pencarian Real-Time**: Pencarian cepat berdasar judul, penulis, genre, maupun penerbit dilengkapi **Tombol Reset** instan.
- **Windowed Pagination**: Navigasi halaman yang efisien dan ringan menggunakan query MongoDB `skip` & `limit` (max 5 jendela halaman per tampilan).
- **Detail Spesifikasi & Sinopsis**: Informasi lengkap mengenai detail cetak, penerbit, status stok, serta ringkasan cerita buku.

### 🛡️ Admin Panel & Analitik
- **Autentikasi Aman**: Sistem login terproteksi *PHP Session* & *Middleware Guard* dengan kata sandi ter-hash (`password_hash`).
- **Dashboard Analitik Interaktif**: Visualisasi grafik distribusi genre (Pie Chart) dan statistik jumlah buku per penerbit (Bar Chart) menggunakan `Chart.js`.
- **Manajemen CRUD Kompleks**: Pengelolaan buku lengkap (Tambah, Edit, Detail, Hapus) yang memanfaatkan fitur NoSQL `$set` dan `$unset`.
- **Live Image Preview**: Pratinjau gambar sampul secara langsung saat memilih file gambar pada form.
- **Konfirmasi Hapus Data**: Modal konfirmasi ramah pengguna berbasis *SweetAlert2* untuk mencegah penghapusan data secara tidak sengaja.

---

## 🛠️ Tech Stack & Arsitektur

| Komponen | Teknologi yang Digunakan |
| :--- | :--- |
| **Language & Pattern** | PHP 8.2 (Native OOP & MVC Architecture) |
| **Database** | MongoDB Atlas / MongoDB Server (Driver `mongodb/mongodb` ^2.3) |
| **Containerization** | Docker (Custom Apache PHP 8.2 + PECL MongoDB Extension) |
| **Frontend UI** | Bootstrap 5.3, Bootstrap Icons, FontAwesome, Plus Jakarta Sans |
| **Data Visualization** | Chart.js |
| **User Interaction** | SweetAlert2 |

### 📁 Struktur Repositori

```text
TokoBuku/
├── config/
│   └── database.php       # Inisialisasi koneksi MongoDB Client & Parse .env
├── controllers/
│   ├── AuthController.php # Manajemen Auth (Login, Logout, CheckAuth Middleware)
│   ├── BukuController.php # Manajemen CRUD Admin & Data Analitik
│   └── HomeController.php # Handling Katalog Publik
├── Models/
│   ├── Buku.php           # Query MongoDB collection 'Buku_Baru' (Pagination & CRUD)
│   └── User.php           # Query MongoDB collection 'users' & Password Verification
├── views/
│   ├── auth/              # Halaman Login Admin
│   ├── buku/              # Views CRUD Admin (Index, Create, Edit, Detail)
│   ├── layouts/           # Reusable Component Layouts (Header, Sidebar, Navbar, Footer)
│   ├── public/            # Views Katalog Publik (Landing & Detail)
│   └── dashboard.php      # Analytics Dashboard dengan Chart.js
├── uploads/               # Wadah file cover gambar buku
├── Dockerfile             # Konfigurasi Container Apache + PHP 8.2 + MongoDB PECL
├── seed_user.php          # Script CLI Seeding Admin Account pertama
├── .env.example           # Template Variabel Lingkungan
├── index.php              # Central Router & Security Middleware Guard
└── composer.json          # Manajemen Dependensi PHP
```

---

## 🔒 Keamanan & Best Practices

1. **Pengelolaan Kredensial Terpisah (`.env`)**:
   Kredensial rahasia seperti `MONGO_URI` dienkapsulasi menggunakan file `.env` dan diabaikan dari Git via `.gitignore`.
2. **Hashed Passwords**:
   Kata sandi akun admin di-hash secara aman menggunakan fungsi standar `password_hash()` (Argon2 / BCRYPT).
3. **Route Protection Middleware**:
   Seluruh rute admin (`action=dashboard`, `index`, `tambah`, `edit`, `delete`) wajib memiliki session aktif yang divalidasi oleh `AuthController::checkAuth()`.

---

## 🚀 Panduan Memulai (Getting Started)

### Prasyarat
- PHP >= 8.2 dengan ekstensi `mongodb` diaktifkan
- Composer
- Docker (Opsional, untuk run via container)
- Akun MongoDB Atlas atau MongoDB Server lokal

### 1. Clone Repositori
```bash
git clone https://github.com/username/TokoBuku.git
cd TokoBuku
```

### 2. Instal Dependensi Composer
```bash
composer install
```

### 3. Konfigurasi Variabel Lingkungan (.env)
Salin berkas `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Sesuaikan string koneksi MongoDB Anda di file `.env`:
```env
MONGO_URI="mongodb+srv://<username>:<password>@cluster0.mongodb.net/"
```

### 4. Running Seeding Akun Admin Pertama
Jalankan script CLI untuk mendaftarkan akun admin awal ke MongoDB:
```bash
php seed_user.php
```

### 5. Jalankan Aplikasi

#### 🔹 Opsi A: Jalankan dengan PHP Built-in Server
```bash
php -S localhost:8000
```
Buka peramban web di `http://localhost:8000`.

#### 🔹 Opsi B: Jalankan dengan Docker Container
```bash
docker build -t tokobuku-app .
docker run -d -p 7860:7860 --env-file .env tokobuku-app
```
Buka peramban web di `http://localhost:7860`.

---

## 🔑 Akun Default Admin Panel

Gunakan kredensial berikut untuk masuk ke Panel Admin setelah melakukan *seeding*:

- **URL Login**: `http://localhost:8000/index.php?action=login`
- **Username**: `admin`
- **Password**: `admin123`

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [Lisensi MIT](LICENSE).

---
*Dikembangkan dengan ❤️ sebagai Proyek Portofolio Sistem Informasi Basis Data berbasis NoSQL MongoDB.*
