<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
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
            'first' => 'required',
            'last' => 'required',
            'dob' => 'required | date | before:today', 
            'email' => 'required | email | unique:applicants',
            'applicant_type' => 'required | not_in:-1', 
            'applicant_id', 
        ];
    }
}
