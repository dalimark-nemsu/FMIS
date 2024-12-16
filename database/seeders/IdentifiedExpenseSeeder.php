<?php

namespace Database\Seeders;

use App\Models\IdentifiedExpense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentifiedExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = [
            'Office Supplies',
            'Semi-expendable equipment for office use',
            'Attendance to trainings and seminars conducted by external agencies and organizations',
            'Existing scholarships approved by the BOR',
            'Medicines (for Clinic use only)',
            'Fuel',
            'Maintenance of equipment and vehicles',
            'Hiring of JOs, contractual faculty, and COS',
            'Utilities (water, light and power)',
            'Courier/Mailing expenses',
            'Maintenance of offices and classrooms',
            'Application/Renewal of fidelity bond',
            'Regular meetings',
            'Subscriptions',
            'Membership and contributions to organizations',
            'Honoraria',
        ];

        foreach ($expenses as $expense) {
            IdentifiedExpense::create(['name' => $expense]);
        }
    }
}
