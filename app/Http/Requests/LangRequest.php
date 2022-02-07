<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LangRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
           'name'=>'required|string|max:100',
           'abbr'=>'required|string|max:10',
        //    'active'=>'required|in:1',
           'direction'=>'required|in:rtl,ltr'
        ];
    }
    public function messages(){
        return [
        'required'=>'this field is required',
        'name.string'=>'this field must be has letter',
        'name.max'=>'name of langeuages shouldnt be increased 100 letter',
        'in'=>'value entered has an error',
        'abbr.max'=>'this field must be greater than 10 letter'
        ];
        
    }
}