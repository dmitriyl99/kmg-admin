<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner', 'vin', 'port', 'received_at', 'destination_country',
        'transportation_from', 'transportation_address', 'transportation_price',
        'date_received', 'key',
        'total_due', 'postal_service', 'tracking_number', 'container_id'
    ];

    protected $dates = [
        'date_received', 'received_at'
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function transportation()
    {
        return $this->hasOne(Transportation::class);
    }
}
