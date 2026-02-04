<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'primary_phone' => 'nullable|string|max:20',
            'secondary_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'x' => 'nullable|url|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'dark_logo' => 'nullable|image',
            'light_logo' => 'nullable|image',
            'address_en' => 'nullable|string|max:255',
            'address_ar' => 'nullable|string|max:255',
            'footer_description_ar' => 'nullable|string',
            'footer_description_en' => 'nullable|string'
        ];
    }
}
