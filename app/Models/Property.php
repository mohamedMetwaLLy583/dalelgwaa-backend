<?php

namespace App\Models;

use App\Enums\Property\OfferType;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $fillable = [
        'type_id',
        'offer_type',
        'price',
        'area',
        'rooms',
        'bathrooms',
        'is_available',
        'view_count',
        'in_home',
        'link',
        'owner_name',
        'owner_phone',
        'owner_description',
        'owner_address'
    ];

    protected $with = ['translations'];
    public $translatedAttributes = [
        'title',
        'description',
        'detailed_description',
        'address',
        'floor',
        'furnishing',
        'finishing',
    ];

    protected $casts = [
        'offer_type' => OfferType::class
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PropertyTranslation::class, 'property_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeFilter($query, $offerType = null, $price = null, $typeId = null, $isAvailable = null)
    {
        if ($offerType) {
            $query->whereHas('translations', function ($query) use ($offerType) {
                $query->where('offer_type', $offerType);
            });
        }

        if ($typeId) {
            $query->where('type_id', $typeId);
        }

        if ($price) {
            $query->where('price', '<=', $price);
        }

        if (isset($isAvailable)) {
            $query->where('is_available', $isAvailable);
        }

        return $query;
    }

    public function scopeSearch($query)
    {
        return  $query->whereHas('translations', function ($query) {
            $query->where('address', 'like', '%' . request('search') . '%');
        });
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'property_partners');
    }
}
