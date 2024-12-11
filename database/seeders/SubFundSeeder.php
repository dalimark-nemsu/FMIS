<?php

namespace Database\Seeders;

use App\Models\SubFund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subFunds = [
            // GAA Sub-Funds
            ['fund_source_id' => 1, 'name' => 'Agency Specific Budget'], // Assuming GAA has ID = 1
            ['fund_source_id' => 1, 'name' => 'Retirement and Life Insurance Premiums'],
            ['fund_source_id' => 1, 'name' => 'Miscellaneous Personnel Benefits Fund'],
            ['fund_source_id' => 1, 'name' => 'Pension and Gratuity Fund'],
        ];

        foreach ($subFunds as $subFund) {
            SubFund::create($subFund);
        }
    }
}
