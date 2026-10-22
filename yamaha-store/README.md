# Yamaha Store – CRUD Laravel

CRUD data sepeda motor (nama produk, harga, qty, gambar) dengan Laravel 12.
Fitur: tambah, ubah, hapus, upload gambar (JPG/PNG/WEBP maks. 2 MB), pencarian, total produk & total stok.

## Cara menjalankan (XAMPP / Laragon)

Kebutuhan: PHP 8.2+, Composer, MySQL.

1. Buat database kosong bernama `db_yamaha` lewat phpMyAdmin.
2. Buka terminal di folder proyek ini, lalu jalankan:

```
composer install
copy .env.example .env        (Linux/Mac: cp .env.example .env)
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

3. Buka http://127.0.0.1:8000

Jika MySQL kamu memakai password/port lain, ubah `DB_PASSWORD` / `DB_PORT` di file `.env`.

## Struktur penting

| File | Fungsi |
|---|---|
| `routes/web.php` | Route resource `produk` |
| `app/Http/Controllers/ProdukController.php` | index, create, store, edit, update, destroy + upload gambar |
| `app/Models/Produk.php` | Model tabel `produks` |
| `database/migrations/..._create_produks_table.php` | Struktur tabel |
| `database/seeders/ProdukSeeder.php` | Data contoh (N-Max, Soul-GT, Astrea) |
| `resources/views/produk/*.blade.php` | Halaman daftar, tambah, ubah |
| `public/uploads/` | Tempat gambar produk |
