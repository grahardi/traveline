# Traveline Turen — traveline.web.id

Website profil bisnis / katalog jasa **Traveline Trans Traveller** (tiket bus, travel/shuttle, tiket pesawat, tiket kapal laut, kirim paket) berbasis **Laravel 13 + PostgreSQL**. Pemesanan diarahkan langsung ke **WhatsApp** (belum pakai payment gateway — sesuai kesepakatan awal).

Konten awal (rute bus/travel, alamat, kontak) diambil dari akun sosial media Traveline Trans Traveller (TikTok/Facebook/Milkshake) sebagai data sementara — silakan sesuaikan lagi lewat panel admin.

## Struktur Fitur

**Situs publik**
- `/` — Beranda: hero banner, kategori layanan, layanan unggulan, testimoni, CTA WhatsApp
- `/layanan` — Katalog semua layanan (filter kategori: bus, travel, pesawat, kapal, paket + pencarian)
- `/layanan/{slug}` — Detail layanan + tombol pesan WhatsApp
- `/tentang-kami`, `/kontak`, `/testimoni`

**Admin panel** (`/admin`)
- Login (akun admin dari tabel `users`)
- Kelola Banner (hero beranda)
- Kelola Layanan/Rute (CRUD, upload gambar, kategori, harga, unggulan/aktif)
- Kelola Testimoni
- Pengaturan Situs (nama perusahaan, alamat 2 kantor, WhatsApp, email, sosial media, Maps embed)

## Deploy di Server (aaPanel + Nginx, PHP 8.2+/PostgreSQL)

1. **Upload project** ke folder situs (misal via git clone dari GitHub setelah Anda push repo ini).

2. **Install dependency PHP** (di server yang punya akses ke Packagist):
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Siapkan .env**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit `.env`:
   - `APP_URL=https://traveline.web.id`
   - `DB_CONNECTION=pgsql`, `DB_HOST`, `DB_PORT=5432`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` (buat database & user PostgreSQL dulu di aaPanel)
   - `WHATSAPP_ADMIN_NUMBER` (opsional, cadangan — nomor WA utama diatur lewat menu **Pengaturan Situs** di admin panel setelah seeding)

4. **Migrasi & seed data awal**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
   Ini akan membuat:
   - Akun admin: **admin@traveline.web.id** / **traveline123** — **wajib segera diganti** lewat `php artisan tinker` atau tambahkan fitur ganti password (belum ada di versi awal ini).
   - Data rute bus, travel, dan pengaturan situs berdasarkan info yang saya temukan dari sosmed Traveline (silakan koreksi lewat admin panel, terutama nomor WhatsApp resmi & harga tiket).

5. **Link storage** (untuk upload gambar banner/layanan/testimoni)
   ```bash
   php artisan storage:link
   ```

6. **Nginx**: arahkan document root ke folder `public/`, seperti pola project Laravel Anda yang lain di aaPanel.

7. **Set permission** folder `storage` dan `bootstrap/cache` agar bisa ditulis oleh user web server (`www`):
   ```bash
   chown -R www:www storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   ```

8. Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env` sebelum go-live.

## Catatan Teknis

- Tidak pakai Vite/npm build — semua styling pakai **Bootstrap 5 + Bootstrap Icons via CDN** (sama seperti pola company profile Bellanet Anda), jadi tidak perlu `npm install`/`npm run build`.
- Semua nomor WhatsApp pemesanan otomatis mengikuti field `whatsapp` di **Pengaturan Situs** — ubah sekali, semua tombol "Pesan via WhatsApp" ikut berubah.
- Kategori layanan (`bus`, `travel`, `pesawat`, `kapal`, `paket`) didefinisikan di `App\Models\Layanan::KATEGORI` — mudah ditambah kalau nanti perlu kategori baru (misal "sewa mobil").
- Belum ada payment gateway/booking kursi (sesuai pilihan Anda: katalog + WhatsApp). Kalau nanti mau upgrade ke booking online dengan pembayaran (Midtrans/Xendit) atau form pesan tersimpan di database dengan konfirmasi admin, tinggal lanjutkan dari struktur `Layanan` yang sudah ada.
- Belum ada halaman ganti password admin — sarankan ditambahkan sebelum produksi, atau ganti manual lewat `php artisan tinker`:
  ```php
  $u = App\Models\User::first();
  $u->password = 'password-baru-yang-kuat';
  $u->save();
  ```

## Yang Perlu Anda Sesuaikan Setelah Deploy

- Nomor WhatsApp resmi (saat ini pakai nomor dari akun Milkshake mereka, cek ulang kebenarannya)
- Harga tiket per rute (belum diisi — placeholder kosong, hanya rute Haryanto Turen yang diketahui ±Rp380.000)
- Foto/banner asli (saat ini fallback gradient, belum ada file gambar)
- Link Google Maps embed kantor
