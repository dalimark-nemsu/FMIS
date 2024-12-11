<?php

namespace Database\Seeders;

use App\Models\SchoolFeeClassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolFeeClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schoolFeeClassifications = [
            // STF School Fee Classifications
            ['fund_source_id' => 2, 'name' => 'Non-Fiduciary'], // Assuming STF has ID = 2
            ['fund_source_id' => 2, 'name' => 'Fiduciary'],
        ];

        foreach ($schoolFeeClassifications as $classification) {
            SchoolFeeClassification::create($classification);
        }
    }
}
