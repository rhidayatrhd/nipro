<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Requests\NavigationRequest;
use App\DataTables\NavigationMenuDataTable;
use App\Http\Requests\NavigationMenuRequest;

class NavigationMenuController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        // $this->middleware('can:configurations/navigationmenu')->only('create');
        $this->middleware('can:admin')->only('create') || $this->middleware('can:configurations/navigationmenu')->only('create');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NavigationMenuDataTable $dataTable)
    {
        $this->authorize('admin', 'read configurations/navigationmenu');
        return $dataTable->render('configurations.navigationmenu', [
            'menu'     => 'Configuration',
            'title'     => 'Navigation Menu'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('configurations.navigationmenu-action', ['navigationmenu' => new Navigation()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavigationRequest $request)
    {
        // \dd($request->all());
        Navigation::create($request->all());
        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data already created!'
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
    public function edit(Navigation $navigationmenu)
    {
        return \view('configurations.navigationmenu-action', \compact('navigationmenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NavigationMenuRequest $request, Navigation $navigationmenu)
    {
        $navigationmenu->name = $request->name;
        $navigationmenu->url = $request->url;
        $navigationmenu->icon = $request->icon;
        $navigationmenu->main_menu = $request->main_menu;
        $navigationmenu->save();

        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data was update!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navigation $navigationmenu)
    {
        $navigationmenu->delete();
        return \response()->json([
            'status'    => 'success',
            'message'   => 'Data was deleted!'
        ]);
    }
}

