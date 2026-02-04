<?php

namespace App\Models;

use App\Enums\Reservation\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'phone',
        'date',
        'time',
        'status',
        'partner_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
