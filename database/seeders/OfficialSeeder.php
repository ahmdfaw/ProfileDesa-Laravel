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
            ['name' => 'Bapak Kepala Desa', 'position' => 'Kepala Desa', 'order' => 1],
            ['name' => 'Ibu Sekretaris Desa', 'position' => 'Sekretaris Desa', 'order' => 2],
            ['name' => 'Bapak Kaur Pemerintahan', 'position' => 'Kaur Pemerintahan', 'order' => 3],
            ['name' => 'Ibu Kaur Keuangan', 'position' => 'Kaur Keuangan', 'order' => 4],
        ];

        foreach ($officials as $official) {
            Official::create($official);
        }
    }
}
