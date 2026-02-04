<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutUs extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'description_one_ar',
        'description_one_en',
        'description_two_ar',
        'description_two_en',
        'description_three_ar',
        'description_three_en',
    ];
}
