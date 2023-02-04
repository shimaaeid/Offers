<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'name' => 'required|unique:cities,name->ar',
            'name_en' => 'required|unique:cities,name->en',
            'country_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال اسم المدينه',
            'country_id.required' => 'يجب ادخال الدوله التابعه'


        ];
    }
}
