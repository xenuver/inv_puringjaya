# Panduan Deployment Laravel ke Coolify (Docker Compose)

Berikut adalah panduan langkah demi langkah untuk melakukan deploy aplikasi Laravel ini ke server Coolify menggunakan Docker Compose.

## Persiapan Repositori
Pastikan semua file berikut sudah di-commit dan di-push ke repositori Git Anda (misalnya GitHub/GitLab):
1. `Dockerfile`
2. `docker-compose.yml`
3. `docker-entrypoint.sh`
4. `database/seeders/DatabaseSeeder.php` (yang sudah dimodifikasi)

> **Catatan**: Jika file `.env` tidak di-push (biasanya di `.gitignore`), itu tidak masalah. Environment variables akan diatur langsung di Coolify.

## Langkah Setup di Coolify

1. **Login ke Coolify Dashboard**
   Akses dashboard Coolify server VPS Anda.

2. **Buat Resource Baru**
   - Klik menu **Create New Resource** (atau tombol `+ New`).
   - Pilih **Project** (atau buat project baru jika belum ada), lalu pilih environment (contoh: `production`).

3. **Pilih Sumber (Source)**
   - Pilih sumber kode Anda, biasanya **GitHub App** (jika sudah terhubung) atau **Public/Private Repository**.
   - Pilih repository Git dari aplikasi Laravel Anda.
   - Tentukan branch yang akan di-deploy (misalnya `main` atau `master`).

4. **Pilih Build Pack (PENTING)**
   - Saat ditanya tipe aplikasi / build pack, **pilih Docker Compose** (jangan pilih Nixpacks).
   - Coolify akan secara otomatis mendeteksi file `docker-compose.yml` di dalam root direktori Anda.

5. **Konfigurasi Environment Variables (.env)**
   - Di dashboard Coolify untuk resource ini, masuk ke tab **Environment Variables**.
   - Masukkan variable penting dari Laravel Anda. Minimal yang harus ada:
     ```env
     APP_NAME=Laravel
     APP_ENV=production
     APP_KEY=base64:tHcomT0oBOkKjUzlr11LGpo3vko6yJAD2fBHgXEpBgk=
     APP_DEBUG=false
     APP_URL=https://rmpuringjaya.my.id

     DB_CONNECTION=mysql
     DB_HOST=db
     DB_PORT=3306
     DB_DATABASE=laravel_db
     DB_USERNAME=laravel_user
     DB_PASSWORD=invsandi123
     DB_ROOT_PASSWORD=invsandi123
     ```
   - **Catatan tentang Database**: Karena MariaDB (di `docker-compose.yml`) menggunakan environment variables ini, konfigurasi di atas sudah menyesuaikan password database Anda menjadi `invsandi123`.

6. **Konfigurasi Domain**
   - Masuk ke tab **Configuration / General** di layanan `app`.
   - Di bagian **Domains**, masukkan nama domain atau subdomain untuk aplikasi Anda (misal: `https://app.domain.com`).
   - Jika Anda menggunakan port 80 di dalam container (seperti yang kita atur di Dockerfile), Coolify akan otomatis me-routing traffic dari domain tersebut ke container aplikasi.

7. **Deploy**
   - Klik tombol **Deploy** di pojok kanan atas.
   - Coolify akan menarik (pull) kode Anda, mem-build `Dockerfile`, dan menjalankan `docker-compose`.

## Apa yang Terjadi Saat Deploy? (Otomatis)
Berdasarkan setup yang sudah dibuat:
1. **Dockerfile** akan menginstall ekstensi PHP, Composer dependencies, dan mengatur Apache.
2. Saat container berjalan, **docker-entrypoint.sh** akan otomatis dieksekusi, yang akan:
   - Menjalankan `php artisan storage:link` (otomatis menghubungkan storage ke public).
   - Menjalankan migrasi database (`php artisan migrate --force`).
   - Menjalankan seeder (`php artisan db:seed --force`). Seeder ini telah kita modifikasi agar hanya melakukan insert data SQL bawaan **jika tabel `users` masih kosong**. Jadi data lama Anda tidak akan tertimpa saat re-deploy!
3. **Database** (MariaDB) berjalan di background dan datanya aman disimpan di dalam Docker Volume (`db-data`).

Selesai! Aplikasi Anda akan langsung bisa diakses melalui domain yang Anda tentukan beserta dengan data awal yang sudah di-seed.
