<?php

namespace Database\Seeders;

use App\Models\PapType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CampusTableSeeder::class,
            UnitTableSeeder::class,
            PositionTableSeeder::class,
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            BudgetYearTableSeeder::class,
            FundSourceTableSeeder::class,
            BudgetTypeSeeder::class,
            SubFundSeeder::class,
            SchoolFeeClassificationSeeder::class,
            PapTypeSeeder::class,
            MajorFinalOutputTableSeeder::class,
            AllotmentClassSeeder::class,
            ObjectExpenditureSeeder::class,
            ProductCategoriesTableSeeder::class,
            ProgramActivityProjectTableSeeder::class
        ]);
    }
}
