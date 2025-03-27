<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

# Fin-Track

**Fin-Track** adalah aplikasi manajemen keuangan berbasis web yang membantu pengguna mengelola pemasukan, pengeluaran, anggaran, dan laporan keuangan dengan lebih efektif.  
Aplikasi ini dirancang untuk memberikan pengalaman yang modern, minimalis, dan interaktif dengan tetap mempertahankan performa tinggi dan keamanan data.

---

## ✨ **Fitur Utama**
### **📊 Manajemen Transaksi**
- **CRUD Transaksi**: Tambah, edit, hapus, dan lihat daftar transaksi.
- **Kategori Transaksi**: Mengelompokkan transaksi berdasarkan kategori.
- **Filter & Pencarian**: Cari transaksi berdasarkan tanggal, kategori, atau akun.

### **💰 Manajemen Akun Keuangan**
- **CRUD Akun**: Tambah, edit, hapus akun keuangan.
- **Saldo Otomatis**: Saldo akun otomatis diperbarui setiap transaksi.
- **Riwayat Saldo (Balance Logs)**: Melacak perubahan saldo akun.

### **📉 Dashboard & Statistik**
- **Chart Keuangan**: Grafik pemasukan dan pengeluaran per bulan.
- **Ringkasan Keuangan**: Tampilkan total pemasukan, pengeluaran, dan saldo tersisa.

### **📅 Budgeting & Pengingat**
- **Manajemen Anggaran (Budgeting)**: Tetapkan anggaran untuk kategori tertentu.
- **Notifikasi Anggaran**: Peringatan jika pengeluaran mendekati atau melebihi anggaran.

### **🛡️ Keamanan & Otentikasi**
- **Email Verification**: Verifikasi email menggunakan Laravel Breeze.
- **Role-Based Access**: Hak akses berdasarkan peran pengguna.
- **Proteksi Saldo**: Cek saldo sebelum transaksi dilakukan.

---

## 🚀 **Teknologi yang Digunakan**
- **Backend**: Laravel 12 (PHP 8.3)
- **Frontend**: Blade Templates, Tailwind (v.4), SweetAlert2
- **Database**: MySQL
- **Charting**: Chart.js (untuk visualisasi data)
- **Autentikasi**: Laravel Breeze
- **Notifikasi**: Laravel Notifications
- **Version Control**: Git & GitHub

---

## 🛠 **Instalasi**
1. **Clone Repository**
   ```sh
   git clone https://github.com/RizwanHawwari/fin-track.git
   cd fin-track
   ```

2. **Install Dependencies**
   ```sh
   composer install
   npm install
   ```

3. **Buat File `.env`**
   ```sh
   cp .env.example .env
   ```

4. **Konfigurasi `.env`** (Sesuaikan database, mail, dll.)

5. **Generate Key & Migrasi Database**
   ```sh
   php artisan key:generate
   php artisan migrate --seed
   ```

6. **Jalankan Server**
   ```sh
   npm run dev
   ```

Akses aplikasi di **[http://localhost:8000](http://localhost:8000)** 🚀

---

## 📌 **Roadmap & Fitur Mendatang**
- 🔹 **Reminder Tagihan** (Akan dikembangkan setelah Budgeting selesai)
- 🔹 **Export Laporan Keuangan** (PDF & Excel)
- 🔹 **API untuk Integrasi Pihak Ketiga**

---

## 🤝 **Kontribusi**
Pull request selalu diterima! Silakan fork repository ini dan ajukan PR jika ada perbaikan atau fitur baru.

---

## ⚖️ **Lisensi**
Aplikasi ini menggunakan lisensi **MIT**.

---

Selamat menggunakan **Fin-Track**! 🚀💰

---


