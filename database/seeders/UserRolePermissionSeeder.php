<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {            
            $staff = User::create(array_merge([
                'email'     => 'userstaff@gmail.com',
                'name'      => 'Herdian Prasongko',
                'username'  =>  'herdian.prasongko',
                'dept'      => 'HRGA'
            ], $default_user_value));

            $spv = User::create(array_merge([
                'email'     => 'userspv@gmail.com',
                'name'      => 'Sungkono',
                'username'  => 'sungkono',
                'dept'      => 'HRGA'
            ], $default_user_value));

            $mgr = User::create(array_merge([
                'email'     => 'usermgr@gmail.com',
                'name'      => 'Wijoyo Utomo',
                'username'  => 'wijoyo.utomo',
                'dept'      => 'FAD & IT'
            ], $default_user_value));

            $it = User::create(array_merge([
                'email'     => 'userit@gmail.com',
                'name'      => 'User IT Nipro',
                'username'  => 'it.nipro',
                'dept'      => 'FAD & IT'
            ], $default_user_value));

            $admit = User::create(array_merge([
                'email'     => 'rahmad@gmail.com',
                'name'      => 'Admin IT Nipro',
                'username'  => 'adminit.nipro',
                'dept'      => 'FAD & IT'
            ], $default_user_value));

            $role_staff = Role::create(['name'    => 'staff']);
            $role_spv = Role::create(['name'    => 'supervisor']);
            $role_mgr = Role::create(['name'    => 'manager']);
            $role_it = Role::create(['name'    => 'it']);
            $role_admit = Role::create(['name'    => 'admin it']);

            
            $prms_read_conf = Permission::create(['name'    => 'read configurations']);
            $prms_read_confrole = Permission::create(['name'    => 'read configurations/role']);
            $prms_crea_confrole = Permission::create(['name'    => 'create configurations/role']);
            $prms_updt_confrole = Permission::create(['name'    => 'update configurations/role']);
            $prms_dele_confrole = Permission::create(['name'    => 'delete configurations/role']);
            $prms_read_confpermis = Permission::create(['name'    => 'read configurations/permission']);
            $prms_crea_confpermis = Permission::create(['name'    => 'create configurations/permission']);
            $prms_updt_confpermis = Permission::create(['name'    => 'update configurations/permission']);
            $prms_dele_confpermis = Permission::create(['name'    => 'delete configurations/permission']);
            $prms_read_conf_navmenu = Permission::create(['name'    => 'read configurations/navigationmenu']);
            $prms_crea_conf_navmenu = Permission::create(['name'    => 'create configurations/navigationmenu']);
            $prms_updt_conf_navmenu = Permission::create(['name'    => 'update configurations/navigationmenu']);
            $prms_dele_conf_navmenu = Permission::create(['name'    => 'delete configurations/navigationmenu']);
            
            $prms_read_accs = Permission::create(['name'    => 'read accessmanagements']);
            $prms_read_accs_assrolpermis = Permission::create(['name'    => 'read accessmanagements/assignrolepermission']);
            $prms_crea_accs_assrolpermis = Permission::create(['name'    => 'create accessmanagements/assignrolepermission']);
            $prms_updt_accs_assrolpermis = Permission::create(['name'    => 'update accessmanagements/assignrolepermission']);
            $prms_dele_accs_assrolpermis = Permission::create(['name'    => 'delete accessmanagements/assignrolepermission']);
            $prms_read_accs_assusrrol = Permission::create(['name'    => 'read accessmanagements/assignuserrole']);
            $prms_crea_accs_assusrrol = Permission::create(['name'    => 'create accessmanagements/assignuserrole']);
            $prms_updt_accs_assusrrol = Permission::create(['name'    => 'update accessmanagements/assignuserrole']);
            $prms_dele_accs_assusrrol = Permission::create(['name'    => 'delete accessmanagements/assignuserrole']);
            
            $prms_read_menu = Permission::create(['name'    => 'read products']);
            $prms_read_menu_mtrprod = Permission::create(['name'    => 'read products/productcategories']);
            $prms_crea_menu_mtrprod = Permission::create(['name'    => 'create products/productcategories']);
            $prms_updt_menu_mtrprod = Permission::create(['name'    => 'update products/productcategories']);
            $prms_dele_menu_mtrprod = Permission::create(['name'    => 'delete products/productcategories']);
            $prms_read_menu_proditm = Permission::create(['name'    => 'read products/productitem']);
            $prms_crea_menu_proditm = Permission::create(['name'    => 'create products/productitem']);
            $prms_updt_menu_proditm = Permission::create(['name'    => 'update products/productitem']);
            $prms_dele_menu_proditm = Permission::create(['name'    => 'delete products/productitem']);
            
            $prms_read_info = Permission::create(['name'    => 'read informations']);
            $prms_read_info_com = Permission::create(['name'    => 'read informations/computer']);
            $prms_crea_info_com = Permission::create(['name'    => 'create informations/computer']);
            $prms_updt_info_com = Permission::create(['name'    => 'update informations/computer']);
            $prms_dele_info_com = Permission::create(['name'    => 'delete informations/computer']);
            
            $prms_read_expimp = Permission::create(['name'    => 'read exportimport']);
            $prms_read_expimp_dtpc = Permission::create(['name'    => 'read exportimport/datapc']);
            $prms_crea_expimp_dtpc = Permission::create(['name'    => 'create exportimport/datapc']);
            $prms_updt_expimp_dtpc = Permission::create(['name'    => 'update exportimport/datapc']);
            $prms_dele_expimp_dtpc = Permission::create(['name'    => 'delete exportimport/datapc']);

            $role_staff->givePermissionTo(
                $prms_read_menu, 
                $prms_read_menu_mtrprod, 
                $prms_crea_menu_mtrprod, 
                $prms_updt_menu_mtrprod, 
                $prms_dele_menu_mtrprod, 
                $prms_read_menu_proditm, 
                $prms_crea_menu_proditm, 
                $prms_updt_menu_proditm, 
                $prms_dele_menu_proditm, 
                $prms_read_info, 
                $prms_read_info_com, 
                $prms_crea_info_com, 
                $prms_updt_info_com,
                $prms_dele_info_com);

            $role_spv->givePermissionTo(
                $prms_read_menu, 
                $prms_read_menu_mtrprod, 
                $prms_updt_menu_mtrprod, 
                $prms_dele_menu_mtrprod, 
                $prms_read_menu_proditm, 
                $prms_updt_menu_proditm, 
                $prms_dele_menu_proditm, 
                $prms_read_info, 
                $prms_read_info_com, 
                $prms_updt_info_com, 
                $prms_read_expimp, 
                $prms_read_expimp_dtpc, 
                $prms_crea_expimp_dtpc, 
                $prms_updt_expimp_dtpc, 
                $prms_dele_expimp_dtpc);

            $role_mgr->givePermissionTo(
                $prms_read_menu, 
                $prms_read_menu_mtrprod, 
                $prms_updt_menu_mtrprod, 
                $prms_dele_menu_mtrprod, 
                $prms_read_menu_proditm, 
                $prms_crea_menu_proditm, 
                $prms_updt_menu_proditm, 
                $prms_dele_menu_proditm, 
                $prms_read_info, 
                $prms_read_info_com, 
                $prms_crea_info_com, 
                $prms_updt_info_com, 
                $prms_read_expimp, 
                $prms_read_expimp_dtpc, 
                $prms_crea_expimp_dtpc, 
                $prms_updt_expimp_dtpc, 
                $prms_dele_expimp_dtpc);

            $role_it->givePermissionTo(
                $prms_read_menu, 
                $prms_read_menu_mtrprod, 
                $prms_crea_menu_mtrprod, 
                $prms_updt_menu_mtrprod, 
                $prms_dele_menu_mtrprod, 
                $prms_read_menu_proditm, 
                $prms_crea_menu_proditm, 
                $prms_updt_menu_proditm, 
                $prms_dele_menu_proditm, 
                $prms_read_info, 
                $prms_read_info_com, 
                $prms_crea_info_com, 
                $prms_updt_info_com, 
                $prms_dele_info_com, 
                $prms_read_expimp, 
                $prms_read_expimp_dtpc, 
                $prms_crea_expimp_dtpc, 
                $prms_updt_expimp_dtpc, 
                $prms_dele_expimp_dtpc, 
                $prms_read_accs, 
                $prms_read_accs_assrolpermis, 
                $prms_crea_accs_assrolpermis, 
                $prms_updt_accs_assrolpermis, 
                $prms_dele_accs_assrolpermis);

            $role_admit->givePermissionTo(
                $prms_read_conf,
                $prms_read_confrole,
                $prms_crea_confrole,
                $prms_updt_confrole,
                $prms_dele_confrole,
                $prms_read_confpermis,
                $prms_crea_confpermis,
                $prms_updt_confpermis,
                $prms_dele_confpermis,
                $prms_read_conf_navmenu,
                $prms_crea_conf_navmenu,
                $prms_updt_conf_navmenu,
                $prms_dele_conf_navmenu,
                $prms_read_accs,
                $prms_read_accs_assrolpermis,
                $prms_crea_accs_assrolpermis,
                $prms_updt_accs_assrolpermis,
                $prms_dele_accs_assrolpermis,
                $prms_read_accs_assusrrol,
                $prms_crea_accs_assusrrol,
                $prms_updt_accs_assusrrol,
                $prms_dele_accs_assusrrol,
                $prms_read_menu,
                $prms_read_menu_mtrprod,
                $prms_crea_menu_mtrprod,
                $prms_updt_menu_mtrprod,
                $prms_dele_menu_mtrprod,
                $prms_read_menu_proditm,
                $prms_crea_menu_proditm,
                $prms_updt_menu_proditm,
                $prms_dele_menu_proditm,
                $prms_read_info,
                $prms_read_info_com,
                $prms_crea_info_com,
                $prms_updt_info_com,
                $prms_dele_info_com,
                $prms_read_expimp,
                $prms_read_expimp_dtpc,
                $prms_crea_expimp_dtpc,
                $prms_updt_expimp_dtpc,
                $prms_dele_expimp_dtpc
            );

            $staff->assignRole($role_staff);
            $spv->assignRole($role_spv);
            $mgr->assignRole($role_mgr, $role_it);
            $it->assignRole($role_it);
            $admit->assignRole($role_admit);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
