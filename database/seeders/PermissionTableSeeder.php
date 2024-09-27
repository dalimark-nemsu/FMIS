<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           // Campus Budget Ceiling Permissions
            [
                'display_name' => 'Create Campus Budget Ceiling',
                'description'  => 'Permission to create Campus Budget Ceiling records',
            ],
            [
                'display_name' => 'Read Campus Budget Ceiling',
                'description'  => 'Permission to view Campus Budget Ceiling records',
            ],
            [
                'display_name' => 'Update Campus Budget Ceiling',
                'description'  => 'Permission to update Campus Budget Ceiling records',
            ],
            [
                'display_name' => 'Delete Campus Budget Ceiling',
                'description'  => 'Permission to delete Campus Budget Ceiling records',
            ],

            // Unit Budget Ceiling Permissions
            [
                'display_name' => 'Create Unit Budget Ceiling',
                'description'  => 'Permission to create Unit Budget Ceiling records',
            ],
            [
                'display_name' => 'Read Unit Budget Ceiling',
                'description'  => 'Permission to view Unit Budget Ceiling records',
            ],
            [
                'display_name' => 'Update Unit Budget Ceiling',
                'description'  => 'Permission to update Unit Budget Ceiling records',
            ],
            [
                'display_name' => 'Delete Unit Budget Ceiling',
                'description'  => 'Permission to delete Unit Budget Ceiling records',
            ],

            // PAP Permissions
            [
                'display_name' => 'Create PAP',
                'description'  => 'Permission to create PAP records',
            ],
            [
                'display_name' => 'Read PAP',
                'description'  => 'Permission to view PAP records',
            ],
            [
                'display_name' => 'Update PAP',
                'description'  => 'Permission to update PAP records',
            ],
            [
                'display_name' => 'Delete PAP',
                'description'  => 'Permission to delete PAP records',
            ],

            // MFO Permissions
            [
                'display_name' => 'Create MFO',
                'description'  => 'Permission to create MFO records',
            ],
            [
                'display_name' => 'Read MFO',
                'description'  => 'Permission to view MFO records',
            ],
            [
                'display_name' => 'Update MFO',
                'description'  => 'Permission to update MFO records',
            ],
            [
                'display_name' => 'Delete MFO',
                'description'  => 'Permission to delete MFO records',
            ],

            // MFO Units (Many to Many) Permissions
            [
                'display_name' => 'Create MFO Unit',
                'description'  => 'Permission to create MFO Unit records',
            ],
            [
                'display_name' => 'Read MFO Unit',
                'description'  => 'Permission to view MFO Unit records',
            ],
            [
                'display_name' => 'Update MFO Unit',
                'description'  => 'Permission to update MFO Unit records',
            ],
            [
                'display_name' => 'Delete MFO Unit',
                'description'  => 'Permission to delete MFO Unit records',
            ],

            // Unit Permissions
            [
                'display_name' => 'Create Unit',
                'description'  => 'Permission to create Unit records',
            ],
            [
                'display_name' => 'Read Unit',
                'description'  => 'Permission to view Unit records',
            ],
            [
                'display_name' => 'Update Unit',
                'description'  => 'Permission to update Unit records',
            ],
            [
                'display_name' => 'Delete Unit',
                'description'  => 'Permission to delete Unit records',
            ],

            // Campus Permissions
            [
                'display_name' => 'Create Campus',
                'description'  => 'Permission to create Campus records',
            ],
            [
                'display_name' => 'Read Campus',
                'description'  => 'Permission to view Campus records',
            ],
            [
                'display_name' => 'Update Campus',
                'description'  => 'Permission to update Campus records',
            ],
            [
                'display_name' => 'Delete Campus',
                'description'  => 'Permission to delete Campus records',
            ],

            // Fund Source Permissions
            [
                'display_name' => 'Create Fund Source',
                'description'  => 'Permission to create Fund Source records',
            ],
            [
                'display_name' => 'Read Fund Source',
                'description'  => 'Permission to view Fund Source records',
            ],
            [
                'display_name' => 'Update Fund Source',
                'description'  => 'Permission to update Fund Source records',
            ],
            [
                'display_name' => 'Delete Fund Source',
                'description'  => 'Permission to delete Fund Source records',
            ],

            // Budget Year Permissions
            [
                'display_name' => 'Create Budget Year',
                'description'  => 'Permission to create Budget Year records',
            ],
            [
                'display_name' => 'Read Budget Year',
                'description'  => 'Permission to view Budget Year records',
            ],
            [
                'display_name' => 'Update Budget Year',
                'description'  => 'Permission to update Budget Year records',
            ],
            [
                'display_name' => 'Delete Budget Year',
                'description'  => 'Permission to delete Budget Year records',
            ],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => Str::slug($permission['display_name'], '-'), // Convert display name to slug
                'display_name' => $permission['display_name'],
                'description' => $permission['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
