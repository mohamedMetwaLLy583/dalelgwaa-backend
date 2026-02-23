<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\CreatePropertyRequest;
use App\Http\Requests\Property\UpdatePropertyRequest;
use App\Http\Resources\Property\DashboardPropertyResource;
use App\Models\Property;
use App\Traits\ApiTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class DashboardPropertyController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;


    public function index()
    {
        $properties = Property::paginate(10);
        return DashboardPropertyResource::collection($properties);
    }


    public function show(Property $property)
    {
        return new DashboardPropertyResource($property);
    }


    public function create(CreatePropertyRequest $request)
    {
        DB::beginTransaction();

        try {
            $property = new Property();

            $title_ar = $request->input('title_ar');
            $title_en = $request->input('title_en');
            $property->translateOrNew('ar')->title = $title_ar ?? $title_en;
            $property->translateOrNew('en')->title = $title_en ?? $title_ar;

            $description_ar = $request->input('description_ar');
            $description_en = $request->input('description_en');
            $property->translateOrNew('ar')->description = $description_ar ?? $description_en;
            $property->translateOrNew('en')->description = $description_en ?? $description_ar;

            $detailed_description_ar = $request->input('detailed_description_ar');
            $detailed_description_en = $request->input('detailed_description_en');
            $property->translateOrNew('ar')->detailed_description = $detailed_description_ar ?? $detailed_description_en;
            $property->translateOrNew('en')->detailed_description = $detailed_description_en ?? $detailed_description_ar;

            $floor_ar = $request->input('floor_ar');
            $floor_en = $request->input('floor_en');
            $property->translateOrNew('ar')->floor = $floor_ar ?? $floor_en;
            $property->translateOrNew('en')->floor = $floor_en ?? $floor_ar;

            $address_ar = $request->input('address_ar');
            $address_en = $request->input('address_en');
            $property->translateOrNew('ar')->address = $address_ar ?? $address_en;
            $property->translateOrNew('en')->address = $address_en ?? $address_ar;

            $furnishing_ar = $request->input('furnishing_ar');
            $furnishing_en = $request->input('furnishing_en');
            $property->translateOrNew('ar')->furnishing = $furnishing_ar ?? $furnishing_en;
            $property->translateOrNew('en')->furnishing = $furnishing_en ?? $furnishing_ar;

            $finishing_ar = $request->input('finishing_ar');
            $finishing_en = $request->input('finishing_en');
            $property->translateOrNew('ar')->finishing = $finishing_ar ?? $finishing_en;
            $property->translateOrNew('en')->finishing = $finishing_en ?? $finishing_ar;

            $property->price = $request->input('price');
            $property->area = $request->input('area');
            $property->rooms = $request->input('rooms');
            $property->bathrooms = $request->input('bathrooms');
            $property->offer_type = $request->input('offer_type');
            $property->is_available = $request->input('is_available');
            $property->in_home = $request->input('in_home');
            $property->type_id = $request->input('type_id');
            $property->link = $request->input('link');
            $property->latitude = $request->input('latitude');
            $property->longitude = $request->input('longitude');
            $property->owner_name = $request->input('owner_name');
            $property->owner_phone = $request->input('owner_phone');
            $property->owner_description = $request->input('owner_description');
            $property->owner_address = $request->input('owner_address');
            $property->user_id = auth()->id();

            if ($request->hasFile('main_image')) {
                $property->addMedia($request->file('main_image'))->toMediaCollection('main_image');
            }

            if (isset($request['gallery']) && is_array($request['gallery'])) {
                foreach ($request['gallery'] as $image) {
                    $property->addMedia($image)->toMediaCollection('gallery');
                }
            }
            $property->save();
            if (!$property->id) {
                throw new \Exception('Failed to save property to the database.');
            }

            if (isset($request['partners']) && is_array($request['partners'])) {
                $partnerIds = array_column($request['partners'], 'id');
                if (!empty($partnerIds)) {
                    $property->partners()->attach($partnerIds); // Use array for efficiency
                }
            }


            DB::commit();

            return $this->sendSuccess(__('response.created'));
        } catch (\Throwable $th) {
            DB::rollBack();

            report($th);

            return $this->sendError(__('response.server_error'), [], 500);
        }
    }

    public function update(Property $property, UpdatePropertyRequest $request)
    {
        DB::beginTransaction();

        try {
            $titleAr = $request->input('title_ar');
            $titleEn = $request->input('title_en');
            $property->translateOrNew('ar')->title = $titleAr ?: $titleEn;
            $property->translateOrNew('en')->title = $titleEn ?: $titleAr;

            $descriptionAr = $request->input('description_ar');
            $descriptionEn = $request->input('description_en');
            $property->translateOrNew('ar')->description = $descriptionAr ?: $descriptionEn;
            $property->translateOrNew('en')->description = $descriptionEn ?: $descriptionAr;

            $detailedDescriptionAr = $request->input('detailed_description_ar');
            $detailedDescriptionEn = $request->input('detailed_description_en');
            $property->translateOrNew('ar')->detailed_description = $detailedDescriptionAr ?: $detailedDescriptionEn;
            $property->translateOrNew('en')->detailed_description = $detailedDescriptionEn ?: $detailedDescriptionAr;

            $property->price = $request->input('price');
            $property->area = $request->input('area');
            $property->rooms = $request->input('rooms');
            $property->bathrooms = $request->input('bathrooms');
            $property->offer_type = $request->input('offer_type');

            $floorAr = $request->input('floor_ar');
            $floorEn = $request->input('floor_en');
            $property->translateOrNew('ar')->floor = $floorAr ?: $floorEn;
            $property->translateOrNew('en')->floor = $floorEn ?: $floorAr;

            $addressAr = $request->input('address_ar');
            $addressEn = $request->input('address_en');
            $property->translateOrNew('ar')->address = $addressAr ?: $addressEn;
            $property->translateOrNew('en')->address = $addressEn ?: $addressAr;

            $furnishingAr = $request->input('furnishing_ar');
            $furnishingEn = $request->input('furnishing_en');
            $property->translateOrNew('ar')->furnishing = $furnishingAr ?: $furnishingEn;
            $property->translateOrNew('en')->furnishing = $furnishingEn ?: $furnishingAr;

            $finishingAr = $request->input('finishing_ar');
            $finishingEn = $request->input('finishing_en');
            $property->translateOrNew('ar')->finishing = $finishingAr ?: $finishingEn;
            $property->translateOrNew('en')->finishing = $finishingEn ?: $finishingAr;

            $property->is_available = $request->input('is_available');
            $property->in_home = $request->input('in_home');
            $property->type_id = $request->input('type_id');
            $property->link = $request->input('link');
            $property->latitude = $request->input('latitude');
            $property->longitude = $request->input('longitude');
            $property->owner_name = $request->input('owner_name');
            $property->owner_phone = $request->input('owner_phone');
            $property->owner_description = $request->input('owner_description');
            $property->owner_address = $request->input('owner_address');

            if ($request->hasFile('main_image')) {
                $property->clearMediaCollection('main_image');
                $property->addMedia($request->file('main_image'))->toMediaCollection('main_image');
            }

            if (isset($request['gallery']) && is_array($request['gallery'])) {
                $existingGallery = $property->getMedia('gallery');

                foreach ($request['gallery'] as $index => $image) {
                    if (isset($existingGallery[$index])) {
                        $existingGallery[$index]->delete();
                    }
                    $property->addMedia($image)->toMediaCollection('gallery');
                }
            }

            $property->save();
            DB::commit();

            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();

            report($th);

            return $this->sendError(__('response.server_error'), [], 500);
        }
    }

    public function destroy(Property $property)
    {
        try {
            $property->clearMediaCollection();
            $property->delete();

            return $this->sendSuccess(__('response.deleted'));
        } catch (\Throwable $th) {
            report($th);

            return $this->sendError(__('response.server_error'), [], 500);
        }
    }
}
