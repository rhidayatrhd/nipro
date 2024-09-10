<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use dataTable;
use App\Models\Role;
use Illuminate\Support\Str;
use App\Models\Navigation;
use App\Models\Permission;
use phpSysInfo\phpSysInfo;
use Illuminate\Http\Request;
use App\DataTables\RolePermissionDataTable;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Row;

use function PHPUnit\Framework\isNull;

class AssignRolePermissionController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:admin')->only('create') || $this->middleware('can:create accessmanagements/assignrolepermission')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $this->authorize('read accessmanagements/assignrolepermission', 'admin');
        $roles = Role::all();
        if (\request()->ajax()) {
            if (!empty($request->filter_role)) {
                $permission = DB::table('navigations')
                    ->select('roles.id as rid','navigations.id as nid', 'navigations.name as nname', 'roles.name as rname')
                    ->join('permissions', 'navigations.url', '=', DB::raw("SUBSTR(permissions.name, LOCATE(' ', permissions.name) + 1)"))
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                    ->distinct()
                    ->whereNotNull('navigations.main_menu')
                    ->where('roles.id', $request->filter_role)
                    ->Where('navigations.sort', '=', 0)
                    ->OrWhere('navigations.sort', '=', 2)
                    ->get();  
            } else {
                $permission = DB::table('navigations')
                    ->select('roles.id as rid', 'navigations.id as nid','navigations.name as nname', 'roles.name as rname')
                    ->join('permissions', 'navigations.url' , '=', DB::raw("SUBSTR(permissions.name, LOCATE(' ', permissions.name) + 1)"))
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                    ->distinct()
                    ->whereNotNull('navigations.main_menu')
                    ->Where('navigations.sort', '=', 0)
                    ->OrWhere('navigations.sort', '=', 2)
                    ->get();  
            }
            if (!empty($request->filter_role)) {
                return dataTables()->of($permission)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) 
                    {
                        $role = '';
                        if (Gate::allows('update accessmanagements/assignrolepermission') || Gate::allows('admin')) {
                        $role = '<button type="button" data-id=' . $row->rid . ';' . $row->nid . ' data-jenis="update" class="btn btn-warning btn-sm action"><i class="ti-pencil"></i></button>';
                        }
                        return $role;
                    })->with(90)
                    ->make(true);
            } 
            else {
                return dataTables()->of($permission)
                    ->addIndexColumn()
                    ->addColumn('action','')
                    ->make(true);
            }
        }

        return \view('accessmanagements/assignrolepermission', \compact('roles'), [
            'menu'      => 'Access Management',
            'title'     => 'Assign Role Permission',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $ids = '';
        $navigation = Navigation::where('id', $ids);
        $permission = Permission::where('id', $ids);
        
        return \view('accessmanagements/assignrolepermission-action', [
            'assignrolepermission'  => new RoleHasPermission(),
            'roles'        => $roles,
            'id'          => $ids,
            'navigate'     => $navigation,
            'permiss'      => $permission,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $assignrolepermission)
    {
        // dd($request->all());
        // dd($request->fil_submenu);
        // dd($request->oread[0]);
        $this->validate($request,[
            'fil_role'   => 'required',
            'fil_menu'   => 'required',
            'fil_submenu'   => 'required',
        ]);
        $assignrolepermission = Role::findById($request->fil_role[0]);
        // \dd($request->all());
        // \dd($assignrolepermission);
        if (!empty($request->fil_submenu)) {
            // \dd($request->all());
            $nav = Navigation::where('id', $request->fil_submenu)->get();
            // \dd($nav[0]->url);
            if (!empty($request->read[0])) {
                // \dd($request->read);
                $rolpermis = DB::table('permissions')
                    ->where('name', '=' , 'read '. $nav[0]->url)->get();
                // \dd($rolpermis);
                $checkpermis = DB::table('role_has_permissions')
                    ->where('permission_id', $rolpermis[0]->id)
                    ->where('role_id', $assignrolepermission->id)->get();
                if (empty($checkpermis[0])) {
                    // \dd('no data');
                    $permis = Permission::findById($rolpermis[0]->id);
                    // \dd($permis);
                    $assignrolepermission->givePermissionTo($permis);
                } 
            }
            if (!empty($request->create[0])) {
                // \dd($request->create[0]);
                $rolpermis = DB::table('permissions')
                    ->where('name', '=', 'create ' . $nav[0]->url)->get();
                //  \dd($rolpermis);   
                $checkpermis = DB::table('role_has_permissions')
                    ->where('permission_id', $rolpermis[0]->id)
                    ->where('role_id', $assignrolepermission->id)->get();
                // \dd($checkpermis);
                if (empty($checkpermis[0])) {
                    $permis = Permission::findById($rolpermis[0]->id);
                    $assignrolepermission->givePermissionTo($permis);
                }
            }
            if (!empty($request->update[0])) {
                $rolpermis = DB::table('permissions')
                    ->where('name', '=', 'update ' . $nav[0]->url)->get();
                $checkpermis = DB::table('role_has_permissions')
                    ->where('permission_id', $rolpermis[0]->id)
                    ->where('role_id', $assignrolepermission->id)->get();
                if (empty($checkpermis[0])) {
                    $permis = Permission::findById($rolpermis[0]->id);
                    // \dd($permis);
                    $assignrolepermission->givePermissionTo($permis);
                }
            }
            if (!empty($request->delete[0])) {
                $rolpermis = DB::table('permissions')
                    ->where('name', '=', 'delete ' . $nav[0]->url)->get();
                $checkpermis = DB::table('role_has_permissions')
                    ->where('permission_id', $rolpermis[0]->id)
                    ->where('role_id', $assignrolepermission->id)->get();
                    // \dd($checkpermis);
                if (empty($checkpermis[0])) {
                    // \dd($checkpermis);
                    $permis = Permission::findById($rolpermis[0]->id);
                    $assignrolepermission->givePermissionTo($permis);
                }
            }
        }
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data already created!'
        ]);
        // return \redirect('accessmanagements/assignrolepermission')->with('success', 'New Permission was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // \dd($id);
        $filter = \explode(';', $id);
        // \dd($filter[0]);
        $roles = Role::where('id', $filter[0])->get();
        // \dd($assignrolepermission);
        $navigation = Navigation::where('id', $filter[1])->get();
        // \dd($navigation[0]->url);
        $permission =  Permission::all();
        // \dd($permission);
        $readpermis = DB::table('permissions')
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                     ->where('permissions.name' , 'read ' . $navigation[0]->url)
                     ->where('role_has_permissions.role_id', $filter[0])
                     ->get();
        $createpermis = DB::table('permissions')
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                     ->where('permissions.name' , 'create ' . $navigation[0]->url)
                     ->where('role_has_permissions.role_id', $filter[0])
                     ->get();
        $updatepermis = DB::table('permissions')
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                     ->where('permissions.name' , 'update ' . $navigation[0]->url)
                     ->where('role_has_permissions.role_id', $filter[0])
                     ->get();
        $deletepermis = DB::table('permissions')
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                     ->where('permissions.name' , 'delete ' . $navigation[0]->url)
                     ->where('role_has_permissions.role_id', $filter[0])
                     ->get();

        return \view('accessmanagements.assignrolepermission-action', [
                'roles'        => $roles,
                'navigate'     => $navigation,
                'permiss'      => $permission,
                'read'         => $readpermis,
                'creat'        => $createpermis,
                'updat'        => $updatepermis,
                'dele'         => $deletepermis,
            ], \compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $assignrolepermission)
    {
        // if (empty($request->ocreate)) {
        //     \dd('Empty');
        // } else {
        //     \dd('Not Empty');
        // }
        $assignrolepermission = Role::findById($request->fil_role[0]);
        if ($request->oread !== $request->read) {
            if (empty($request->oread[0])) {
                $permiss = Permission::findById($request->read[0]);
                $assignrolepermission->givePermissionTo($permiss);
            } else {
                $permiss = Permission::findById($request->oread[0]);
                $assignrolepermission->revokePermissionTo($permiss);
            }
        }
        if ($request->ocreate !== $request->create) {
            if (empty($request->ocreate[0])) {
                $permiss = Permission::findById($request->create[0]);
                $assignrolepermission->givePermissionTo($permiss);
            } else {
                $permiss = Permission::findById($request->ocreate[0]);
                $assignrolepermission->revokePermissionTo($permiss);
            }
        }
        if ($request->oupdate !== $request->update) {
            if (empty($request->oupdate[0])) {
                $permiss = Permission::findById($request->update[0]);
                $assignrolepermission->givePermissionTo($permiss);
            } else {
                $permiss = Permission::findById($request->oupdate[0]);
                $assignrolepermission->revokePermissionTo($permiss);
            }
        }
        if ($request->odelete !== $request->delete) {
            if (empty($request->odelete[0])) {
                $permiss = Permission::findById($request->delete[0]);
                $assignrolepermission->givePermissionTo($permiss);
            } else {
                $permiss = Permission::findById($request->odelete[0]);
                $assignrolepermission->revokePermissionTo($permiss);
            }
        }

        // \dd($request->all());
        // return route('assignrolepermission.index');
        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data was updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // \dd($id);
        // return 'Destroy neh yee';
        $filter = \explode(';', $id);
        $role = Role::findById($filter[1]);
        // \dd($role);
        $permis = Permission::findById($filter[0]);
        // \dd($permis);
        $role->revokePermissionTo($permis);

        return route('assignrolepermission.index');
    }

    public function getSubmenus(Request $request)
    {
        $submenus = DB::table('navigations')
            ->where('main_menu', $request->menu_id)
            ->get();
        if (\count($submenus) > 0) {
            return \response()->json($submenus);
        }
    }

    public function getPermisItems(Request $request) {
        // \dd($request->sub_menu);
        $nav = DB::table('navigations')
            ->where('id', $request->sub_menu)->get();
        // \dd($nav[0]->url);
        $permis = DB::table('permissions')
            ->where('name', 'like' , '%'.$nav[0]->url)->get();
        // \dd($permis);
        if (\count($permis) > 0 ) {
            return \response()->json($permis);
        }
    }
}
