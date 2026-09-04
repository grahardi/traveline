<?php

namespace Database\Seeders;

use App\Models\Armada;
use App\Models\Banner;
use App\Models\Layanan;
use App\Models\SiteSetting;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin default — SEGERA ganti password ini setelah deploy!
        User::updateOrCreate(
            ['email' => 'admin@traveline.web.id'],
            ['name' => 'Admin Traveline', 'password' => 'traveline123']
        );

        SiteSetting::updateOrCreate(['id' => 1], [
            'nama_perusahaan' => 'Traveline Trans Traveller',
            'tagline' => 'Jasa Tiket & Travel Segala Jurusan — Darat, Laut, Udara',
            'deskripsi' => 'Traveline Trans Traveller adalah penyedia jasa transportasi yang melayani tiket bus AKAP, tiket pesawat domestik & internasional, tiket kapal laut (Pelni & swasta), travel/shuttle segala jurusan, serta pengiriman paket kilat.',
            'alamat_kepanjen' => 'Jl. Sultan Agung No. 14, Kepanjen, Kabupaten Malang',
            'alamat_turen' => 'Jl. Panglima Sudirman No. 217 (Selatan PLN), Turen, Kabupaten Malang',
            'whatsapp' => '6285103578000',
            'telepon' => '6285103578000',
            'email' => 'info@traveline.web.id',
            'instagram' => 'https://www.instagram.com/traveline_travel/',
            'facebook' => 'https://www.facebook.com/profile.php?id=100009176211535',
            'tiktok' => 'https://www.tiktok.com/@travelineturen',
            'youtube' => 'https://www.youtube.com/channel/UCZnJhwtBBH2p_Lo7FLCY-sA',
        ]);

        $bus = [
            ['Malang', 'Jakarta'], ['Malang', 'Bekasi'], ['Malang', 'Tangerang'],
            ['Malang', 'Bogor'], ['Malang', 'Bandung'], ['Malang', 'Bali'],
            ['Malang', 'Sumatra'], ['Malang', 'Medan'],
        ];
        foreach ($bus as $i => [$asal, $tujuan]) {
            Layanan::updateOrCreate(
                ['nama' => "Tiket Bus {$asal} - {$tujuan}", 'kategori' => 'bus'],
                [
                    'asal' => $asal,
                    'tujuan' => $tujuan,
                    'satuan_harga' => 'per orang',
                    'deskripsi' => "Tiket bus AKAP jurusan {$asal} - {$tujuan}. Reservasi bisa langsung via WhatsApp, kursi terbatas.",
                    'unggulan' => $i < 4,
                    'aktif' => true,
                    'urutan' => $i,
                ]
            );
        }

        $travel = [
            ['Malang', 'Ngawi'], ['Malang', 'Sragen'], ['Malang', 'Solo'],
            ['Malang', 'Klaten'], ['Malang', 'Jogja'],
        ];
        foreach ($travel as $i => [$asal, $tujuan]) {
            Layanan::updateOrCreate(
                ['nama' => "Travel {$asal} - {$tujuan}", 'kategori' => 'travel'],
                [
                    'asal' => $asal,
                    'tujuan' => $tujuan,
                    'satuan_harga' => 'per orang',
                    'deskripsi' => "Layanan travel/shuttle door to door jurusan {$asal} - {$tujuan}.",
                    'unggulan' => $i < 2,
                    'aktif' => true,
                    'urutan' => $i,
                ]
            );
        }

        Layanan::updateOrCreate(
            ['nama' => 'Tiket Pesawat Domestik & Internasional', 'kategori' => 'pesawat'],
            [
                'deskripsi' => 'Melayani pemesanan tiket pesawat untuk rute domestik maupun internasional dari berbagai maskapai.',
                'satuan_harga' => 'per orang',
                'unggulan' => true,
                'aktif' => true,
            ]
        );

        Layanan::updateOrCreate(
            ['nama' => 'Tiket Kapal Laut (Pelni & Swasta)', 'kategori' => 'kapal'],
            [
                'deskripsi' => 'Pemesanan tiket kapal laut Pelni maupun perusahaan pelayaran swasta untuk berbagai tujuan.',
                'satuan_harga' => 'per orang',
                'unggulan' => false,
                'aktif' => true,
            ]
        );

        Layanan::updateOrCreate(
            ['nama' => 'Kirim Paket Kilat', 'kategori' => 'paket'],
            [
                'deskripsi' => 'Layanan pengiriman paket kilat, estimasi sehari sampai untuk tujuan tertentu.',
                'satuan_harga' => 'per kg',
                'unggulan' => false,
                'aktif' => true,
            ]
        );

        Banner::updateOrCreate(
            ['judul' => 'Agendakan Perjalananmu Bersama Traveline'],
            [
                'subjudul' => 'Tiket Bus, Travel, Pesawat & Kapal Laut — Segala Jurusan',
                'gambar' => null,
                'tampilkan_teks' => true,
                'urutan' => 1,
                'aktif' => true,
            ]
        );

        Banner::updateOrCreate(
            ['judul' => 'Promo Malang - Jakarta, Bogor, Tangerang 360K'],
            [
                'subjudul' => null,
                'gambar' => 'images/promo/malang-jakarta-bogor-tangerang-landscape.png',
                'tampilkan_teks' => false,
                'urutan' => 2,
                'aktif' => true,
            ]
        );

        $testimonis = [
            ['Rina', 'Turen', 'Pelayanannya ramah, ruang tunggu nyaman ada wifi & kopi gratis. Bus selalu on time.', 5],
            ['Dedi', 'Kepanjen', 'Sudah langganan pesan tiket travel ke Jogja lewat sini, prosesnya cepat dan gampang.', 5],
            ['Sari', 'Malang', 'Kirim paket kilat sampai sehari, mantap buat kebutuhan mendadak.', 4],
        ];
        foreach ($testimonis as [$nama, $daerah, $pesan, $rating]) {
            Testimoni::updateOrCreate(
                ['nama' => $nama, 'pesan' => $pesan],
                ['asal_daerah' => $daerah, 'rating' => $rating, 'aktif' => true]
            );
        }

        // Armada contoh — berdasarkan poster promo PO Haryanto "The Ocean"
        $haryanto = Armada::updateOrCreate(
            ['slug' => 'po-haryanto-the-ocean'],
            [
                'nama' => 'PO Haryanto - The Ocean',
                'deskripsi' => 'Armada bus eksekutif untuk trayek Malang - Jakarta, Bogor, dan Tangerang. Berangkat tiap hari dengan kenyamanan kelas eksekutif.',
                'fitur_utama' => ['Class Executif', 'AC', 'TV', 'Charger', 'Leg Rest'],
                'fitur_lainnya' => ['Bantal & Selimut', 'Toilet', 'Snack', 'Air Mineral'],
                'kapasitas_seat' => 40,
                'kursi_terbooking' => 0,
                'aktif' => true,
                'urutan' => 1,
            ]
        );

        $rutePoHaryanto = Layanan::whereIn('nama', [
            'Tiket Bus Malang - Jakarta',
            'Tiket Bus Malang - Bogor',
            'Tiket Bus Malang - Tangerang',
        ])->pluck('id');

        $haryanto->layanans()->sync($rutePoHaryanto);
    }
}
