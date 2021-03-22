<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        switch($this->method()){
            case 'POST': {
                $rules = [
                    'name'=>'required',
                    'email'=>'required|email|unique:companies,email',
                    'website'=>'required|url',
                    'logo'=>'required|max:10000'
                ];
            }
            case 'PATCH': {
                $rules = [
                    'name'=>'required',
                    'email'=>'required|email|unique:companies,email,'.$this->segment(2),
                    'website'=>'required|url',
                    'logo'=>'max:10000'
                ];
            }
        }

        return $rules;
    }
}
