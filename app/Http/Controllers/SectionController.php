<?php

namespace App\Http\Controllers;

use App\DataTables\SectionDataTable;
use App\Http\Requests\SectionRequest;
use App\Models\Department;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create masterdatas/section')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(SectionDataTable $dataTable)
    public function index(Request $request)
    {
        $this->authorize('read masterdatas/section');
        $dept = Department::all();

        if (\request()->ajax()) {
            if (!empty($request->dept)) {
                $filter = DB::table('sections')
                    ->join('departments', 'departments.id', '=', 'sections.dept_id')
                    ->select('sections.id', 'departments.name as department', 'sections.code', 'sections.name as section')
                    ->where('departments.id', $request->dept)
                    ->get();
            } else {
                $filter = DB::table('sections')
                    ->join('departments', 'departments.id', '=', 'sections.dept_id')
                    ->select('sections.id', 'departments.name as department', 'sections.code', 'sections.name as section')
                    ->get();
            }
            return \datatables()->of($filter)
                ->addColumn('action', function ($row) {
                    $action = '';
                    if(Gate::allows('update masterdatas/section')) {
                    $action = ' <button type="button" data-id=' . $row->id . ' data-jenis="update" class="btn btn-success btn-sm action"><i class="ti-pencil"></i></button>';
                    }
                    if (Gate::allows('delete masterdatas/section')) {
                        $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                    }
                    return $action;
                })->with(60)->make(true);
        }

        // return $dataTable->render('masterdatas.section.index', [
        //     'menu'     => 'Master Data',
        //     'title'     => 'Master Section',
        //     'dept'      => $dept,
        // ]);

        return \view('masterdatas.section.index', \compact('dept'),
        [
            'menu'     => 'Master Data',
            'title'     => 'Master Section',
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::all();
        return \view('masterdatas.section.sect-action', [
            'section'       => new Section(),
            'menu'          => 'Master Data',
            'title'         => 'Create Section',
            'department'    => $department,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        Section::create($request->all());
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
    public function edit(Section $section)
    {
        // \dd($section);
        return \view('masterdatas.section.sect-action', [
            'menu'          => 'Master Data',
            'title'         => 'Edit Section',
        ], \compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $rules = [
            'code'      => 'required',
            'name'      => 'required',
        ];
        $validated = $request->validate($rules);
        $section->update($validated);
        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data was updated!',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data was deleted!'
        ]);
    }
}
