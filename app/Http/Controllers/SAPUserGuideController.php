<?php

namespace App\Http\Controllers;

use App\DataTables\SAPUserGuideDataTable;
use App\Http\Requests\SAPUserGuideRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\SAPUserGuide;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\RollbarHandler;
use Spatie\Permission\Middlewares\RoleMiddleware;

class SAPUserGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SAPUserGuideDataTable $dataTable)
    {
        // \dd(\auth()->user()->roles[1]->id);
        return $dataTable->render('userguides.sap_userguide.index', [
            'menu'     => 'User Guide',
            'title'     => "SAP User Guide",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('userguides.sap_userguide.action', [
            'sap_userguide' => new SAPUserGuide()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SAPUserGuideRequest $request)
    {
        SAPUserGuide::create($request->all());
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
        //
    }
}
