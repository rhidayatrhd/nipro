<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DataPCRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pchost'    => ['required', Rule::unique('computers')->ignore($this->datapc)],
            'name'      => 'required',
            'pctype'    => 'required',
            'brand'     => 'required',
            'model'     => 'required',
            'processor' => 'required',
            'ipadrs'    => 'required',
            'ram'       => 'required',
            'hdd'       => 'required',
            'purchyear' => 'required',
            'username'  => 'required',
            'userlevel' => 'required',
            'userdept'  => 'required',
            'useremail' => 'required',
            'osystem'   => 'required',
            'spreadsheet' => 'required',
            'usedfor'   => 'required',
            'antivirus' => 'required',
        ];
    }
}
