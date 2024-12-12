<?php

namespace Database\Seeders;

use App\Models\PapType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PapTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $papTypes = [
            ['abbreviation' => 'GAS', 'name' => 'General Administration and Support'],
            ['abbreviation' => 'STO', 'name' => 'Support to Operations'],
            ['abbreviation' => 'OPS', 'name' => 'Operations'],
        ];

        foreach ($papTypes as $type) {
            PapType::create($type);
        }
    }
}
