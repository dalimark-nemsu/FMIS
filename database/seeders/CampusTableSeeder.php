<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campuses = ['Tandag','Cantilan','San Miguel','Cagwait','Lianga','Tagbina', 'Bislig'];

        foreach ($campuses as $key => $campus) {
            Campus::create(['name' => $campus]);
        }
    }
}
