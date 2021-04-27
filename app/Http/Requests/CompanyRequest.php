<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:200',
            'website' => 'nullable|string|max:100',
            'email' => 'nullable|string|email|max:100',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100,max_width=10000,max_height=10000',
        ];
    }
}
