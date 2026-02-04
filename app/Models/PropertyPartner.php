<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPartner extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'partner_id',
    ];
    protected $table = 'property_partners';

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
