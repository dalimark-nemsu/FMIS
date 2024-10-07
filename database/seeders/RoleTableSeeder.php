<?php

namespace Database\Seeders;

use App\Models\Permission;
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
            $role = Role::create([
                'name'  => Str::slug($role, '-'),
                'display_name'  => $role
            ]);

            $superAdminAndBudgetOfficer3Permsissions = Permission::all()->pluck('id');

            $excludedPermissions = [
                'create-campus-budget-ceiling',
                'read-campus-budget-ceiling',
                'update-campus-budget-ceiling',
                'delete-campus-budget-ceiling',
                'create-budget-year',
                'read-budget-year',
                'update-budget-year',
                'delete-budget-year'
            ];

            $budgetOfficer2Permissions = Permission::whereNotIn('name', $excludedPermissions)->pluck('id')->toArray();

            switch ($role->name) {
                case 'super-admin':
                case 'budget-officer-iii':
                    $role->attachPermissions($superAdminAndBudgetOfficer3Permsissions);
                    break;
                case 'budget-officer-ii':
                    $role->attachPermissions($budgetOfficer2Permissions);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
