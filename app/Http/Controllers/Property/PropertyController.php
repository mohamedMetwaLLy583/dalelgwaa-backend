<?php

namespace App\Http\Controllers\Property;

use App\Enums\Property\OfferType;
use App\Enums\Reservation\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\Property\DetailedPropertyResource;
use App\Http\Resources\Property\PropertyResource;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $offerType = $request->query('offer_type');
        $typeId = $request->query('type_id');
        $price = $request->query('price');
        $isAvailable = $request->query('is_available');

        $properties = Property::filter($offerType, $price, $typeId, $isAvailable)
            ->search()
            ->paginate(8);
        return PropertyResource::collection($properties);
    }

    public function show(Property $property)
    {
        $property->view_count = $property->view_count == null ? 1 : $property->view_count + 1;
        $property->save();

        $property->load(['reservations' => function ($query) {
            $query->where('status', Status::Pending);
        }]);

        return new DetailedPropertyResource($property);
    }

    public function relatedProperties(Property $property)
    {
        $relatedProperties = Property::whereHas('translations', function ($query) use ($property) {
            $query->where('offer_type', $property->offer_type);
        })
            ->where('id', '!=', $property->id)
            ->where('is_available', true)
            ->take(3)
            ->get();

        if ($relatedProperties->isEmpty()) {
            return response()->json(['message' => __('response.no_related_properties')], 404);
        }

        return PropertyResource::collection($relatedProperties);
    }

    public function propertiesForRent()
    {
        $properties = Property::whereHas('translations', function ($query) {
            $query->where('offer_type', OfferType::Rent->value);
        })
            ->where('in_home', true)
            ->get();
        return PropertyResource::collection($properties);
    }

    public function propertiesForSale()
    {
        $properties = Property::whereHas('translations', function ($query) {
            $query->where('offer_type', OfferType::Sale->value);
        })->where('in_home', true)
            ->get();

        return PropertyResource::collection($properties);
    }
}
