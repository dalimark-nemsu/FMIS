<?php

namespace Database\Seeders;

use App\Models\AllotmentClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllotmentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            ['abbreviation' => 'PS', 'name' => 'Personnel Services'],
            ['abbreviation' => 'MOOE', 'name' => 'Maintenance and Other Operating Expenses'],
            ['abbreviation' => 'CO', 'name' => 'Capital Outlay'],
        ];

        foreach ($classes as $class) {
            AllotmentClass::create($class);
        }
    }
}
