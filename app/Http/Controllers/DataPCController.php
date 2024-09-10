<?php

namespace App\Http\Controllers;

use App\Models\DataPC;
use Illuminate\Http\Request;
use App\Imports\DataPCImport;
use App\DataTables\DataPCDataTable;
use App\Http\Requests\DataPCRequest;
use App\Imports\PCImport;
use App\Models\Department;
use App\Models\Section;
use Excel;
use Illuminate\Http\Client\Request as ClientRequest;

class DataPCController extends Controller 
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create exportimport/datapc')->only('create');
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataPCDataTable $dataTable)
    {
        $this->authorize('read exportimport/datapc');
        return $dataTable->render('exportimport.datapc', [
            'menu'      => 'Import Data',
            'title'     => "Computers"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hardcost = Department::all();
        $secost = Section::all();
        return \view('exportimport.datapc-action', [
            'datapc' => new DataPC(),
            'deptcost'   => $hardcost,
            'sectcost'   => $secost
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    public function store(DataPCRequest $request)
    {
    //   \dd($request);
    //   $validateData = $request->validate([
    //     'pchost'        => 'required|unique:computers|max:20',
    //     'ipadrs'        => 'required',
    //     'username'      => 'required',
    //     'osystem'       => 'required',
    //   ]);
      DataPC::create($request->all());
      return \response()->json([
            'status'        => 'success',
            'message'       => 'New Data PC was created!'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPC  $dataPC
     * @return \Illuminate\Http\Response
     */
    public function show(DataPC $dataPC) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPC  $dataPC
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPC $datapc)
    {
        // $pc = $dpc->all();
        $hardcost = Department::all();
        $secost = Section::all();
        return \view('exportimport.datapc-action', [
                'deptcost'   => $hardcost,
                'sectcost'   => $secost
        ], 
        \compact('datapc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPC  $dataPC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPC $datapc)
    {
        // \dd($request->pchost);
        $rules = [
            'pchost'        => 'required|max:20',
            'ipadrs'        => 'required',
            'username'      => 'required',
            'osystem'       => 'required',
        ];
        $request->validate($rules);
        if ($request->pchost !== $datapc->pchost) {
            $request->validate([
                'pchost'        => 'required|unique:computers|max:20',
            ]);
            $datapc->hpchost = $datapc->pchost;
            $datapc->pchost = $request->pchost;
        }
        $datapc->asset_id = $request->asset_id;
        $datapc->pctype = $request->pctype;
        $datapc->brand = $request->brand;
        $datapc->model = $request->model;
        $datapc->processor = $request->processor;
        $datapc->ipadrs = $request->ipadrs;
        $datapc->ram = $request->ram;
        $datapc->hdd = $request->hdd;
        $datapc->purchyear = $request->purchyear;
        $datapc->username = $request->username;
        $datapc->userlevel = $request->userlevel;
        $datapc->userdept = $request->userdept;
        $datapc->cost_ctr = $request->cost_ctr;
        $datapc->dept_id = $request->dept_id;
        $datapc->sect_id = $request->sect_id;
        $datapc->useremail = $request->useremail;
        $datapc->osystem = $request->osystem;
        $datapc->spreadsheet = $request->spreadsheet;
        $datapc->usedfor = $request->usedfor;
        $datapc->antivirus = $request->antivirus;
        $datapc->save();

        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data was Update!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int &id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPC $datapc)
    {
        // \dd($datapc->pchost);
        $datapc->delete();
        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data was Deleted!'
        ]);
    }
}
