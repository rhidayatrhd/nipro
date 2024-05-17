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
            'name'  => 'Quality Assurance Quality Control'
        ]);
        Department::create([
            'name'  => 'Human Resource General Affairs'
        ]);
        Department::create([
            'name'  => 'Accounting'
        ]);
        Department::create([
            'name'  => 'Utility'
        ]);
        Department::create([
            'name'  => 'Sales'
        ]);
        Department::create([
            'name'  => 'Material'
        ]);
        Department::create([
            'name'  => 'Production 1'
        ]);
        Department::create([
            'name'  => 'Production 2'
        ]);
        Department::create([
            'name'  => 'Production 3'
        ]);
        Department::create([
            'name'  => 'Production 4'
        ]);
        Section::create([
            'dept_id'   => '2',
            'name'      => 'Human Resource General Affairs'
        ]);
        Section::create([
            'dept_id'   => '3',
            'name'      => 'Finance'
        ]);
        Section::create([
            'dept_id'   => '3',
            'name'      => 'Accounting'
        ]);
        Section::create([
            'dept_id'   => '3',
            'name'      => 'IT'
        ]);
        Section::create([
            'dept_id'   => '4',
            'name'      => 'Maintenance'
        ]);
        Section::create([
            'dept_id'   => '4',
            'name'      => 'Utility'
        ]);
        Section::create([
            'dept_id'   => '5',
            'name'      => 'Sales'
        ]);
        Section::create([
            'dept_id'   => '5',
            'name'      => 'Logistic'
        ]);
        Section::create([
            'dept_id'   => '5',
            'name'      => 'Sterilization'
        ]);
        Section::create([
            'dept_id'   => '6',
            'name'      => 'Purchasing'
        ]);
        Section::create([
            'dept_id'   => '6',
            'name'      => 'Material Control'
        ]);
        Section::create([
            'dept_id'   => '7',
            'name'      => 'Injection'
        ]);
        Section::create([
            'dept_id'   => '7',
            'name'      => 'Extrusion'
        ]);
        Section::create([
            'dept_id'   => '8',
            'name'      => 'Process Control'
        ]);
        Section::create([
            'dept_id'   => '8',
            'name'      => 'BTS 1'
        ]);
        Section::create([
            'dept_id'   => '8',
            'name'      => 'Bts 2'
        ]);
        Section::create([
            'dept_id'   => '8',
            'name'      => 'BTS 3'
        ]);
        Section::create([
            'dept_id'   => '9',
            'name'      => 'Process Planning'
        ]);
        Section::create([
            'dept_id'   => '9',
            'name'      => 'Syringe & Insuline 1'
        ]);
        Section::create([
            'dept_id'   => '9',
            'name'      => 'Syringe & Insuline 2'
        ]);
        Section::create([
            'dept_id'   => '10',
            'name'      => 'AVF'
        ]);
    }
}
