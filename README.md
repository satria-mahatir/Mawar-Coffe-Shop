# 🌹 Mawar Coffee Shop - Dynamic Web System

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%207.4-8892BF?style=for-the-badge&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4.6-7952B3?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com/)
[![JS ES6](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![LeafletJS](https://img.shields.io/badge/Leaflet-1.7-199900?style=for-the-badge&logo=leaflet)](https://leafletjs.com/)

Sistem Informasi Manajemen & Reservasi Dinamis berbasis **PHP (Native)** dan **MySQL** yang dirancang secara khusus untuk **Warkop Mawar Bondowoso**. Sistem ini menghadirkan antarmuka pengguna (Frontend) yang modern, estetik, dan interaktif berpasangan dengan Dashboard Admin (Backend) yang tangguh, aman, dan sangat responsif di perangkat mobile.

---

## ⚡ Fitur Utama (Features)

### 🧑‍💻 Frontend (Customer Experience)
*   **Edge-to-Edge Infinite Scroller**: Transisi spanduk galeri berjalan dengan loop pixel-perfect mulus tanpa jeda (*infinite horizontal marquee loop*).
*   **Eco Screen Saver Mode**: Mode screensaver penghemat daya yang aktif otomatis ketika halaman didiamkan dalam waktu tertentu.
*   **Real-time Menu Status**: Secara dinamis menampilkan badge **"SOLD OUT"** secara instan saat admin menonaktifkan ketersediaan menu di database tanpa reload halaman.
*   **Esthetic Preloader**: Loading screen transisi modern lengkap dengan animasi indikator progres.
*   **Interactive Leaflet.js Mapping**: Peta lokasi kedai kopi interaktif yang aman dari pemblokiran browser modern.
*   **WhatsApp Checkout Gateway**: Mengirimkan rekap pesanan langsung ke admin WhatsApp dengan aman.

### 🛡️ Dashboard Admin (Management Panel)
*   **Fully Responsive Mobile Layout**: Dirancang presisi mengikuti **iOS & Android Touch Target Guidelines** (ukuran ketukan minimal `44px` untuk tombol aksi, eliminasi klik salah).
*   **Full-Screen Scroll Flow**: Mengalir alami memanfaatkan seluruh viewport perangkat layar kecil seperti di aplikasi native.
*   **Native Horizontal Table Swiping**: Menggunakan pembungkus `.table-responsive` agar tabel data dapat digeser kanan-kiri dengan sangat aman dan intuitif.
*   **Auto-Update Alert System**: Pengecekan reservasi baru otomatis di latar belakang dengan **Notifikasi Toast** dan **Coffee Shop Bell Sound** yang premium (Web Audio API).
*   **High-End Modals & Actions**: Desain glassmorphism elegan, tombol Batal/Cancel yang berfungsi sempurna, dan konfirmasi hapus berbasis **SweetAlert2**.
*   **Robust Security Hardening**:
    *   **CSRF Protection**: Token anti-pemalsuan unik pada setiap sesi form transaksi dan aksi.
    *   **SQL Injection Prevention**: Menggunakan *prepared statements* pada setiap eksekusi query database sensitif.
    *   **Security Headers**: Pengaturan `X-Frame-Options`, `X-Content-Type-Options`, dan `Referrer-Policy`.
    *   **Secure Environment**: Data kredensial database dimuat aman lewat file `.env`.

---

## 🛠️ Tech Stack & Dependencies

| Layer | Technology / Library |
| :--- | :--- |
| **Language & Backend** | PHP >= 7.4 (Native OOP Concepts) |
| **Database** | MySQL / MariaDB |
| **Frontend Framework** | Bootstrap 4.6.1, AdminLTE 3.2 |
| **Interactive Map** | Leaflet.js 1.7 |
| **Alerts & Visuals** | SweetAlert2, Toastr, FontAwesome 5.15.4 |
| **Logic & Scripting** | JavaScript (ES6), jQuery 3.6.0 |

---

## 📂 Struktur Direktori Proyek (Directory Tree)

```text
Tugas-akhir-mawar/
├── admin/                         # Backend Dashboard Area
│   ├── includes/                  # Header, Navbar, Sidebar & Footer
│   ├── update_reservasi.php       # Logika konfirmasi / selesai reservasi
│   ├── api_check_reservations.php # API real-time cek reservasi baru
│   ├── menu.php                   # Kelola Data Menu Makanan/Minuman
│   ├── galeri.php                 # Kelola Data Foto Galeri
│   ├── reservasi.php              # Kelola Data Reservasi Pelanggan
│   └── login.php                  # Halaman Login Admin & Proteksi
├── assets/                        # Static Assets (CSS, JS, Fonts)
├── config/                        # Database Connection & Security
│   ├── database.php               # Konfigurasi PDO / MySQLi Connection
│   └── database.php.example
├── images/                        # Tempat Upload Gambar Menu/Galeri
├── pages/                         # Halaman Dinamis Pelanggan
│   ├── menu.php                   # Tampilan Kategori Menu
│   └── galeri.php                 # Galeri Foto Kedai Kopi
├── api_menu_status.php            # API Endpoint Ketersediaan Menu
├── index.php                      # Core Entry Point / Landing Page
├── .env                           # Environment Variables (Secure)
├── .env.example
├── .gitignore
├── sitemap.xml
└── README.md                      # Dokumentasi Proyek
```

---

## 🚀 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah berikut untuk menjalankan sistem di lingkungan server lokal Anda:

### 1. Persiapan Awal
*   Pastikan server lokal (seperti **Laragon** atau **XAMPP**) telah aktif.
*   Buka terminal/command prompt di direktori server lokal Anda (contoh `C:\laragon\www\` atau `C:\xampp\htdocs\`).

### 2. Kloning Repositori
```bash
git clone https://github.com/satria-mahatir/Mawar-Coffe-Shop.git Tugas-akhir-mawar
cd Tugas-akhir-mawar
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env` dan sesuaikan kredensial database Anda:
```bash
cp .env.example .env
```
Isi dari `.env`:
```ini
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=db_warkop_mawar
```

### 4. Setup Database
1.  Buka browser dan buka `http://localhost/phpmyadmin`.
2.  Buat database baru dengan nama `db_warkop_mawar`.
3.  Import file database SQL (jika disertakan) atau jalankan query struktur tabel yang diperlukan.

### 5. Menjalankan Website
*   **Akses Halaman Utama (Pelanggan)**: `http://localhost/Tugas-akhir-mawar/`
*   **Akses Dashboard Admin**: `http://localhost/Tugas-akhir-mawar/admin/`

---

## ⚖️ Lisensi (License)

Dikembangkan oleh **Tama** &copy; 2026. Hak Cipta Dilindungi Undang-Undang.  
Didesain dengan ❤️ untuk memberikan kenyamanan operasional dan digitalisasi Warkop Mawar Bondowoso.
