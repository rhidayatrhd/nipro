<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentDataTable;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create masterdatas/department')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentDataTable $dataTable)
    {
        $this->authorize('read masterdatas/department');
        return $dataTable->render('masterdatas.department.index', [
            'menu'     => 'Master Data',
            'title'     => 'Master Department',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('masterdatas.department.dept-action', [
            'department'      => new Department(),
            'menu'     => 'Master Data',
            'title'     => 'Create Department',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        Department::create($request->all());
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
    public function edit(Department $department)
    {
        return \view('masterdatas.department.dept-action', [
            'menu'     => 'Master Data',
            'title'     => 'Update Department'
        ], \compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Department $department)
    {
        $rule = [
            'name'  => 'required',
        ];
        $validated = $request->validate($rule);
        $department->update($validated);
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
    public function destroy(Department $department)
    {
        $department->delete();
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data was deleted!'
        ]);
    }
}
