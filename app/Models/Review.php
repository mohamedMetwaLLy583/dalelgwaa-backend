<?php

namespace App\Models;

use App\Enums\Review\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'review',
        'rating',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'status' => Status::class,
    ];

    public function toggleStatus(): string
    {
        if ($this->status === Status::Active) {
            $this->status = Status::Inactive;
            $this->save();
            return 'Review deactivated successfully.';
        } else {
            $this->status = Status::Active;
            $this->save();
            return 'Review activated successfully.';
        }
    }

}
