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
            'name' => 'Dusun Contoh',
            'history' => 'Dusun Contoh didirikan pada tahun 1960 sebagai bagian dari wilayah administratif Desa Induk. Dusun ini memiliki sejarah panjang dalam kehidupan gotong royong dan kebersamaan warga.',
            'vision' => 'Mewujudkan Dusun Contoh yang rukun, sejahtera, dan berdaya',
            'mission' => 'Meningkatkan partisipasi warga, menjaga keharmonisan lingkungan, dan mengembangkan potensi masyarakat dusun',
            'geographic_location' => 'Dusun Contoh terletak di wilayah dataran rendah, berbatasan langsung dengan sungai dan area persawahan',
            'area' => '75 Ha',
            'population' => 850,
            'total_rw' => 2,
            'total_rt' => 6,
            'hamlet_head' => 'Bapak Kepala Dusun',
            'address' => 'Jl. Dusun Contoh No. 1, RT 01/RW 01',
            'phone' => '0812-3456-7890',
            'email' => 'dusuncontoh@gmail.com',
        ]);
    }
}
