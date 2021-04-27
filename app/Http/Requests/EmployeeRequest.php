<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:200',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:100',
            'company_id' => 'required|integer',
        ];
    }
}
