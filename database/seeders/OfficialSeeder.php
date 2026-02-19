<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officials = [
            ['name' => 'Bapak Kepala Dusun', 'position' => 'Kepala Dusun (Kadus)', 'type' => 'kadus', 'order' => 1],
            ['name' => 'Bapak Ketua RW 01', 'position' => 'Ketua RW 01', 'type' => 'rw', 'order' => 2],
            ['name' => 'Bapak Ketua RW 02', 'position' => 'Ketua RW 02', 'type' => 'rw', 'order' => 3],
            ['name' => 'Bapak Ketua RT 01', 'position' => 'Ketua RT 01/RW 01', 'type' => 'rt', 'order' => 4],
            ['name' => 'Ibu Ketua RT 02', 'position' => 'Ketua RT 02/RW 01', 'type' => 'rt', 'order' => 5],
            ['name' => 'Bapak Ketua RT 03', 'position' => 'Ketua RT 03/RW 01', 'type' => 'rt', 'order' => 6],
            ['name' => 'Bapak Ketua RT 04', 'position' => 'Ketua RT 04/RW 02', 'type' => 'rt', 'order' => 7],
            ['name' => 'Ibu Ketua RT 05', 'position' => 'Ketua RT 05/RW 02', 'type' => 'rt', 'order' => 8],
            ['name' => 'Bapak Ketua RT 06', 'position' => 'Ketua RT 06/RW 02', 'type' => 'rt', 'order' => 9],
        ];

        foreach ($officials as $official) {
            Official::create($official);
        }
    }
}
