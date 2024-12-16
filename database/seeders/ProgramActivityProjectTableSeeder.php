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
        $gaaDAta = [
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

        $stfData = [
            // Special Trust Fund > Current Year Budget > Non-Fiduciary
            [
                'name' => 'General Management and Supervision',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'General Administration and Support',
                'sequence' => 1,
                'parent' => null
            ],
            [
                'name' => 'Administration',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'General Administration and Support',
                'sequence' => 1,
                'parent' => 'General Management and Supervision'
            ],
            [
                'name' => 'Mandatory Reserve',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'General Administration and Support',
                'sequence' => 2,
                'parent' => 'General Management and Supervision'
            ],
            [
                'name' => 'Auxiliary Services',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Support to Operations',
                'sequence' => 1,
                'parent' => null
            ],


            [
                'name' => 'Higher Education Program',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => null
            ],
            [
                'name' => 'Provision of Higher Education Services',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Higher Education Program'
            ],
            [
                'name' => 'Instruction',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Faculty and Staff Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Instruction'
            ],
            [
                'name' => 'Curriculum Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'Instruction'
            ],
            [
                'name' => 'Student Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'Instruction'
            ],
            [
                'name' => 'Facilities Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => 'Instruction'
            ],
            [
                'name' => 'Production',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'CROU',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'Provision of Higher Education Services'
            ],
            //Advanced Education Program
            [
                'name' => 'Advanced Education Program',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => null
            ],
            //Provision of Advanced Education Services
            [
                'name' => 'Provision of Advanced Education Services',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Advanced Education Program'
            ],
            //Graduate School
            [
                'name' => 'Graduate School',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Provision of Advanced Education Services'
            ],
            [
                'name' => 'Faculty and Staff Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Graduate School'
            ],
            [
                'name' => 'Curriculum Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'Graduate School'
            ],
            [
                'name' => 'Student Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'Graduate School'
            ],
            [
                'name' => 'Facilities Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => 'Graduate School'
            ],
            //Production GS
            [
                'name' => 'Production (GS)',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'Provision of Advanced Education Services'
            ],
            //College of Law
            [
                'name' => 'College of Law',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'Provision of Advanced Education Services'
            ],
            [
                'name' => 'Faculty and Staff Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'College of Law'
            ],
            [
                'name' => 'Curriculum Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'College of Law'
            ],
            [
                'name' => 'Student Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'College of Law'
            ],
            [
                'name' => 'Facilities Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => 'College of Law'
            ],
            //Production (CoL)
            [
                'name' => 'Production (CoL)',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => 'Provision of Advanced Education Services'
            ],

            //Research Program
            [
                'name' => 'Research Program',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => null
            ],
            [
                'name' => 'Conduct of Research Services',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Research Program'
            ],
            [
                'name' => 'Research',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Conduct of Research Services'
            ],

            //Research Program
            [
                'name' => 'Technical Advisory Extension Program',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => null
            ],
            [
                'name' => 'Provision of Extension Services',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Technical Advisory Extension Program'
            ],
            [
                'name' => 'Extension',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Non-Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Provision of Extension Services'
            ],
    
        
            // Special Trust Fund > Current Year Budget > Fiduciary
            [
                'name' => 'Athletic',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Computer',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Cultural',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Development',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 4,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Admission',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 5,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Guidance',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 6,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Handbook',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 7,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Laboratory',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 8,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Library',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 9,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Medical and Dental',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 10,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Registration',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 11,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'School ID',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 12,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'NSTP',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 13,
                'parent' => 'Provision of Higher Education Services'
            ],

            [
                'name' => 'Title/Proposal Hearing',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 1,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Oral Defense',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 2,
                'parent' => 'Provision of Higher Education Services'
            ],
            [
                'name' => 'Comprehensive Examination',
                'fund_source' => 'Special Trust Fund',
                'budget_type' => 'Current Year Budget',
                'classification_school_fees' => 'Fiduciary',
                'pap_type' => 'Operations',
                'sequence' => 3,
                'parent' => 'Provision of Higher Education Services'
            ],
        ];
        

        foreach ($gaaDAta as $entry) {
            $fundSourceId = DB::table('fund_sources')->where('name', $entry['fund_source'])->value('id');
            $budgetTypeId = DB::table('budget_types')->where('name', $entry['budget_type'])->value('id');
            $subFundId = $entry['sub_fund'] ? DB::table('sub_funds')->where('name', $entry['sub_fund'])->value('id') : null;
            $papTypeId = DB::table('pap_types')->where('name', $entry['pap_type'])->value('id');
            $parentId = $entry['parent'] ? DB::table('program_activity_projects')
            ->where('fund_source_id', $fundSourceId)
            ->where('name', $entry['parent'])->value('id') : null;

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

        foreach ($stfData as $stf) {
            $fundSourceId = DB::table('fund_sources')->where('name', $stf['fund_source'])->value('id');
            $budgetTypeId = DB::table('budget_types')->where('name', $stf['budget_type'])->value('id');
            $schoolFeeClassificationId = $stf['classification_school_fees'] ? DB::table('school_fee_classifications')->where('name', $stf['classification_school_fees'])->value('id') : null;
            $papTypeId = DB::table('pap_types')->where('name', $stf['pap_type'])->value('id');
            $parentId = $stf['parent'] ? DB::table('program_activity_projects')
                ->where('fund_source_id', $fundSourceId)
                ->where('name', $stf['parent'])->value('id') : null;

            DB::table('program_activity_projects')->insert([
                'fund_source_id' => $fundSourceId,
                'budget_type_id' => $budgetTypeId,
                'sub_fund_id' => null,
                'school_fee_classification_id' => $schoolFeeClassificationId,
                'pap_type_id' => $papTypeId,
                'parent_id' => $parentId,
                'sequence' => $stf['sequence'],
                'name' => $stf['name'],
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
