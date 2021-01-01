<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'transporter', 'cost', 'phone', 'transportation_paid', 'delivered', 'carrier_comment',
        'seller_name', 'lot_number', 'account_number', 'seller_phone', 'seller_address', 'pick_up_by', 'seller_comment',
        'cargo_id', 'warehouse', 'purchased_date', 'paid', 'ready', 'has_photo', 'key', 'status'
    ];

    protected $dates = [
        'pick_up_by', 'purchased_date'
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
