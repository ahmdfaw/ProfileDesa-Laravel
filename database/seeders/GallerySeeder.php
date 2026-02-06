<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            ['title' => 'Kegiatan Gotong Royong', 'description' => 'Kegiatan gotong royong warga desa', 'category' => 'Kegiatan', 'order' => 1],
            ['title' => 'Penyuluhan Kesehatan', 'description' => 'Penyuluhan kesehatan ibu dan anak', 'category' => 'Kesehatan', 'order' => 2],
            ['title' => 'Festival Budaya Desa', 'description' => 'Festival budaya desa tahunan', 'category' => 'Budaya', 'order' => 3],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create([...$gallery, 'image' => 'placeholder.jpg']);
        }
    }
}
