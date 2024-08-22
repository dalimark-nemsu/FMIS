<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  =>  'University Budget',
            'position_id'  =>  1,
            'unit_id'  =>  1,
            'email'  =>  'universitybudget@nemsu.edu.ph',
            'password'  =>  bcrypt('password'),
        ]);

        User::create([
            'name'  =>  'University Budget',
            'position_id'  =>  2,
            'unit_id'  =>  1,
            'email'  =>  'campusbudget@nemsu.edu.ph',
            'password'  =>  bcrypt('password'),
        ]);
    }
}
