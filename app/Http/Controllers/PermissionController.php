<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\DataTables\PermissionDataTable;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware(['can:admin'])->only('create') || $this->middleware(['can:configurations/permission'])->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionDataTable $dataTable)
    {
        $this->authorize('admin', 'read configurations/permission');
        return $dataTable->render('configurations.permission', [
            'menu'     => 'Configuration',
            'title'     => "Permission"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('configurations.permission-action', ['permission' => new Permission()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data already created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        // \dd($permission->all());
        return \view('configurations.permission-action', \compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        // \dd($request->all());
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->save();

        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data already save.!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data was deleted!'
        ]);
    }
}
