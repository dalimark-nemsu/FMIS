<?php

namespace Database\Seeders;

use App\Models\MajorFinalOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorFinalOutputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majorFinancialOutputs = [
            ['abbreviation' => 'GAS', 'name' => 'General Administration and Support'],
            ['abbreviation' => 'STO', 'name' => 'Support to Operation'],
            ['abbreviation' => 'HEP', 'name' => 'Higher Education Program'],
            ['abbreviation' => 'AEP', 'name' => 'Advanced Education Program'],
            ['abbreviation' => 'RP', 'name' => 'Research Program'],
            ['abbreviation' => 'TAEP', 'name' => 'Technical Advisory and Extension Program'],
        ];

        foreach ($majorFinancialOutputs as $key => $majorFinancialOutput) {
            MajorFinalOutput::create([
                'abbreviation'  =>  $majorFinancialOutput['abbreviation'],
                'name'  =>  $majorFinancialOutput['name'],
            ]);
        }
    }
}
