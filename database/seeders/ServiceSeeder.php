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
                'name' => 'Pembuatan KTP',
                'description' => 'Layanan pembuatan Kartu Tanda Penduduk (KTP) elektronik',
                'requirements' => 'Kartu Keluarga, Akta Kelahiran, Pas Foto',
                'procedure' => 'Datang ke kantor desa, isi formulir, serahkan berkas',
                'processing_time' => '7 hari kerja',
                'cost' => 'Gratis',
                'order' => 1,
            ],
            [
                'name' => 'Pembuatan Kartu Keluarga',
                'description' => 'Layanan pembuatan Kartu Keluarga (KK)',
                'requirements' => 'KTP, Akta Nikah, Akta Kelahiran',
                'procedure' => 'Datang ke kantor desa, isi formulir, serahkan berkas',
                'processing_time' => '7 hari kerja',
                'cost' => 'Gratis',
                'order' => 2,
            ],
            [
                'name' => 'Surat Keterangan Domisili',
                'description' => 'Layanan pembuatan surat keterangan domisili',
                'requirements' => 'KTP, KK',
                'procedure' => 'Datang ke kantor desa, isi formulir',
                'processing_time' => '1 hari kerja',
                'cost' => 'Gratis',
                'order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
