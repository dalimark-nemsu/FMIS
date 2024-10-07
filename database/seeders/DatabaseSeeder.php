<?php

namespace Database\Seeders;

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
            // CategoryTableSeeder::class,
            BudgetYearTableSeeder::class,
            FundSourceTableSeeder::class,
            MajorFinalOutputTableSeeder::class,
            ProgramActivityProjectTableSeeder::class
            // ProgramActivityProjectTableSeeder::class
        ]);
    }
}
