# Website Profil Desa

Website profil desa berbasis Laravel 12 dengan fitur lengkap untuk mengelola informasi desa, berita, layanan publik, dan galeri foto.

## Fitur

### Frontend

- **Homepage**: Menampilkan berita terbaru, layanan, dan galeri foto
- **Profil Desa**: Informasi lengkap desa dan struktur pemerintahan
- **Berita**: Daftar dan detail berita/pengumuman desa
- **Galeri**: Galeri foto dengan filter kategori
- **Layanan**: Informasi layanan publik lengkap dengan persyaratan dan prosedur
- **Kontak**: Formulir kontak untuk masyarakat

### Admin Panel

- **Dashboard**: Statistik ringkasan (berita, pemerintahan, layanan, pesan kontak)
- **Kelola Berita**: CRUD berita dengan upload gambar dan status publikasi
- **Kelola Pemerintahan**: CRUD data pejabat desa dengan foto
- **Kelola Layanan**: CRUD layanan publik dengan icon
- **Kelola Galeri**: CRUD galeri foto dengan kategorisasi
- **Kelola Pesan Kontak**: Melihat dan mengelola pesan dari masyarakat
- **Kelola Profil Desa**: Edit informasi lengkap profil desa

## Tech Stack

- **Laravel 12**: Framework PHP
- **MySQL**: Database
- **Tailwind CSS v4**: Styling
- **Vite**: Asset bundling
- **Blade**: Template engine

## Persyaratan Sistem

- PHP >= 8.4
- Composer
- Node.js & NPM
- MySQL/MariaDB

## Instalasi

1. **Clone repository**

    ```bash
    git clone <repository-url>
    cd websiteDesa
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Setup environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Konfigurasi database**

    Edit file `.env` dan sesuaikan konfigurasi database:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=websiteDesa
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Jalankan migrasi dan seeder**

    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Buat storage link**

    ```bash
    php artisan storage:link
    ```

7. **Build assets**

    ```bash
    npm run build
    ```

8. **Jalankan server**
    ```bash
    php artisan serve
    ```

Website akan tersedia di `http://localhost:8000`

## Akun Default Admin

Setelah menjalankan seeder, akun admin default:

- **Email**: admin@websitedesa.com
- **Password**: password
- **URL Login**: http://localhost:8000/admin/login

**Penting**: Segera ubah password default setelah login pertama kali!

## Development

Untuk development dengan hot reload:

```bash
npm run dev
```

## Struktur Folder Utama

```
├── app/
│   ├── Http/
│   │   ├── Controllers/           # Controllers frontend
│   │   └── Controllers/Admin/     # Controllers admin panel
│   └── Models/                     # Eloquent models
├── database/
│   ├── migrations/                 # Database migrations
│   └── seeders/                    # Database seeders
├── resources/
│   └── views/
│       ├── layouts/                # Layout templates
│       ├── admin/                  # Admin panel views
│       └── ...                     # Frontend views
├── routes/
│   └── web.php                     # Route definitions
└── public/
    ├── build/                      # Compiled assets
    └── storage/                    # Symlink to storage
```

## Troubleshooting

### File upload tidak tampil

Pastikan storage link sudah dibuat:

```bash
php artisan storage:link
```

### Assets tidak terupdate

Build ulang assets:

```bash
npm run build
```

### Error permission storage

```bash
chmod -R 775 storage bootstrap/cache
```

## License

Project ini menggunakan [MIT license](https://opensource.org/licenses/MIT).
