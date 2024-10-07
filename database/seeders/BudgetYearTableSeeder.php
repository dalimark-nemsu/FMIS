<?php

namespace Database\Seeders;

use App\Models\BudgetYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the current year
        $currentYear = date('Y');

        // Loop through the current year and next year
        for ($year = $currentYear; $year <= $currentYear + 1; $year++) {
            BudgetYear::create([
                'year' => $year,
                'is_active' => ($year == $currentYear) // Set the current year as active
            ]);
        }
    }
}
