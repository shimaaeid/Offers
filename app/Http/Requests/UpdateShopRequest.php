<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
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
            'name' => 'required|unique:shops,name',
            'email' => 'required|email|unique:shops,email',
            'password'         => 'required|confirmed',
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
            'name.required' => 'يجب ادخال اسم المحل',
            'email.required' => 'يجب ادخال الايميل',
            'email.email' => 'هذا الحقل يجب ان يكون من نوع ايميل',
            'email.unique' => 'هذا الايميل موجود مسبقا',
            'password.requied' => 'يجب ادخال كلمه المرور',
            'password.confirmed' => 'يجب تأكيد كلمه المرور',
            'phone.required' => 'يجب ادخال رقم الموبايل',
            'phone.numeric' => 'رقم الموبايل يجب ان يكون ارقام فقط',
            'phone.unique' => 'رقم الموبايل موجود مسبقا',
            'whatsapp.numeric' => 'الواتساب يجب ان يكون رقم',
            'whatsapp.unique' => 'رقم الواتساب مسجل مسبقا',
            'insta.unique' => 'خقل الانستجرام موجود مسبقا',
            'snap.unique' => 'حقل الاسناب شات موجود مسبقا',
            'months.required' => 'يجب ادخال عدد شهور الاشتراك',
        ];
    }
}
