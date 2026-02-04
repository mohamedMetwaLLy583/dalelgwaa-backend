<?php

namespace App\Http\Resources\Property;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailedPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $convertToArabic = function ($string) {
            return strtr($string, [
                '0' => '٠', '1' => '١', '2' => '٢', '3' => '٣', '4' => '٤',
                '5' => '٥', '6' => '٦', '7' => '٧', '8' => '٨', '9' => '٩',
            ]);
        };

        $reverseDate = function ($date) use ($convertToArabic) {
            $reversed = Carbon::parse($date)->format('d-m-Y');
            return $convertToArabic($reversed);
        };

        $reservationsGroupedByDate = $this->whenLoaded('reservations', function () use ($reverseDate, $convertToArabic) {
            return $this->reservations->groupBy(function ($reservation) {
                return Carbon::parse($reservation->date)->format('Y-m-d');
            })->map(function ($reservationsForDate, $date) use ($reverseDate) {
                return [
                    'date' => $reverseDate($date),
                    'times' => $reservationsForDate->map(function ($reservation) {
                        return Carbon::parse($reservation->time)->format('H:i');
                    })->values()->toArray(),
                ];
            })->values()->toArray();
        });

        $groupedByDate = collect($this->reservations)->groupBy(function ($reservation) {
            return Carbon::parse($reservation->date)->format('Y-m-d');
        });

        $blockedDates = $groupedByDate->filter(function ($reservationsForDate) {
            return count($reservationsForDate) >= 3;
        })->keys()->map(function ($date) use ($reverseDate) {
            return $reverseDate($date);
        })->toArray();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'detailed_description' => $this->detailed_description,
            'address' => $this->address,
            'price' => $this->price,
            'type' => $this->type->name ?? 'UnKnown',
            'offer_type' => $this->offer_type,
            'area' => $this->area,
            'floor' => $this->floor,
            'rooms' => $this->rooms,
            'bathrooms' => $this->bathrooms,
            'furnishing' => $this->furnishing,
            'finishing' => $this->finishing,
            'is_available' => $this->is_available,
            'link' => $this->link,
            'gallery' => array_merge(
                [$this->getFirstMediaUrl('main_image')],
                $this->getMedia('gallery')->map(function ($media) {
                    return $media->getUrl();
                })->toArray()
            ),
            'reservedDates' => $reservationsGroupedByDate,
            'blocked_dates' => $blockedDates,
            'partners' => $this->partners->map(function ($partner) {
                return [
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'offer' => $partner->offer,
                    'link' => $partner->link,
                    'image' => $partner->getFirstMediaUrl(),
                    'sticker' => $partner->getFirstMediaUrl('sticker') ?: null,
                ];
            })->toArray(),
        ];
    }
}
