<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Posyandu Balita',
                'description' => 'Kegiatan rutin posyandu untuk pemantauan tumbuh kembang balita dan ibu hamil',
                'requirements' => 'Balita usia 0-5 tahun dan ibu hamil di wilayah dusun',
                'procedure' => 'Datang ke lokasi posyandu sesuai jadwal, bawa buku KMS',
                'processing_time' => 'Setiap tanggal 10 bulan berjalan',
                'cost' => 'Kader Posyandu',
                'order' => 1,
            ],
            [
                'name' => 'Gotong Royong Lingkungan',
                'description' => 'Kegiatan bersih-bersih lingkungan dusun secara bersama-sama oleh seluruh warga',
                'requirements' => 'Seluruh warga dusun',
                'procedure' => 'Kumpul di titik yang telah ditentukan, bawa peralatan kebersihan',
                'processing_time' => 'Setiap minggu pertama bulan berjalan (hari Minggu)',
                'cost' => 'Kepala Dusun & RT/RW',
                'order' => 2,
            ],
            [
                'name' => 'Rapat Warga RT/RW',
                'description' => 'Pertemuan rutin warga untuk membahas perkembangan dan kebutuhan lingkungan dusun',
                'requirements' => 'Perwakilan kepala keluarga tiap rumah',
                'procedure' => 'Hadir di balai dusun/rumah pengurus RT sesuai jadwal',
                'processing_time' => 'Setiap bulan (menyesuaikan RT masing-masing)',
                'cost' => 'Ketua RT/RW masing-masing',
                'order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
