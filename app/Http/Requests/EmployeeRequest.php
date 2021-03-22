<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
                    'firstname'=>'required',
                    'lastname'=>'required',
                    'email'=>'required|email|unique:employees,email',
                    'phone'=>'required|digits_between:6,10|unique:employees,phone',
                    'company_id'=>'required'
                ];
            }
            case 'PATCH': {
                $rules = [
                    'firstname'=>'required',
                    'lastname'=>'required',
                    'email'=>'required|email|unique:employees,email,'.$this->segment(2),
                    'phone'=>'required|digits_between:6,10|unique:employees,phone'.$this->segment(2),
                    'company_id'=>'required'
                ];
            }
        }

        return $rules;
    }
}
