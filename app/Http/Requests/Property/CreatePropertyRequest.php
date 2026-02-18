<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyRequest extends FormRequest
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
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'detailed_description_ar' => 'nullable|string',
            'detailed_description_en' => 'nullable|string',
            'price' => 'required|string',
            'area' => 'required|string',
            'rooms' => 'required|string',
            'bathrooms' => 'required|string',
            'floor_ar' => 'nullable|string',
            'floor_en' => 'nullable|string',
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
            'offer_type' => 'required|string|in:rent,sale',
            'furnishing_ar' => 'nullable|string',
            'furnishing_en' => 'nullable|string',
            'finishing_ar' => 'nullable|string',
            'finishing_en' => 'nullable|string',
            'is_available' => 'required|boolean',
            'in_home' => 'required|boolean',
            'view_count' => 'nullable|string',
            'type_id' => 'required|exists:types,id',
            'link' => 'nullable|url',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'main_image' => 'required|image',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image',
            'owner_name' => 'nullable|string|max:255',
            'owner_phone' => 'nullable|string|min:6|max:15',
            'owner_description' => 'nullable|string',
            'owner_address' => 'nullable|string|max:255',
            'partners' => 'nullable|array',
            'partners.*.id' => 'required|exists:partners,id',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();

            if (empty($data['title_en']) && empty($data['title_ar'])) {
                $validator->errors()->add('title', 'Either title_en or title_ar must be provided.');
            }

            if (empty($data['description_en']) && empty($data['description_ar'])) {
                $validator->errors()->add('description', 'Either description_en or description_ar must be provided.');
            }

            if (empty($data['detailed_description_en']) && empty($data['detailed_description_ar'])) {
                $validator->errors()->add('detailed_description', 'Either detailed_description_en or detailed_description_ar must be provided.');
            }

            if (empty($data['floor_en']) && empty($data['floor_ar'])) {
                $validator->errors()->add('floor', 'Either floor_en or floor_ar must be provided.');
            }

            if (empty($data['address_en']) && empty($data['address_ar'])) {
                $validator->errors()->add('address', 'Either address_en or address_ar must be provided.');
            }

            if (empty($data['furnishing_en']) && empty($data['furnishing_ar'])) {
                $validator->errors()->add('furnishing', 'Either furnishing_en or furnishing_ar must be provided.');
            }

            if (empty($data['finishing_en']) && empty($data['finishing_ar'])) {
                $validator->errors()->add('finishing', 'Either finishing_en or finishing_ar must be provided.');
            }
        });
    }
}
