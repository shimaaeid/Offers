<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffersRequest extends FormRequest
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
            'shop_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'deadline' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => 'يجب ادخال اسم المحل',
            'category_id.required' => 'يجب ادخال نوع العرض',
            'title.requied' => 'يجب ادخال عنوان العرض',
            'description.required' => 'يجب ادخال وصف العرض',
            'price.required' => 'يجب ادخال سعر العرض',
            'discount.required' => 'يجب ادخال الخصم',
            'deadline.required' => 'يجب ادخال موعد انتهاء العرض',
        ];
    }
}
