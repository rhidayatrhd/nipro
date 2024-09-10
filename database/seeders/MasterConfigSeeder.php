<?php

namespace Database\Seeders;

use App\Models\MasterConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterConfig::create([
            'key1'      => 'HOST_Numbering',
            'key2'      => 'NB',  
            'key3'      => 'NIJ',
            'seq'       => '1',
            'string1'   => '24',
            'string2'   => '06',
            'string3'   => '0001',
            'string4'   => '1'
        ]);
        MasterConfig::create([
            'key1'      => 'Hardware_Numbering',
            'key2'      => 'FAD1',  
            'key3'      => 'CPU',
            'seq'       => '1',
            'string1'   => '24',
            'string2'   => '06',
            'string3'   => '0001',
            'string4'   => '1'
        ]);
    }
}
