<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\DataTables\UserRoleDataTable;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;

class AssignUserRoleController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:admin')->only('create') || $this->middleware('can:create accessmanagements/assignuserrole')->only('create');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(UserRoleDataTable $dataTable, Request $request) 
    public function index(Request $request) 
    {
        $this->authorize('read accessmanagements/assignuserrole', 'admin');
        $dept = Department::all();
        if (\request()->ajax()) { 
            if (!empty($request->dept)) {
                $filter = DB::table('users')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->join('sections', 'sections.id', '=', 'users.sect_id')
                    ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->join('departments', 'departments.id', '=', 'sections.dept_id')
                    ->select('users.id', 'users.name', 'departments.name as dept', 'roles.name as role')
                    ->where('departments.id', $request->dept)
                    ->get();
            } else {
                $filter = DB::table('users')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->join('sections', 'sections.id', '=', 'users.sect_id')
                    ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->join('departments', 'departments.id', '=', 'sections.dept_id')
                    ->select('users.id', 'users.name', 'departments.name as dept', 'roles.name as role')
                    ->get();
            }
            return dataTables()->of($filter)
                ->addColumn('action', function ($row) { 
                    return '<button type="button" data-id=' . $row->id . ' data-jenis="update" class="btn btn-warning btn-sm action"><i class="ti-pencil"></i></button>';
                })->with(20)
                ->make(true);
        }
        // return $dataTable->render('accessmanagements/assignuserrole', [
        return \view('accessmanagements/assignuserrole', \compact('dept'), [
            'menu'     => 'Access Management',
            'title'     => "User Role Assignment"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $xuser = User::firstwhere('id', $id);
        $userrole = DB::table('model_has_roles')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_id', $id)->get();
        $roles = Role::all();
        return \view('accessmanagements/assignuserrole-action', [
            'users'  => $xuser,
            'userroles' => $userrole,
            'roles' => $roles,
        ], \compact('id'));
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
        // \dd($request->all());
        // \dd($id);
        if($request->oxuser !== $request->xuser) {
            // \dd($request->oname);
            $xmodel = User::firstwhere('id',$id);
            // \dd($xmodel);
            foreach ($request->oxuser as $key => $val) {
                // \dd($val);
                foreach ($request->xuser as $key => $value) {
                    // dd($value);
                    if ($val !== $value) {
                        $findmodel = DB::table('model_has_roles')
                        ->where('model_id','=', $id)
                        ->where('role_id', '=',$value)->get();
                        if (empty($findmodel[0])) {
                            // \dd($findmodel);
                            $xrole = Role::findById($value);
                            $xmodel->assignRole($xrole);
                            $val = $value;
                        }
                    }
                }
                if ($val !== $value) {
                    $findmodel = DB::table('model_has_roles')
                    ->where('model_id', '=', $id)
                    ->where('role_id', '=', $val)->get();
                    if (!empty($findmodel[0])) {
                        // \dd($findmodel);
                        $xrole = Role::findById($val);
                        $xmodel->removeRole($xrole);
                    }
                }
            }
        }
        // return route('assignuserrole.index', [
        //     'status'    => 'success',
        //     'message'   => 'Data was updated!'
        // ]);
        // return route('assignuserrole')->with([
        //     'status'    => 'success',
        //     'message'   => 'Data was updated!'
        // ]);
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
        $filter = \explode(';', $id);
        $role = Role::findById($filter[1]);
        // \dd($role);
        $user = User::findById($filter[0]);
        // \dd($user);
        $user->removeRole($role);
    }
}
