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
        $config = Navigation::create([
            'name'      => 'Configuration',
            'url'       => 'configurations',
            'icon'      => 'ti-desktop',
            'main_menu' => null,
            'sort'      => 1,
        ]);
        $config->subMenus()->create([
            'name'      => 'Role',
            'url'       => 'configurations/role',
            'icon'      => '',
            'main_menu' => 1,
            'sort'      => 1,
        ]);
        $config->subMenus()->create([
            'name'      => 'Permission',
            'url'       => 'configurations/permission',
            'icon'      => '',
            'main_menu' => 1,
            'sort'      => 1,
        ]);
        $config->subMenus()->create([
            'name'      => 'Navigation Menu',
            'url'       => 'configurations/navigationmenu',
            'icon'      => '',
            'main_menu' => 1,
            'sort'      => 1,
        ]);

        $accman = Navigation::create([
            'name'      => 'Access Management',
            'url'       => 'accessmanagements',
            'icon'      => 'ti-link',
            'main_menu' => null,
        ]);
        $accman->subMenus()->create([
            'name'      => 'Assign Role Permission',
            'url'       => 'accessmanagements/assignrolepermission',
            'icon'      => '',
            'main_menu' => 1,
        ]);
        $accman->subMenus()->create([
            'name'      => 'Assign User Role',
            'url'       => 'accessmanagements/assignuserrole',
            'icon'      => '',
            'main_menu' => 1,
        ]);

        $masdata = Navigation::create([
            'name'      => 'Master Data',
            'url'       => 'masterdatas',
            'icon'      => 'ti-book',
            'main_menu' => null,
        ]);
        $masdata->subMenus()->create([
            'name'      => 'Master Product',
            'url'       => 'masterdatas/productcategories',
            'icon'      => '',
            'main_menu' => 1,
        ]);
        $masdata->subMenus()->create([
            'name'      => 'Product Item',
            'url'       => 'masterdatas/productitems',
            'icon'      => '',
            'main_menu' => 1,
        ]);
        $masdata->subMenus()->create([
            'name'      => 'Department',
            'url'       => 'masterdatas/department',
            'icon'      => '',
            'main_menu' => 1,
        ]);
        $masdata->subMenus()->create([
            'name'      => 'Section',
            'url'       => 'masterdatas/section',
            'icon'      => '',
            'main_menu' => 1,
        ]);

        $info = Navigation::create([
            'name'      => 'Information',
            'url'       => 'informations',
            'icon'      => 'ti-info-alt',
            'main_menu' => null,
        ]);
        $info->subMenus()->create([
            'name'      => 'Computer Info',
            'url'       => 'informations/computer',
            'icon'      => '',
            'main_menu' => 1,
        ]);

        $upld = Navigation::create([
            'name'      => 'Upload Data',
            'url'       => 'exportimport',
            'icon'      => 'ti-upload',
            'main_menu' => null,
        ]);
        $upld->subMenus()->create([
            'name'      => 'Computer Data',
            'url'       => 'exportimport/datapc',
            'icon'      => '',
            'main_menu' => 1,
        ]);

        $doctrain = Navigation::create([
            'name'      => 'Training Document',
            'url'       => 'userguides',
            'icon'      => 'ti-bookmark-alt',
            'main_menu' => null,
            'sort'      => 2,
        ]);
        $doctrain->subMenus()->create([
            'name'      => 'SAP Training Material',
            'url'       => 'userguides/sap_userguide',
            'icon'      => '',
            'main_menu' => 1,
            'sort'      => 2,
        ]);
        
        $docform = Navigation::create([
            'name'      => 'Form Request',
            'url'       => 'requestforms',
            'icon'      => 'ti-layout-tab',
            'main_menu' => null,
            'sort'      => 2,
        ]);
        $docform->subMenus()->create([
            'name'      => 'IT Form Request',
            'url'       => 'requestforms/it_requestform',
            'icon'      => '',
            'main_menu' => 1,
            'sort'      => 2,
        ]);

        
    }
}
