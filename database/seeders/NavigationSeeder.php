<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Navigation::create([
            'name'      => 'Configuration',
            'url'       => 'configurations',
            'icon'      => 'ti-desktop',
            'main_menu' => null
        ]);
        Navigation::create([
            'name'      => 'Access Management',
            'url'       => 'accessmanagements',
            'icon'      => 'ti-link',
            'main_menu' => null
        ]);
        Navigation::create([
            'name'      => 'User Menu',
            'url'       => 'usermenus',
            'icon'      => 'ti-menu-alt',
            'main_menu' => null
        ]);
        Navigation::create([
            'name'      => 'Information',
            'url'       => 'informations',
            'icon'      => 'ti-info-alt',
            'main_menu' => null
        ]);
        Navigation::create([
            'name'      => 'Export & Import',
            'url'       => 'exportimport',
            'icon'      => 'ti-upload',
            'main_menu' => null
        ]);
        
        Navigation::create([
            'name'      => 'Role',
            'url'       => 'configurations/role',
            'icon'      => '',
            'main_menu' => 1
        ]);
        Navigation::create([
            'name'      => 'Permission',
            'url'       => 'configurations/permission',
            'icon'      => '',
            'main_menu' => 1
        ]);
        Navigation::create([
            'name'      => 'Navigation Menu',
            'url'       => 'configurations/navigationmenu',
            'icon'      => '',
            'main_menu' => 1
        ]);

        Navigation::create([
            'name'      => 'Assign Role Permission',
            'url'       => 'accessmanagements/assignrolepermission',
            'icon'      => '',
            'main_menu' => 2
        ]);
        Navigation::create([
            'name'      => 'Assign User Role',
            'url'       => 'accessmanagements/assignuserrole',
            'icon'      => '',
            'main_menu' => 2
        ]);

        Navigation::create([
            'name'      => 'Master Product',
            'url'       => 'usermenus/masterproduct',
            'icon'      => '',
            'main_menu' => 3
        ]);
        Navigation::create([
            'name'      => 'Product Item',
            'url'       => 'usermenus/productitem',
            'icon'      => '',
            'main_menu' => 3
        ]);

        Navigation::create([
            'name'      => 'Computer Info',
            'url'       => 'informations/computer',
            'icon'      => '',
            'main_menu' => 4
        ]);

        Navigation::create([
            'name'      => 'Computer Data',
            'url'       => 'exportimport/datapc', 
            'icon'      => '',
            'main_menu' => 5
        ]);
    }
}
