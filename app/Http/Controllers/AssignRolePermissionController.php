<?php

namespace App\Http\Controllers;

use DB;
use dataTable;
use App\Models\Role;
use App\Models\Navigation;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\DataTables\RolePermissionDataTable;


class AssignRolePermissionController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create accessmanagements/assignrolepermission')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $this->authorize('read accessmanagements/assignrolepermission');
        $roles = Role::all();
        $navigation = Navigation::with('subMenus')->whereNull('main_menu')->get();

        if (\request()->ajax()) {
            if (!empty($request->filter_role)) {
                $permiss = DB::table('permissions')
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                    ->select('permissions.id as pid', 'permissions.name as pname', 'roles.id as rid', 'roles.name as rname')
                    ->where('roles.id', $request->filter_role)
                    ->get();
            } else {
                $permiss = DB::table('permissions')
                    ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                    ->select('permissions.id as pid', 'permissions.name as pname', 'roles.id as rid', 'roles.name as rname')
                    ->get();
            }
            return dataTables()->of($permiss)
                ->addColumn('action', function ($row) {
                    return '<button type="button" data-id=' . $row->pid . ';' . $row->rid . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                })->with(20)
                ->make(true);
        }

        return \view('accessmanagements/assignrolepermission', \compact('roles', 'navigation'), [
            'menu'      => 'Access Management',
            'title'     => 'Assign Role Permission'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('accessmanagements/assignrolepermission-action', [
            'roles'         => new Role(),
            'permissions'    => new Permission()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'test store';
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
