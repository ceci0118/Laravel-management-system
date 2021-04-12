<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('applicants')->ignore($this->applicant),
            ],
            'applicant_type' => 'required | not_in:-1',
            'applicant_id', 
        ];
    }
}
