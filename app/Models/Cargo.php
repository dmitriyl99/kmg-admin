<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner', 'name', 'vin', 'port', 'received_at', 'destination_country',
        'transportation_from', 'transportation_address', 'transportation_price',
        'date_received', 'key',
        'total_due', 'postal_service', 'tracking_number', 'container_id'
    ];

    protected $dates = [
        'date_received', 'received_at'
    ];

    public function container(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Container::class);
    }

    public function transportation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Transportation::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
