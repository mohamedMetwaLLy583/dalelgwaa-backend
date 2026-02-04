<?php

namespace App\Http\Requests\AboutUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Exceptions\HttpResponseException;

class AboutUsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description_one_ar' => 'required|string',
            'description_one_en' => 'required|string',
            'description_two_en' => 'required|string',
            'description_two_ar' => 'required|string',
            'description_three_ar' => 'required|string',
            'description_three_en' => 'required|string',
            'image_one' => 'nullable|image',
            'image_two' => 'nullable|image',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $validator->errors()->first()
        ], 400));
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return RuleFactory::make(trans('validation.attributes'));
    }
}
