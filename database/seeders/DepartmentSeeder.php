<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'code'  => 'QAC',
            'name'  => 'Quality Assurance Quality Control'
        ]);
        Department::create([
            'code'  => 'HRG',
            'name'  => 'Human Resource General Affairs'
        ]);
        Department::create([
            'code'  => 'FAD',
            'name'  => 'Accounting'
        ]);
        Department::create([
            'code'  => 'UTY',
            'name'  => 'Utility'
        ]);
        Department::create([
            'code'  => 'SMD',
            'name'  => 'Sales'
        ]);
        Department::create([
            'code'  => 'PSC',
            'name'  => 'Material'
        ]);
        Department::create([
            'code'  => 'PDA',
            'name'  => 'Production 1'
        ]);
        Department::create([
            'code'  => 'PDC',
            'name'  => 'Production 2'
        ]);
        Department::create([
            'code'  => 'PDB',
            'name'  => 'Production 3'
        ]);
        Department::create([
            'code'  => 'PDD',
            'name'  => 'Production 4'
        ]);
        Section::create([
            'dept_id'   => '1',
            'code'      => 'HRG1',
            'name'      => 'Human Resource General Affairs'
        ]);
        Section::create([
            'dept_id'   => '3',
            'code'      => 'FAD1',
            'name'      => 'Finance'
        ]);
        Section::create([
            'dept_id'   => '3',
            'code'      => 'FAD2',
            'name'      => 'Accounting'
        ]);
        Section::create([
            'dept_id'   => '3',
            'code'      => 'ITD1',
            'name'      => 'Information Technology'
        ]);
        Section::create([
            'dept_id'   => '4',
            'code'      => 'UTY1',
            'name'      => 'Maintenance'
        ]);
        Section::create([
            'dept_id'   => '4',
            'code'      => 'UTY2',
            'name'      => 'Utility'
        ]);
        Section::create([
            'dept_id'   => '5',
            'code'      => 'SMD1',
            'name'      => 'Sales'
        ]);
        Section::create([
            'dept_id'   => '5',
            'code'      => 'LOG1',
            'name'      => 'Logistic'
        ]);
        Section::create([
            'dept_id'   => '5',
            'code'      => 'STR1',
            'name'      => 'Sterilization'
        ]);
        Section::create([
            'dept_id'   => '6',
            'code'      => 'PSC1',
            'name'      => 'Purchasing'
        ]);
        Section::create([
            'dept_id'   => '6',
            'code'      => 'PSC2',
            'name'      => 'Material Control'
        ]);
        Section::create([
            'dept_id'   => '7',
            'code'      => 'PDA1',
            'name'      => 'Injection'
        ]);
        Section::create([
            'dept_id'   => '7',
            'code'      => 'PDA2',
            'name'      => 'Extrusion'
        ]);
        Section::create([
            'dept_id'   => '8',
            'code'      => 'PDC1',
            'name'      => 'Process Control'
        ]);
        Section::create([
            'dept_id'   => '8',
            'code'      => 'PDC2',
            'name'      => 'BTS 1'
        ]);
        Section::create([
            'dept_id'   => '8',
            'code'      => 'PDC3',
            'name'      => 'Bts 2'
        ]);
        Section::create([
            'dept_id'   => '8',
            'code'      => 'PDC4',
            'name'      => 'BTS 3'
        ]);
        Section::create([
            'dept_id'   => '9',
            'code'      => 'PDB1',
            'name'      => 'Process Planning'
        ]);
        Section::create([
            'dept_id'   => '9',
            'code'      => 'PDB2',
            'name'      => 'Syringe & Insuline 1'
        ]);
        Section::create([
            'dept_id'   => '9',
            'code'      => 'PDB3',
            'name'      => 'Syringe & Insuline 2'
        ]);
        Section::create([
            'dept_id'   => '10',
            'code'      => 'PDD1',
            'name'      => 'Arteriovenous Fistula(AVF)'
        ]);
    }
}
