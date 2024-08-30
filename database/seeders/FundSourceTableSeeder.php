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
        $fundSources=[
            ['name'=>'STF'],
            ['name'=>'GAA'],
            ['name'=>'IGP'],
            ['name'=>'TF'],
            ['name'=> 'TES'],
        ];

        foreach ($fundSources as $key => $fundSource) {
            FundSource::create([
                'abbreviation'  =>  $fundSource['name'],
            ]);
        }
    }
}
