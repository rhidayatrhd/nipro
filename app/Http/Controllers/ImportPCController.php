<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PCImport;
use App\Models\DataPC;
use Excel;

class ImportPCController extends Controller
{
    public function import_pc(Request $request) {
        // dd($request->all());

        $this->validate($request, [
            'pcfile'  => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('pcfile');
        // \dd($file);

        if (empty($file)) {
            return back()->with('error', 'File data not found!');
        }
        // $filename = \rand().$file->getClientOriginalName();
        // $file->move('file_upload', $filename);

        // Excel::import(new PCImport(), $request->file('pcfile'));
        Excel::import(new PCImport(), $file);
        return \redirect()->back()->with('success', 'Data already Imported!');
    }

    public function edit(DataPC $datapc) {
        $host = \gethostname();
        $datapc = DataPC::where('pchost', $host)->get();

        // Parameters
        $wmi = new COM('WinMgmts:\\\\.');
            // <!-- Network Info -->
        $allNW = $wmi->ExecQuery('SELECT * FROM Win32_NetworkAdapter');
        $AllWinNW = $allNW->itemIndex(1);
        // <!-- OS Info -->
        $allOS = $wmi->ExecQuery('SELECT * FROM Win32_OperatingSystem');
        $AllWinOS = $allOS->itemIndex(0);
        // <!-- System Info -->
        $allCOMP = $wmi->ExecQuery('SELECT * FROM Win32_ComputerSystem');
        $AllWinCOMP = $allCOMP->itemIndex(0);

        return \view('exportimport.datapc-action', \compact('datapc'));
    }
}
