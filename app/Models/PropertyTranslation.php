<?php

namespace App\Models;

use App\Enums\Property\OfferType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'detailed_description',
        'address',
        'floor',
        'furnishing',
        'finishing',
    ];
}
