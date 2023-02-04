<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBestOffersRequest extends FormRequest
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
            'priority' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => trans('bestOffers.shop_id.required'),
            'category_id.required' => trans('bestOffers.category_id.required'),
            // 'title.requied' => trans('bestOffers.title.requied'),
            'description.required' => trans('bestOffers.description.required'),
            'price.required' => trans('bestOffers.price.required'),
            'discount.required' => trans('bestOffers.discount.required'),
            'priority.required' => trans('bestOffers.priority.required'),
        ];
    }
}
