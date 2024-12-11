<?php

namespace Database\Seeders;

use App\Models\BudgetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budgetTypes = [
            // GAA Types
            ['fund_source_id' => 1, 'name' => 'New Appropriations'], // Assuming GAA has ID = 1
            ['fund_source_id' => 1, 'name' => 'Automatic Appropriations'],
            ['fund_source_id' => 1, 'name' => 'Special Purpose Fund'],
            ['fund_source_id' => 1, 'name' => 'Continuing Appropriations'],

            // STF Types
            ['fund_source_id' => 2, 'name' => 'Current Year Budget'], // Assuming STF has ID = 2
            ['fund_source_id' => 2, 'name' => 'Earmarked Projects'],
        ];

        foreach ($budgetTypes as $type) {
            BudgetType::create($type);
        }
    }
}
