<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['abbreviation' => 'Budget', 'name' => 'Budget Office', 'campus_id' => 1]
        ];

        foreach ($units as $key => $unit) {
            Unit::create([
                'abbreviation'  =>  $unit['abbreviation'],
                'name'  =>  $unit['name'],
                'campus_id'  =>  $unit['campus_id'],
            ]);
        }
    }
}
