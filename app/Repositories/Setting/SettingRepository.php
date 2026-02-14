<?php

namespace App\Repositories\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SettingRepository
{
    /**
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data)
    {
        try {
            DB::beginTransaction();

            $setting = Setting::first();
            $setting->update([
                'address:ar'            => $data['address_ar']            ?? null,
                'address:en'            => $data['address_en']            ?? null,
                'primary_phone'         => $data['primary_phone']         ?? null,
                'secondary_phone'       => $data['secondary_phone']       ?? null,
                'email'                 => $data['email']                 ?? null,
                'whatsapp'              => $data['whatsapp']              ?? null,
                'facebook'              => $data['facebook']              ?? null,
                'instagram'             => $data['instagram']             ?? null,
                'x'                     => $data['x']                     ?? null,
                'linkedin'              => $data['linkedin']              ?? null,
                'footer_description:ar' => $data['footer_description_ar'] ?? null,
                'footer_description:en' => $data['footer_description_en'] ?? null,
            ]);

            if (isset($data['dark_logo'])) {
                $setting->clearMediaCollection('dark_logo');
                $setting->addMedia($data['dark_logo'])->toMediaCollection('dark_logo');
            }

            if (isset($data['light_logo'])) {
                $setting->clearMediaCollection('light_logo');
                $setting->addMedia($data['light_logo'])->toMediaCollection('light_logo');
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => __('response.updated')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);

            return response()->json(['error' => __('response.server_error')], 500);
        }
    }
}
