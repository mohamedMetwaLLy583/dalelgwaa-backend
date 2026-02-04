<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory , Translatable;

    protected $with = ['translations'];
    public $translatedAttributes = ['name'];

    public function properties() : HasMany
    {
        return $this->hasMany(Property::class);
    }

}
