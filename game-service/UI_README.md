# Game Service UI Documentation

## Overview
Game Service UI adalah antarmuka web modern untuk mengelola game dalam sistem EAI Microservice. UI ini dibangun menggunakan Laravel Blade dengan Tailwind CSS untuk desain yang responsif dan user-friendly.

## Fitur yang Tersedia

### 1. Dashboard Game (Halaman Utama)
- **Lokasi**: `/` atau `/games`
- **Fitur**:
  - Menampilkan daftar semua game dalam format card
  - Statistik total game, stock, dan publisher
  - Tombol aksi cepat untuk setiap game (Detail & Top-up)
  - Empty state ketika belum ada game
  - Responsive design untuk desktop dan mobile

### 2. Tambah Game Baru
- **Lokasi**: `/games/create`
- **Fitur**:
  - Form untuk menambah game baru
  - Validasi input real-time
  - Field yang tersedia:
    - Nama Game (wajib)
    - Publisher (wajib)
    - Deskripsi (wajib)
    - Stock (wajib, minimal 0)
    - Harga (opsional)
  - Tips pengisian untuk user

### 3. Detail Game
- **Lokasi**: `/games/{id}`
- **Fitur**:
  - Informasi lengkap game
  - Status stock dengan indikator visual
  - Statistik game
  - Breadcrumb navigation
  - Aksi cepat (Top-up & Kembali)
  - Timestamp created_at dan updated_at

### 4. Top-up Stock
- **Lokasi**: `/games/{id}/topup`
- **Fitur**:
  - Form untuk menambah stock game
  - Preview perubahan stock real-time
  - Validasi input
  - Informasi game yang akan di-top-up
  - Breadcrumb navigation

## Teknologi yang Digunakan

### Frontend
- **Tailwind CSS**: Framework CSS utility-first
- **Font Awesome**: Icon library
- **Vanilla JavaScript**: Untuk interaksi client-side

### Backend
- **Laravel**: PHP framework
- **GraphQL**: Untuk komunikasi dengan API
- **HTTP Client**: Untuk request ke GraphQL endpoint

## Struktur File

```
resources/views/
├── layouts/
│   └── app.blade.php          # Layout utama
└── games/
    ├── index.blade.php        # Halaman daftar game
    ├── create.blade.php       # Halaman tambah game
    ├── show.blade.php         # Halaman detail game
    └── topup.blade.php        # Halaman top-up stock
```

## Routes

```php
Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
Route::post('/games', [GameController::class, 'store'])->name('games.store');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('/games/{id}/topup', [GameController::class, 'topupForm'])->name('games.topup');
Route::post('/games/{id}/topup', [GameController::class, 'topup'])->name('games.topup.store');
```

## GraphQL Integration

UI menggunakan GraphQL untuk komunikasi dengan backend:

### Queries
- `listGames`: Untuk mendapatkan semua game
- `createGame`: Untuk membuat game baru
- `topUpGame`: Untuk menambah stock game

### Mutations
- `createGame`: Membuat game baru
- `topUpGame`: Menambah stock game

## Fitur UI/UX

### 1. Responsive Design
- Mobile-first approach
- Grid layout yang adaptif
- Navigation yang responsif

### 2. Visual Feedback
- Loading states
- Success/error messages
- Hover effects
- Color-coded status indicators

### 3. User Experience
- Breadcrumb navigation
- Consistent button styling
- Form validation
- Preview functionality
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

2. Pastikan GraphQL endpoint tersedia di `http://localhost:8000/graphql`

3. Akses UI melalui browser:
   - Dashboard: `http://localhost:8000`
   - Tambah Game: `http://localhost:8000/games/create`

## Dependencies

### Composer
- `laravel/framework`
- `guzzlehttp/guzzle` (untuk HTTP client)

### NPM (jika diperlukan)
- `tailwindcss` (sudah menggunakan CDN)

## Customization

### Styling
- Edit file `resources/views/layouts/app.blade.php` untuk mengubah layout utama
- Modifikasi class Tailwind CSS untuk mengubah tampilan
- Tambahkan custom CSS di section `<style>` pada layout

### Functionality
- Edit `app/Http/Controllers/GameController.php` untuk mengubah logika
- Modifikasi GraphQL queries di controller
- Tambahkan validasi custom di method store dan topup

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
   - Pencarian game berdasarkan nama
   - Filter berdasarkan publisher
   - Sort berdasarkan berbagai kriteria

2. **Bulk Operations**
   - Top-up multiple games sekaligus
   - Bulk delete games

3. **Analytics Dashboard**
   - Chart untuk visualisasi data
   - Export data ke Excel/PDF

4. **Real-time Updates**
   - WebSocket untuk update real-time
   - Notifikasi perubahan stock

5. **Advanced Features**
   - Image upload untuk game
   - Rich text editor untuk deskripsi
   - Version control untuk perubahan 
