<?php

namespace App\Http\Requests\Banner;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PageBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'about_us_title_ar' => 'nullable|string|max:255',
            'about_us_title_en' => 'nullable|string|max:255',
            'about_us_desc_ar' => 'nullable|string',
            'about_us_desc_en' => 'nullable|string',
            'contact_us_title_ar' => 'nullable|string|max:255',
            'contact_us_title_en' => 'nullable|string|max:255',
            'contact_us_desc_ar' => 'nullable|string',
            'contact_us_desc_en' => 'nullable|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $validator->errors()->first()
        ], 400));
    }


    public function attributes()
    {
        return RuleFactory::make(trans('validation.attributes'));
    }
}
