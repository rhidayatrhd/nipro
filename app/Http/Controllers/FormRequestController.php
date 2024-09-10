<?php

namespace App\Http\Controllers;

use App\DataTables\FormRequestDataTable;
use App\Models\Department;
use App\Models\FormRequest;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormRequestController extends Controller
{
    public function index(FormRequestDataTable $dataTable)
    {
        return $dataTable->render('requestforms.it_requestform.index', [
            'menu'     => 'Form Request',
            'title'     => 'IT Form Request',
        ]);
    }

    public function create() 
    {
        return \view('requestforms.it_requestform.action', [
            'it_requestform'   => new FormRequest(),
            'menu'     => 'Form Request',
            'title'     => 'Create Form Request',
            'department' => Department::all(), 
        ]);
    }

    public function store(Request $request)
    {
        // \dd($request->all());
        $validated = $request->validate([
            'dept_id'   => 'required|not_in:-1',
            'form_id'   => 'required|unique:form_requests',
            'form_name' => 'required',
            'form_link' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->file('form_link'))
        {
            $file = $request->file('form_link');
            // \dd($file);
            // $filename = time() . '_' . $request->file('form_link')->getClientOriginalName();
            // $filename = 'form-request/'. $file->hashName();
            $filename = $file->hashName();
            // \dd($filename);
            // $filepath = $request->get('form-request')->getClientOriginalName() . '.' . $request->get('form-request')->getClientOriginalExtension();
            $filepath = $request->file('form_link')->storeAs('form-request',$filename, 'public');
            // \dd($filepath);
            $validated['form_link'] = $request->file('form_link')->storeAs('form-request', $filename, 'public');
        }
        $validated['form_desc'] = $request->form_desc;
        FormRequest::create($validated);
        return redirect()->back()->with('success', 'Form Request was created!');
        // return response()->json([
        //     'status'        => 'success',
        //     'message'       => 'Data already created!'
        // ]);

    }

    public function show(FormRequest $it_requestform)
    {
        return \view('requestforms.it_requestform.show', \compact('it_requestform'));
    }

    public function edit(FormRequest $it_requestform)
    {
        return \view('requestforms.it_requestform.action', \compact('it_requestform'));
    }

    public function update(Request $request, FormRequest $it_requestform)
    {
        $rules = [
            'form_name'     => 'required',
            'form_link'     => 'required|mimes:pdf|max:2048',
        ];

        $validated = $request->validate($rules);

        if ($request->file('form_link')) 
        {
            if ($request->oldform_link) 
            {
                Storage::delete($request->oldform_link);
            }
            $filename = $request->file('form_link')->hashName();
            // \dd($filename);
            $validated['form_link'] = $request->file('form_link')->storeAs('form-request', $filename, 'public');
        }
        $validated['form_desc'] = $request->form_desc;
        $it_requestform->update($validated);

        return redirect()->back()->with('success', 'Form Request was created!');
        // return \response()->json([
        //     'status'    => 'success',
        //     'message'   => 'Data was updated!'
        // ]);
    }

    public function destroy(FormRequest $it_requestform)
    {
        if ($it_requestform->form_link) 
        {
            Storage::delete($it_requestform->form_link);
        }
        $it_requestform->delete();
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data was deleted!'
        ]);
    }

}
