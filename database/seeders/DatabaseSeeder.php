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
            ['nama' => 'Travel Malang - Semarang', 'kategori' => 'travel'],
            [
                'asal' => 'Malang',
                'tujuan' => 'Semarang',
                'harga' => 230000,
                'satuan_harga' => 'per orang',
                'deskripsi' => 'Travel murah jurusan Malang - Salatiga - Ungaran - Semarang, armada Luxio, driver ramah dan profesional.',
                'aktif' => true,
                'urutan' => 6,
            ]
        );

        Layanan::updateOrCreate(
            ['nama' => 'Travel Malang - Surabaya (Juanda/Perak)', 'kategori' => 'travel'],
            [
                'asal' => 'Malang',
                'tujuan' => 'Surabaya',
                'satuan_harga' => 'per orang',
                'deskripsi' => 'Layanan antar jemput dari dan ke Bandara Djuanda, Pelabuhan Perak, dan Kota Surabaya.',
                'aktif' => true,
                'urutan' => 7,
            ]
        );

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

        // Armada Travel — foto asli mobil Hiace Traveline
        $hiace = Armada::updateOrCreate(
            ['slug' => 'traveline-hiace'],
            [
                'nama' => 'Toyota Hiace - Traveline',
                'foto_utama' => 'images/armada/traveline-hiace.jpg',
                'deskripsi' => 'Armada travel/shuttle Traveline untuk trayek Malang - Ngawi, Sragen, Solo, Klaten, dan Jogja. Door to door, berangkat tiap hari.',
                'fitur_utama' => ['AC', 'Kursi Nyaman', 'Door to Door'],
                'fitur_lainnya' => ['Driver Profesional', 'Bagasi Luas'],
                'kapasitas_seat' => 15,
                'kursi_terbooking' => 0,
                'aktif' => true,
                'urutan' => 2,
            ]
        );

        $ruteHiace = Layanan::where('kategori', 'travel')->pluck('id');
        $hiace->layanans()->sync($ruteHiace);

        // Armada Bus ALS — foto asli, untuk trayek Malang - Sumatra
        $als = Armada::updateOrCreate(
            ['slug' => 'bus-als-malang-sumatra'],
            [
                'nama' => 'PO ALS - Malang Sumatra',
                'foto_utama' => 'images/armada/bus-als-malang-sumatra.jpg',
                'deskripsi' => 'Armada bus eksekutif ALS untuk trayek jarak jauh Malang - Sumatra.',
                'fitur_utama' => ['Executive Class', 'AC', 'Reclining Seat'],
                'fitur_lainnya' => ['Leg Rest', 'Toilet'],
                'kapasitas_seat' => 32,
                'kursi_terbooking' => 0,
                'aktif' => true,
                'urutan' => 3,
            ]
        );

        $ruteAls = Layanan::where('nama', 'Tiket Bus Malang - Sumatra')->pluck('id');
        $als->layanans()->sync($ruteAls);

        // Armada lain — diambil dari arsip lama situs Traveline (dongkrakbisnis).
        // Belum ada foto asli yang berhasil diunduh untuk operator-operator ini
        // (tersimpan di server lama yang sudah tidak bisa diakses), jadi foto_utama
        // dikosongkan dulu — tampilan akan pakai gradient default, admin bisa upload
        // foto asli lewat panel nanti.
        $buatArmada = function (string $slug, array $data, array $namaRute) {
            $armada = Armada::updateOrCreate(['slug' => $slug], $data + [
                'kursi_terbooking' => 0,
                'aktif' => true,
            ]);
            $armada->layanans()->sync(Layanan::whereIn('nama', $namaRute)->pluck('id'));

            return $armada;
        };

        $buatArmada('pahala-kencana', [
            'nama' => 'PO Pahala Kencana',
            'deskripsi' => 'Armada bus AKAP Pahala Kencana melayani trayek Malang - Jakarta, Tangerang, Bogor, Bekasi, dan Bandung, dilengkapi sistem tracking online.',
            'fitur_utama' => ['AC', 'TV LED', 'Audio Video', 'Leg Rest'],
            'fitur_lainnya' => ['Toilet', 'Bantal & Selimut', 'Makan & Snack', 'Sistem Tracking Online'],
            'urutan' => 4,
        ], [
            'Tiket Bus Malang - Jakarta', 'Tiket Bus Malang - Tangerang',
            'Tiket Bus Malang - Bogor', 'Tiket Bus Malang - Bekasi', 'Tiket Bus Malang - Bandung',
        ]);

        $buatArmada('mtrans-executive', [
            'nama' => 'Bus Mtrans - Executive Class',
            'deskripsi' => 'Bus Mtrans kelas eksekutif jurusan Malang - Denpasar (Bali), konfigurasi seat 2-2 dengan 30 kursi.',
            'fitur_utama' => ['Full AC', 'Reclining Seat', 'LED TV', 'USB Charger'],
            'fitur_lainnya' => ['Toilet', 'Snack', 'Smoking Room', 'Kursi Tebal & Empuk'],
            'kapasitas_seat' => 30,
            'urutan' => 5,
        ], ['Tiket Bus Malang - Bali']);

        $buatArmada('mtrans-sultan-class', [
            'nama' => 'Bus Mtrans - Sultan Class',
            'deskripsi' => 'Varian Mtrans dengan konsep social distancing, konfigurasi seat 1-1-1 untuk kenyamanan dan keamanan ekstra jurusan Malang - Bali.',
            'fitur_utama' => ['Full AC', 'Seat 1-1-1 (Social Distancing)'],
            'fitur_lainnya' => ['Kursi Lebih Lega'],
            'urutan' => 6,
        ], ['Tiket Bus Malang - Bali']);

        $buatArmada('kramatdjati', [
            'nama' => 'PO Kramatdjati',
            'deskripsi' => 'Bus eksekutif Kramatdjati jurusan Malang - Jakarta (Pulogebang, Pondok Pinang, Lebak Bulus, Kampung Rambutan, Cililitan).',
            'fitur_utama' => ['AC', 'Reclining Seat', 'Smoking Room'],
            'fitur_lainnya' => ['Toilet', 'Bantal & Selimut', 'Snack & Air Mineral', 'Makan'],
            'urutan' => 7,
        ], ['Tiket Bus Malang - Jakarta']);

        $buatArmada('lorena-super-executive', [
            'nama' => 'Lorena - Super Executive (Double Decker)',
            'deskripsi' => 'Bus tingkat (double decker) Lorena kelas Super Executive jurusan Malang - Jakarta (Pulogebang, Lebak Bulus), Bekasi (Baranangsiang), dan Bogor (Tajur).',
            'fitur_utama' => ['Double Decker', 'Seat 2-2', 'Full AC', 'TV/DVD'],
            'fitur_lainnya' => ['Toilet', 'Reclining Seat', 'Bantal & Selimut', 'Dispenser Air', 'Smoking Room', 'Makan 2X'],
            'urutan' => 8,
        ], ['Tiket Bus Malang - Jakarta', 'Tiket Bus Malang - Bogor']);

        $buatArmada('lorena-executive', [
            'nama' => 'Lorena - Executive Class',
            'deskripsi' => 'Bus Lorena kelas eksekutif jurusan Malang - Jakarta (Pulogebang, Lebak Bulus, Klari), konfigurasi seat 2-2.',
            'fitur_utama' => ['Seat 2-2', 'AC', 'TV/DVD', 'Reclining Seat'],
            'fitur_lainnya' => ['Bantal & Selimut', 'Makan 1X', 'Smoking Room', 'Toilet'],
            'urutan' => 9,
        ], ['Tiket Bus Malang - Jakarta']);

        $buatArmada('setiawan', [
            'nama' => 'PO Setiawan',
            'deskripsi' => 'Bus Setiawan (khas livery oranye) sudah beroperasi lebih dari 33 tahun, trayek Ponorogo - Denpasar, bisa naik dari kantor Traveline Kepanjen.',
            'fitur_utama' => ['Executive Class', 'AC', 'Seat 2-2'],
            'fitur_lainnya' => ['Smoking Room', 'Toilet', 'Makan, Snack & Air Mineral'],
            'urutan' => 10,
        ], ['Tiket Bus Malang - Bali']);

        $buatArmada('malang-indah', [
            'nama' => 'PO Malang Indah',
            'deskripsi' => 'Bus Malang Indah (livery hijau khas, motto "Work with Heart") berdiri sejak 1980, jurusan Malang - Bali.',
            'fitur_utama' => ['AC', 'Reclining Seat', 'Leg Rest'],
            'fitur_lainnya' => ['Toilet', 'Bantal & Selimut', 'Makan 1X', 'Snack & Air Mineral', 'Driver Profesional'],
            'urutan' => 11,
        ], ['Tiket Bus Malang - Bali']);

        $buatArmada('purnayasa', [
            'nama' => 'PO Purnayasa',
            'deskripsi' => 'Bus Purnayasa kelas eksekutif jurusan Malang - Bali, dilengkapi dispenser kopi & teh gratis.',
            'fitur_utama' => ['AC', 'Leg Rest', 'Reclining Seat'],
            'fitur_lainnya' => ['Dispenser Kopi & Teh Gratis', 'Bantal & Selimut', 'Snack & Air Mineral', 'Makan', 'Smoking Room'],
            'urutan' => 12,
        ], ['Tiket Bus Malang - Bali']);

        $buatArmada('arimbi-travel-luxio', [
            'nama' => 'Arimbi Travel - Luxio',
            'deskripsi' => 'Travel murah armada Luxio jurusan Malang - Salatiga - Ungaran - Semarang.',
            'fitur_utama' => ['AC', 'Driver Ramah & Profesional'],
            'fitur_lainnya' => ['Makan 1X'],
            'urutan' => 13,
        ], ['Travel Malang - Semarang']);

        $buatArmada('travel-juanda-surabaya', [
            'nama' => 'Travel Juanda & Surabaya Kota',
            'deskripsi' => 'Layanan antar jemput dari dan ke Bandara Djuanda, Pelabuhan Perak, dan Kota Surabaya.',
            'fitur_utama' => ['Antar Jemput Bandara & Pelabuhan'],
            'fitur_lainnya' => [],
            'urutan' => 14,
        ], ['Travel Malang - Surabaya (Juanda/Perak)']);
    }
}
