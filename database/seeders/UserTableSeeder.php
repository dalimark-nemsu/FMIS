<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $roleSuperAdmin = Role::where('name', 'super-admin')->first();
        $roleBudgetOfficer3 = Role::where('name', 'budget-officer-iii')->first();
        $roleBudgetOfficer2 = Role::where('name', 'budget-officer-ii')->first();
        $roleUser = Role::where('name', 'user')->first();

        $user1 = User::create([
            'name'  =>  'Mark Santing',
            'position_id'  =>  1,
            'unit_id'  =>  1,
            'email'  =>  'mark@nemsu.edu.ph',
            'password'  =>  bcrypt('password'),
        ]);

        $user2 = User::create([
            'name'  =>  'Dalimark Tenio',
            'position_id'  =>  1,
            'unit_id'  =>  1,
            'email'  =>  'dmtenio@nemsu.edu.ph',
            'password'  =>  bcrypt('password'),
        ]);

        $user3 = User::create([
            'name'  =>  'University Budget Officer',
            'position_id'  =>  1,
            'unit_id'  =>  1,
            'email'  =>  'universitybudget@nemsu.edu.ph',
            'password'  =>  bcrypt('password'),
        ]);

        $user4 = User::create([
            'name'  =>  'Campus Budget Officer',
            'position_id'  =>  2,
            'unit_id'  =>  1,
            'email'  =>  'campusbudget@nemsu.edu.ph',
            'password'  =>  bcrypt('password'),
        ]);

        $user1->attachRoles([$roleSuperAdmin, $roleUser]);
        $user2->attachRoles([$roleSuperAdmin, $roleUser]);
        $user3->attachRoles([$roleBudgetOfficer3, $roleUser]);
        $user4->attachRoles([$roleBudgetOfficer2, $roleUser]);
    }
}
