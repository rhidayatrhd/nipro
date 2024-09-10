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
            $staff1 = User::create(array_merge([
                'email'     => 'userstaff1@gmail.com',
                'name'      => 'All User Nipro 1',
                'username'  =>  'user_staff1',
                'dept_id'   => 2,
                'sect_id'   => 1,
            ], $default_user_value));

            $staff2 = User::create(array_merge([
                'email'     => 'userstaff2@gmail.com',
                'name'      => 'All User Nipro 2',
                'username'  => 'user_staf2',
                'dept_id'   => 2,
                'sect_id'   => 1,
            ], $default_user_value));

            // $mgr = User::create(array_merge([
            //     'email'     => 'usermgr@gmail.com',
            //     'name'      => 'All Managerial Nipro',
            //     'username'  => 'user_mgr',
            //     'dept_id'   => 3,
            //     'sect_id'   => 2
            // ], $default_user_value));

            $it = User::create(array_merge([
                'email'     => 'userit@gmail.com',
                'name'      => 'All IT Nipro',
                'username'  => 'user_it',
                'dept_id'   => 3,
                'sect_id'   => 4
            ], $default_user_value));

            $admit = User::create(array_merge([
                'email'     => 'adminit@gmail.com',
                'name'      => 'Admin IT Nipro',
                'username'  => 'admin_it',
                'is_admin'  => 1,
                'dept_id'   => 3,
                'sect_id'   => 4
            ], $default_user_value));

            $role_staff = Role::create(['name'    => 'Nipro Staff']);
            $role_spv = Role::create(['name'    => 'Nipro Sr.Supervisor/Supervisor']);
            $role_mgr = Role::create(['name'    => 'Nipro Manager/Ass']);
            $role_it = Role::create(['name'    => 'Nipro IT']);
            $role_admit = Role::create(['name'    => 'Nipro Admin IT']);
            
            $pr_rd_conf = Permission::create(['name'    => 'read configurations']);
            $pr_rd_conf_role = Permission::create(['name'    => 'read configurations/role']);
            $pr_cr_conf_role = Permission::create(['name'    => 'create configurations/role']);
            $pr_up_conf_role = Permission::create(['name'    => 'update configurations/role']);
            $pr_dl_conf_role = Permission::create(['name'    => 'delete configurations/role']);
            $pr_rd_conf_permis = Permission::create(['name'    => 'read configurations/permission']);
            $pr_cr_conf_permis = Permission::create(['name'    => 'create configurations/permission']);
            $pr_up_conf_permis = Permission::create(['name'    => 'update configurations/permission']);
            $pr_dl_conf_permis = Permission::create(['name'    => 'delete configurations/permission']);
            $pr_rd_conf_navmenu = Permission::create(['name'    => 'read configurations/navigationmenu']);
            $pr_cr_conf_navmenu = Permission::create(['name'    => 'create configurations/navigationmenu']);
            $pr_up_conf_navmenu = Permission::create(['name'    => 'update configurations/navigationmenu']);
            $pr_dl_conf_navmenu = Permission::create(['name'    => 'delete configurations/navigationmenu']);
            
            $pr_rd_accs = Permission::create(['name'    => 'read accessmanagements']);
            $pr_rd_accs_rolepermis = Permission::create(['name'    => 'read accessmanagements/assignrolepermission']);
            $pr_cr_accs_rolepermis = Permission::create(['name'    => 'create accessmanagements/assignrolepermission']);
            $pr_up_accs_rolepermis = Permission::create(['name'    => 'update accessmanagements/assignrolepermission']);
            $pr_dl_accs_rolepermis = Permission::create(['name'    => 'delete accessmanagements/assignrolepermission']);
            $pr_rd_accs_userrole = Permission::create(['name'    => 'read accessmanagements/assignuserrole']);
            $pr_cr_accs_userrole = Permission::create(['name'    => 'create accessmanagements/assignuserrole']);
            $pr_up_accs_userrole = Permission::create(['name'    => 'update accessmanagements/assignuserrole']);
            $pr_dl_accs_userrole = Permission::create(['name'    => 'delete accessmanagements/assignuserrole']);

            // $pr_rd_menu = Permission::create(['name'    => 'read products']);
            $pr_rd_mstr = Permission::create(['name'    => 'read masterdatas']);
            $pr_rd_mstr_prod = Permission::create(['name'    => 'read masterdatas/productcategories']);
            $pr_cr_mstr_prod = Permission::create(['name'    => 'create masterdatas/productcategories']);
            $pr_up_mstr_prod = Permission::create(['name'    => 'update masterdatas/productcategories']);
            $pr_dl_mstr_prod = Permission::create(['name'    => 'delete masterdatas/productcategories']);
            $pr_rd_mstr_proditm = Permission::create(['name'    => 'read masterdatas/productitems']);
            $pr_cr_mstr_proditm = Permission::create(['name'    => 'create masterdatas/productitems']);
            $pr_up_mstr_proditm = Permission::create(['name'    => 'update masterdatas/productitems']);
            $pr_dl_mstr_proditm = Permission::create(['name'    => 'delete masterdatas/productitems']);
            $pr_rd_mstr_dep = Permission::create(['name'    => 'read masterdatas/department']);
            $pr_cr_mstr_dep = Permission::create(['name'    => 'create masterdatas/department']);
            $pr_up_mstr_dep = Permission::create(['name'    => 'update masterdatas/department']);
            $pr_dl_mstr_dep = Permission::create(['name'    => 'delete masterdatas/department']);
            $pr_rd_mstr_sec = Permission::create(['name'    => 'read masterdatas/section']);
            $pr_cr_mstr_sec = Permission::create(['name'    => 'create masterdatas/section']);
            $pr_up_mstr_sec = Permission::create(['name'    => 'update masterdatas/section']);
            $pr_dl_mstr_sec = Permission::create(['name'    => 'delete masterdatas/section']);
            
            $pr_rd_info = Permission::create(['name'    => 'read informations']);
            $pr_rd_info_com = Permission::create(['name'    => 'read informations/computer']);
            $pr_cr_info_com = Permission::create(['name'    => 'create informations/computer']);
            $pr_up_info_com = Permission::create(['name'    => 'update informations/computer']);
            $pr_dl_info_com = Permission::create(['name'    => 'delete informations/computer']);
            
            $pr_rd_expimp = Permission::create(['name'    => 'read exportimport']);
            $pr_rd_expimp_dtpc = Permission::create(['name'    => 'read exportimport/datapc']);
            $pr_cr_expimp_dtpc = Permission::create(['name'    => 'create exportimport/datapc']);
            $pr_up_expimp_dtpc = Permission::create(['name'    => 'update exportimport/datapc']);
            $pr_dl_expimp_dtpc = Permission::create(['name'    => 'delete exportimport/datapc']);

            $pr_rd_rqfr = Permission::create(['name'    => 'read requestforms']);
            $pr_rd_rqfr_it = Permission::create(['name'    => 'read requestforms/it_requestform']);
            $pr_cr_rqfr_it = Permission::create(['name'    => 'create requestforms/it_requestform']);
            $pr_up_rqfr_it = Permission::create(['name'    => 'update requestforms/it_requestform']);
            $pr_dl_rqfr_it = Permission::create(['name'    => 'delete requestforms/it_requestform']);
            
            $pr_rd_usgd = Permission::create(['name'    => 'read userguides']);
            $pr_rd_usgd_sap = Permission::create(['name'    => 'read userguides/sap_userguide']);
            $pr_cr_usgd_sap = Permission::create(['name'    => 'create userguides/sap_userguide']);
            $pr_up_usgd_sap = Permission::create(['name'    => 'update userguides/sap_userguide']);
            $pr_dl_usgd_sap = Permission::create(['name'    => 'delete userguides/sap_userguide']);

            $role_staff->givePermissionTo(
                $pr_rd_mstr, 
                $pr_rd_mstr_prod, 
                $pr_cr_mstr_prod, 
                $pr_rd_mstr_proditm,
                $pr_cr_mstr_proditm,
                $pr_rd_mstr_dep,
                $pr_cr_mstr_dep,
                $pr_rd_mstr_sec,
                $pr_cr_mstr_sec,

                $pr_rd_rqfr,
                $pr_rd_rqfr_it,

                $pr_rd_usgd,
                $pr_rd_usgd_sap,

            );
        
            $role_spv->givePermissionTo(
                $pr_rd_mstr,
                $pr_rd_mstr_prod,
                $pr_up_mstr_prod,
                $pr_dl_mstr_prod,
                $pr_rd_mstr_proditm,
                $pr_up_mstr_proditm,
                $pr_dl_mstr_proditm,

                $pr_rd_mstr_dep,
                $pr_up_mstr_dep,
                $pr_dl_mstr_dep,
                $pr_rd_mstr_sec,
                $pr_up_mstr_sec,
                $pr_dl_mstr_sec,

                $pr_rd_rqfr,
                $pr_rd_rqfr_it,

                $pr_rd_usgd,
                $pr_rd_usgd_sap,

            );

            $role_mgr->givePermissionTo(
                $pr_rd_mstr,
                $pr_rd_mstr_prod,
                $pr_rd_mstr_proditm,
                $pr_rd_mstr_dep,
                $pr_rd_mstr_sec,
                $pr_rd_rqfr,
                $pr_rd_rqfr_it,

                $pr_rd_usgd,
                $pr_rd_usgd_sap,

            );

            $role_it->givePermissionTo(
                $pr_rd_accs,
                $pr_rd_accs_rolepermis,
                $pr_cr_accs_rolepermis,
                $pr_up_accs_rolepermis,
                $pr_dl_accs_rolepermis,
                $pr_rd_accs_userrole,
                $pr_cr_accs_userrole,
                $pr_up_accs_userrole,
                $pr_dl_accs_userrole,

                $pr_rd_mstr, 
                $pr_rd_mstr_prod, 
                $pr_cr_mstr_prod, 
                $pr_up_mstr_prod, 
                $pr_dl_mstr_prod, 
                $pr_rd_mstr_proditm, 
                $pr_cr_mstr_proditm, 
                $pr_up_mstr_proditm, 
                $pr_dl_mstr_proditm,
                $pr_rd_mstr_dep,
                $pr_cr_mstr_dep,
                $pr_up_mstr_dep,
                $pr_dl_mstr_dep,
                $pr_rd_mstr_sec,
                $pr_cr_mstr_sec,
                $pr_up_mstr_sec,
                $pr_dl_mstr_sec,

                $pr_rd_expimp, 
                $pr_rd_expimp_dtpc, 
                $pr_cr_expimp_dtpc, 
                $pr_up_expimp_dtpc, 
                $pr_dl_expimp_dtpc,

                $pr_rd_rqfr,
                $pr_rd_rqfr_it,
                $pr_cr_rqfr_it,
                $pr_up_rqfr_it,
                $pr_dl_rqfr_it,

                $pr_rd_usgd,
                $pr_rd_usgd_sap,
                $pr_cr_usgd_sap,
                $pr_up_usgd_sap,
                $pr_dl_usgd_sap,
            );

            $role_admit->givePermissionTo(
                $pr_rd_accs,
                $pr_rd_accs_rolepermis,
                $pr_cr_accs_rolepermis,
                $pr_up_accs_rolepermis,
                $pr_dl_accs_rolepermis,
                $pr_rd_accs_userrole,
                $pr_cr_accs_userrole,
                $pr_up_accs_userrole,
                $pr_dl_accs_userrole,

                $pr_rd_mstr,
                $pr_rd_mstr_prod,
                $pr_cr_mstr_prod,
                $pr_up_mstr_prod,
                $pr_dl_mstr_prod,
                $pr_rd_mstr_proditm,
                $pr_cr_mstr_proditm,
                $pr_up_mstr_proditm,
                $pr_dl_mstr_proditm,
                $pr_rd_mstr_dep,
                $pr_cr_mstr_dep,
                $pr_up_mstr_dep,
                $pr_dl_mstr_dep,
                $pr_rd_mstr_sec,
                $pr_cr_mstr_sec,
                $pr_up_mstr_sec,
                $pr_dl_mstr_sec,

                $pr_rd_info,
                $pr_rd_info_com,
                $pr_cr_info_com,
                $pr_up_info_com,
                $pr_dl_info_com,

                $pr_rd_expimp,
                $pr_rd_expimp_dtpc,
                $pr_cr_expimp_dtpc,
                $pr_up_expimp_dtpc,
                $pr_dl_expimp_dtpc,

                $pr_rd_rqfr,
                $pr_rd_rqfr_it,
                $pr_cr_rqfr_it,
                $pr_up_rqfr_it,
                $pr_dl_rqfr_it,

                $pr_rd_usgd,
                $pr_rd_usgd_sap,
                $pr_cr_usgd_sap,
                $pr_up_usgd_sap,
                $pr_dl_usgd_sap,

            );

            $staff1->assignRole($role_staff);
            $staff2->assignRole($role_spv);
            // $mgr->assignRole($role_mgr, $role_it);
            $it->assignRole($role_it);
            $admit->assignRole($role_admit);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
