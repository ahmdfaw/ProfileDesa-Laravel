<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        $newsItems = [
            [
                'title' => 'Pembangunan Jalan Desa Dimulai',
                'content' => 'Pembangunan jalan desa sepanjang 2 km telah dimulai dan diharapkan selesai dalam 3 bulan.',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Penyaluran BLT Desa Tahap 2',
                'content' => 'Penyaluran Bantuan Langsung Tunai (BLT) Desa tahap 2 akan dilaksanakan minggu depan.',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Kegiatan Gotong Royong Minggu Ini',
                'content' => 'Seluruh warga diharapkan mengikuti kegiatan gotong royong membersihkan lingkungan desa.',
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($newsItems as $item) {
            News::create([
                ...$item,
                'slug' => Str::slug($item['title']),
                'user_id' => $admin->id,
                'views' => rand(10, 100),
            ]);
        }
    }
}
