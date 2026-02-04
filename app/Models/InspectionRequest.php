<?php

namespace App\Models;

use App\Enums\InspectionRequest\Status;
use App\Enums\Property\OfferType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class InspectionRequest extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'offer_type',
        'date',
        'time',
        'description',
        'requester_type',
        'status'
    ];

    protected $casts = [
        'offer_type' => OfferType::class,
        'status' => Status::class
    ];
}
