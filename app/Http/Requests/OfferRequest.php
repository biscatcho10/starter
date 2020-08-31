<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_ar' => 'required:max:100',
            'name_en' => 'required:max:100',
            'price' => 'required|numeric',
            'details_ar' => 'required',
            'details_en' => 'required',
            // 'image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
                'name_ar.required' => __('messages.offer name required'),
                'name_en.required' => __('messages.offer name required'),
                'name_ar.unique' => __('messages.offer name must be unique'),
                'name_en.unique' => __('messages.offer name must be unique'),
                'price.required' => __('messages.Offer Price required'),
                'price.numeric' => __('messages.Offer price numeric'),
                'details_ar.required' => __('messages.Offer details required'),
                'details_en.required' => __('messages.Offer details required'),
                'Offerimage.required' => __('messages.Offer Image required'),

        ];
    }
}
