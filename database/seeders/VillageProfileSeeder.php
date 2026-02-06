<?php

namespace Database\Seeders;

use App\Models\VillageProfile;
use Illuminate\Database\Seeder;

class VillageProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VillageProfile::create([
            'name' => 'Desa Contoh',
            'history' => 'Desa Contoh didirikan pada tahun 1950 dan memiliki sejarah panjang dalam pengembangan masyarakat lokal.',
            'vision' => 'Mewujudkan Desa Contoh yang maju, mandiri, dan sejahtera',
            'mission' => 'Meningkatkan kualitas pelayanan publik, memberdayakan masyarakat, dan mengembangkan potensi desa',
            'geographic_location' => 'Desa Contoh terletak di dataran rendah dengan luas wilayah 500 hektar',
            'area' => '500 Ha',
            'population' => 5000,
            'districts' => 5,
            'village_head' => 'Bapak Kepala Desa',
            'address' => 'Jl. Desa Contoh No. 1',
            'phone' => '021-12345678',
            'email' => 'info@desacontoh.go.id',
        ]);
    }
}
