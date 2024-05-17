<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
 
class RoleController extends Controller
{

    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create configurations/role')->only('create');
    } 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        // \dd($dataTable);
        $this->authorize('read configurations/role');
        return $dataTable->render('configurations.role', [
            'menu'     => 'Configuration',
            'title'     => 'Role'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('configurations.role-action', ['role' => new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->all());
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data already created!'
        ]);
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
    public function edit(Role $role)
    {
        // \dd($role->all());
        return \view('configurations.role-action', \compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->name         = $request->name;
        $role->guard_name   =  $request->guard_name;
        $role->save();

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
    public function destroy(Role $role)
    {
        $role->delete();
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data was deleted!'
        ]);
    }
}
