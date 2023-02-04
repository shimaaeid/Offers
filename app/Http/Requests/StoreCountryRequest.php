<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
            //
            'name' => 'required|unique:countries,name->ar',
            'name_en' => 'required|unique:countries,name->en'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('countries.name.required'),
            'name.unique' => trans('countries.name.unique'),
            'name_en.required' => trans('countries.name_en.required'),
            'name_en.unique' => trans('countries.name_en.unique'),

        ];
    }
}
