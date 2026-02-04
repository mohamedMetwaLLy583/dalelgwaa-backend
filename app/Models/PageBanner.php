<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_us_title_ar',
        'about_us_title_en',
        'about_us_desc_ar',
        'about_us_desc_en',
        'contact_us_title_ar',
        'contact_us_title_en',
        'contact_us_desc_ar',
        'contact_us_desc_en',
    ];
}
