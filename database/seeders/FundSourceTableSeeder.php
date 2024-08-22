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
            ['name'=>'STF', 'category_id'=> '2'],
            ['name'=>'GAA', 'category_id'=> '1'],
            ['name'=>'IGP', 'category_id'=> '2'],
            ['name'=>'TF', 'category_id'=> '2'],
            ['name'=> 'TES', 'category_id'=> '2'],
        ];

        foreach ($fundSources as $key => $fundSource) {
            FundSource::create([
                'category_id'  =>  $fundSource['category_id'],
                'abbreviation'  =>  $fundSource['name'],
            ]);
        }
    }
}
