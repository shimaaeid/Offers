<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
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

            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:shops',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|numeric|unique:shops,phone',
            'opening_hours' => 'nullable',
            'location' => 'nullable',
            'location_url' => 'nullable',
            'whatsapp' => 'nullable|numeric|unique:shops,whatsapp',
            'insta' => 'nullable|unique:shops,insta',
            'snap' => 'nullable|unique:shops,snap',
            'web_site' => 'nullable',
            'shoptype_id' => 'nullable',
            'months' => 'required',
            'subscription_date' => 'nullable',
            'expire_date' => 'nullable',
            'category_id' => 'nullable',
            'packagetype_id' => 'nullable',
            'description' => 'nullable',
            'profile_path' => 'nullable',
            'cover_path' => 'nullable',



        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('shops.name.required'),
            'email.required' => trans('shops.email.required'),
            'email.email' => trans('shops.email.email'),
            'email.unique' => trans('shops.email.unique'),
            'password.requied' => trans('shops.password.requied'),
            'password.confirmed' => trans('shops.password.confirmed'),
            'phone.required' => trans('shops.phone.required'),
            'phone.numeric' => trans('shops.phone.numeric'),
            'phone.unique' => trans('shops.phone.unique'),
            'whatsapp.numeric' => trans('shops.whatsapp.numeric'),
            'whatsapp.unique' => trans('shops.whatsapp.unique'),
            'insta.unique' => trans('shops.insta.unique'),
            'snap.unique' => trans('shops.snap.unique'),
            'months.required' => trans('shops.months.required'),
        ];
    }
}
