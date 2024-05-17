<?php

namespace App\Http\Controllers;

use App\Models\DataPC;
use App\Models\PCSpec;
use Illuminate\Http\Request; 
use App\Http\Controllers\COM;
use PhpParser\Builder\Namespace_;
 
class ComputerInfoController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct() 
    {
        $this->middleware('can:create informations/computer')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $this->authorize('read informations/computer');
        $host = \gethostname();
        $computer = PCSpec::where('pchost', $host)->get();
        $datapc = DataPC::where('pchost', $host)->get();
        // Parameters
        $pc = "."; 
        $wmi = new \COM("winmgmts:\\\\" . $pc . "\\root\\cimv2");
        // $wmi = new \COM('winmgmts:\\.' );

        // <!-- Network Info -->
        $allNW = $wmi->ExecQuery('SELECT * FROM Win32_NetworkAdapter');
        // if ($allNW->itemIndex(1)->servicename == 'rt640x64') {
        if ($allNW->itemIndex(1)->deviceid == '2') {
            $AllWinNW = $allNW->itemIndex(1);
        // } elseif ($allNW->itemIndex(2)->servicename == 'rt640x64') {
        } elseif ($allNW->itemIndex(2)->deviceid == '2') {
            $AllWinNW = $allNW->itemIndex(2);
        }
        // if ($allNW->itemIndex(1)->servicename == 'Netwtw10') {
        if ($allNW->itemIndex(1)->deviceid == '1') {
            $AllWinWF = $allNW->itemIndex(1);
        // } elseif ($allNW->itemIndex(2)->servicename == 'Netwtw10') {
        } elseif ($allNW->itemIndex(2)->deviceid == '1') {
            $AllWinWF = $allNW->itemIndex(2);
        }
        
        // <!-- OS Info -->
        $allOS = $wmi->ExecQuery('SELECT * FROM Win32_OperatingSystem');
        $AllWinOS = $allOS->itemIndex(0);
        // <!-- System Info -->
        $allCOMP = $wmi->ExecQuery('SELECT * FROM Win32_ComputerSystem');
        $AllWinCOMP = $allCOMP->itemIndex(0);
        // <!-- System Info -->
        $allProc = $wmi->ExecQuery('SELECT * FROM Win32_Processor');
        $AllWinProc = $allProc->itemIndex(0);
        // <!-- HDD Info -->
        $allDisk = $wmi->ExecQuery('SELECT * FROM Win32_DiskDrive');
        $AllWinDisk = $allDisk->itemIndex(0);

        // <!-- RAM Info -->
        $allMEM = $wmi->ExecQuery('SELECT * FROM CIM_PhysicalMemory');
        $AllWinMEM = $allMEM->itemIndex(0);

        return view('informations.computer', [
            'menu'      => 'Informations',
            'title'     => 'Computer Info',
            'computer'  => $computer,
            'networks'  => $AllWinNW,
            'wifi'      => $AllWinWF,
            'os'        => $AllWinOS,
            'comp'      => $AllWinCOMP,
            'proc'      => $AllWinProc,
            'disk'      => $AllWinDisk,
            'ram'       => $AllWinMEM
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        // $host = \gethostname();
        // \dd($request->netmacadrs);
        $datapc = DataPC::where('pchost', $host);
        return \view('informations.computer-confirm', \compact('datapc'), ['computer' => new PCSpec()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        return 'Hello';
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

    // public function getProd(): array
    // {
    //     $wmi = new \COM('winmgmts://localhost/root/CIMV2');
    //     $oos = $wmi->ExecQuery('SELECT * FROM Win32_Product');
    //     return $oos;
    // }
}
