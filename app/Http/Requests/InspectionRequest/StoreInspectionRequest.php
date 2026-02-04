<?php

namespace App\Http\Requests\InspectionRequest;

use App\Enums\InspectionRequest\Status;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use InvalidArgumentException;

class StoreInspectionRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:6|max:15',
            'address' => 'required|string|max:255',
            'offer_type' => 'required|string|in:rent,sale',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'description' => 'required|string',
            'requester_type' => 'required|string|max:255',
            'status'      =>  Status::Pending->value,
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'date' => $this->convertToGregorianDate($this->date),
            'time' => $this->convertToStandardTime($this->time),
        ]);
    }

    private function convertToGregorianDate($date)
    {
        if (!$date) {
            return null;
        }

        $standardDate = strtr($date, [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        $formats = ['Y-m-d', 'Y/m/d', 'd-m-Y', 'd/m/Y'];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $standardDate)->format('Y-m-d');
            } catch (Exception $e) {
                continue;
            }
        }

        throw new InvalidArgumentException('Invalid date format: ' . $date);
    }

    private function convertToStandardTime($time)
    {
        if (!$time) {
            return null;
        }

        $standardTime = strtr($time, [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        if (!DateTime::createFromFormat('H:i', $standardTime)) {
            throw new InvalidArgumentException('Invalid time format: ' . $time);
        }

        return $standardTime;
    }

}
