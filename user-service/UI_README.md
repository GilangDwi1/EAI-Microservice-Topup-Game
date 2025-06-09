# User Service UI Documentation

## Overview
User Service UI adalah antarmuka web modern untuk mengelola pengguna dalam sistem EAI Microservice. UI ini dibangun menggunakan Laravel Blade dengan Tailwind CSS untuk desain yang responsif dan user-friendly.

## Fitur yang Tersedia

### 1. Dashboard User (Halaman Utama)
- **Lokasi**: `/` atau `/users`
- **Fitur**:
  - Menampilkan daftar semua user dalam format tabel
  - Statistik dasar user (total user)
  - Tombol aksi cepat untuk menambah user baru
  - Empty state ketika belum ada user
  - Responsive design untuk desktop dan mobile

### 2. Tambah User Baru
- **Lokasi**: `/users/create`
- **Fitur**:
  - Form untuk menambah user baru
  - Validasi input real-time
  - Field yang tersedia:
    - Nama Lengkap (wajib)
    - Email (wajib, harus unik)
    - Password (wajib, minimal 8 karakter)
  - Tips pengisian untuk user

### 3. Detail User
- **Lokasi**: `/users/{id}`
- **Fitur**:
  - Informasi lengkap user (nama, email, tanggal terdaftar)
  - Daftar riwayat transaksi user
  - Breadcrumb navigation
  - Tombol untuk kembali ke daftar user

## Teknologi yang Digunakan

### Frontend
- **Tailwind CSS**: Framework CSS utility-first
- **Font Awesome**: Icon library
- **Vanilla JavaScript**: Untuk interaksi client-side (jika ada)

### Backend
- **Laravel**: PHP framework
- **GraphQL**: Untuk komunikasi dengan API
- **HTTP Client**: Untuk request ke GraphQL endpoint

## Struktur File

```
resources/views/
├── layouts/
│   └── app.blade.php          # Layout utama
└── users/
    ├── index.blade.php        # Halaman daftar user
    ├── create.blade.php       # Halaman tambah user
    └── show.blade.php         # Halaman detail user
```

## Routes

```php
Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
```

## GraphQL Integration

UI menggunakan GraphQL untuk komunikasi dengan backend:

### Queries
- `listUsers`: Untuk mendapatkan semua user
- `getUser(id: ID!)`: Untuk mendapatkan detail user dan transaksinya

### Mutations
- `createUser`: Untuk membuat user baru

## Fitur UI/UX

### 1. Responsive Design
- Mobile-first approach
- Grid layout dan tabel yang adaptif
- Navigation yang responsif

### 2. Visual Feedback
- Success/error messages
- Hover effects
- Color-coded status indicators (untuk transaksi)

### 3. User Experience
- Breadcrumb navigation
- Consistent button styling
- Form validation
- Help cards dengan tips

### 4. Accessibility
- Semantic HTML
- ARIA labels
- Keyboard navigation
- Color contrast compliance

## Cara Menjalankan

1. Pastikan Laravel server berjalan:
   ```bash
   php artisan serve
   ```

2. Pastikan GraphQL endpoint untuk user service tersedia di `http://localhost:8001/graphql`

3. Akses UI melalui browser:
   - Dashboard: `http://localhost:8001`
   - Tambah User: `http://localhost:8001/users/create`

## Dependencies

### Composer
- `laravel/framework`
- `guzzlehttp/guzzle` (untuk HTTP client)
- `nesbot/carbon` (untuk formatting tanggal)

### NPM (jika diperlukan)
- `tailwindcss` (sudah menggunakan CDN)

## Customization

### Styling
- Edit file `resources/views/layouts/app.blade.php` untuk mengubah layout utama
- Modifikasi class Tailwind CSS untuk mengubah tampilan
- Tambahkan custom CSS di section `<style>` pada layout

### Functionality
- Edit `app/Http/Controllers/UserController.php` untuk mengubah logika
- Modifikasi GraphQL queries di controller
- Tambahkan validasi custom di method store

## Troubleshooting

### Common Issues

1. **GraphQL Connection Error**
   - Pastikan GraphQL server berjalan
   - Periksa URL endpoint di controller

2. **Styling Issues**
   - Pastikan Tailwind CSS CDN dapat diakses
   - Periksa console browser untuk error

3. **Form Validation Errors**
   - Periksa validation rules di controller
   - Pastikan semua required fields terisi

### Debug Mode
- Aktifkan debug mode Laravel untuk melihat error detail
- Periksa Laravel logs di `storage/logs/laravel.log`

## Future Enhancements

1. **Search & Filter**
   - Pencarian user berdasarkan nama atau email
   - Filter berdasarkan status

2. **Authentication & Authorization**
   - Integrasi sistem login user
   - Pembatasan akses berdasarkan role

3. **User Profile Management**
   - Update informasi user
   - Ganti password

4. **Real-time Updates**
   - WebSocket untuk update real-time (misalnya, transaksi baru)
   - Notifikasi perubahan status

5. **Advanced Features**
   - Export data user ke Excel/PDF
   - Integrasi dengan layanan eksternal 
