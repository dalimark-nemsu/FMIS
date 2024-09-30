<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Budget Officer III', 'Budget Officer II', 'User', 'Super Admin', 'President'
        ];

        foreach ($roles as $key => $role) {
            Role::create([
                'name'  => Str::slug($role, '-'),
                'display_name'  => $role
            ]);
        }
    }
}
