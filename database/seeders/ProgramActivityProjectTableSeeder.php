<?php

namespace Database\Seeders;

use App\Models\ProgramActivityProject;
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
        $programActivityProjects = [
            ['name' => 'General Management and Supervision', 'fund_source_id' => 2, 'mfo_id' => 1],
            ['name' => 'Administration of Personnel Benifits', 'fund_source_id' => 2, 'mfo_id' => 1],
            ['name' => 'Auxiliary Services', 'fund_source_id' => 2, 'mfo_id' => 2],
            ['name' => 'Provision of Higher Education Services', 'fund_source_id' => 2, 'mfo_id' => 3],
            ['name' => 'Provision of Advanced Education Services', 'fund_source_id' => 2, 'mfo_id' => 4],
            ['name' => 'Conduct of Research Services', 'fund_source_id' => 2, 'mfo_id' => 5],
            ['name' => 'Provision of Extension Services', 'fund_source_id' => 2, 'mfo_id' => 6],
        ];

        foreach ($programActivityProjects as $key => $programActivityProject) {
            ProgramActivityProject::create([
                'fund_source_id'    =>  $programActivityProject['fund_source_id'],
                'mfo_id'    =>  $programActivityProject['mfo_id'],
                'name'    =>  $programActivityProject['name']
            ]);
        }
    }
}
