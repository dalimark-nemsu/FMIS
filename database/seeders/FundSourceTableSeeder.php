<?php

namespace Database\Seeders;

use App\Models\FundSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FundSourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fundSources = [
            ['abbreviation' => 'GAA', 'name' => 'General Appropriations Act'],
            ['abbreviation' => 'STF', 'name' => 'Special Trust Fund'],
            ['abbreviation' => 'IGP', 'name' => 'Income Generating Projects'],
        ];

        foreach ($fundSources as $source) {
            FundSource::create($source);
        }
        
    }
}
