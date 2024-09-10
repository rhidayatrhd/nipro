<?php

namespace Database\Seeders;

use App\Models\HardwareCode;
use App\Models\HardwareGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HardwareGrpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HardwareGroup::create([
            'code'          => 'CPU',
            'name'   => 'Core Processor Unit'
        ]);
        HardwareGroup::create([
            'code'          => 'MNT',
            'name'   => 'Monitor'
        ]);
        HardwareGroup::create([
            'code'          => 'PRT',
            'name'   => 'Printer'
        ]);
        HardwareGroup::create([
            'code'          => 'SVR',
            'name'   => 'Server'
        ]);
        HardwareGroup::create([
            'code'          => 'HUB',
            'name'   => 'Switch Hub'
        ]);
        HardwareGroup::create([
            'code'          => 'WIF',
            'name'   => 'Wifi'
        ]);
        HardwareGroup::create([
            'code'          => 'UPS',
            'name'   => 'Unit Power System'
        ]);
    }
}
