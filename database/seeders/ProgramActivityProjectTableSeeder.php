<?php

namespace Database\Seeders;

use App\Models\ProgramActivityProject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramActivityProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // New Appropriations > Agency Specific Budget > General Administration and Support
            [
                'name' => 'General Management and Supervision',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'General Administration and Support',
                'sequence' => 1,
                'parent' => null
            ],
            [
                'name' => 'Administration of Personnel Benefit',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'General Administration and Support',
                'sequence' => 2,
                'parent' => null
            ],

            // New Appropriations > Agency Specific Budget > Support to Operations
            [
                'name' => 'Auxiliary Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Support to Operations',
                'sequence' => 1,
                'parent' => null
            ],

            [
                'name' => 'Higher Education Program',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => null
            ],

            // New Appropriations > Agency Specific Budget > Operations
            [
                'name' => 'Provision of Higher Education Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Higher Education Program'
            ],
            [
                'name' => 'Advanced Education Program',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => null
            ],
            [
                'name' => 'Provision of Advanced Education Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Advanced Education Program'
            ],
            [
                'name' => 'Research Program',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => null
            ],
            [
                'name' => 'Conduct of Research Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Research Program'
            ],
            [
                'name' => 'Technical Advisory Extension Program',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => null
            ],
            [
                'name' => 'Provision of Extension Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'New Appropriations',
                'sub_fund' => 'Agency Specific Budget',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Technical Advisory Extension Program'
            ],

            // Automatic Appropriations > Retirement and Life Insurance Premiums
            [
                'name' => 'General Management and Supervision',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'Automatic Appropriations',
                'sub_fund' => 'Retirement and Life Insurance Premiums', 
                'pap_type' => 'General Administration and Support',
                'sequence' => 1,
                'parent' => null
            ],
            [
                'name' => 'Provision of Higher Education Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'Automatic Appropriations',
                'sub_fund' => null,
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Higher Education Program'
            ],

            // Special Purpose Fund > Miscellaneous Personnel Benefits Fund
            [
                'name' => 'General Management and Supervision',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'Special Purpose Fund',
                'sub_fund' => 'Miscellaneous Personnel Benefits Fund',
                'pap_type' => 'General Administration and Support',
                'sequence' => 1,
                'parent' => null
            ],
            [
                'name' => 'Provision of Higher Education Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'Special Purpose Fund',
                'sub_fund' => 'Miscellaneous Personnel Benefits Fund',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Higher Education Program'
            ],

            // Special Purpose Fund > Pension and Gratuity Fund
            [
                'name' => 'General Management and Supervision',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'Special Purpose Fund',
                'sub_fund' => 'Pension and Gratuity Fund',
                'pap_type' => 'General Administration and Support',
                'sequence' => 1,
                'parent' => null
            ],
            [
                'name' => 'Provision of Higher Education Services',
                'fund_source' => 'General Appropriations Act',
                'budget_type' => 'Special Purpose Fund',
                'sub_fund' => 'Pension and Gratuity Fund',
                'pap_type' => 'Operations',
                'sequence' => 13,
                'parent' => 'Higher Education Program'
            ]
        ];

        foreach ($data as $entry) {
            $fundSourceId = DB::table('fund_sources')->where('name', $entry['fund_source'])->value('id');
            $budgetTypeId = DB::table('budget_types')->where('name', $entry['budget_type'])->value('id');
            $subFundId = $entry['sub_fund'] ? DB::table('sub_funds')->where('name', $entry['sub_fund'])->value('id') : null;
            $papTypeId = DB::table('pap_types')->where('name', $entry['pap_type'])->value('id');
            $parentId = $entry['parent'] ? DB::table('program_activity_projects')->where('name', $entry['parent'])->value('id') : null;

            DB::table('program_activity_projects')->insert([
                'fund_source_id' => $fundSourceId,
                'budget_type_id' => $budgetTypeId,
                'sub_fund_id' => $subFundId,
                'school_fee_classification_id' => null,
                'pap_type_id' => $papTypeId,
                'parent_id' => $parentId,
                'sequence' => $entry['sequence'],
                'name' => $entry['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // $programActivityProjects = [
        //     ['name' => 'General Management and Supervision', 'fund_source_id' => 2, 'mfo_id' => 1],
        //     ['name' => 'Administration of Personnel Benifits', 'fund_source_id' => 2, 'mfo_id' => 1],
        //     ['name' => 'Auxiliary Services', 'fund_source_id' => 2, 'mfo_id' => 2],
        //     ['name' => 'Provision of Higher Education Services', 'fund_source_id' => 2, 'mfo_id' => 3],
        //     ['name' => 'Provision of Advanced Education Services', 'fund_source_id' => 2, 'mfo_id' => 4],
        //     ['name' => 'Conduct of Research Services', 'fund_source_id' => 2, 'mfo_id' => 5],
        //     ['name' => 'Provision of Extension Services', 'fund_source_id' => 2, 'mfo_id' => 6],
        // ];

        // foreach ($programActivityProjects as $key => $programActivityProject) {
        //     ProgramActivityProject::create([
        //         'fund_source_id'    =>  $programActivityProject['fund_source_id'],
        //         'mfo_id'    =>  $programActivityProject['mfo_id'],
        //         'name'    =>  $programActivityProject['name']
        //     ]);
        // }
    }
}
