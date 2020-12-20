<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Container
 * @package App\Models
 *
 * @property string $container_number
 * @property string $booking_number
 * @property string $shipping_line
 * @property string $port
 * @property string $destination
 * @property integer $capacity
 * @property boolean $paid
 * @property string $tracking_link
 * @property Carbon $departure_date
 * @property Carbon $arrival_date
 * @property integer $invoice_id
 * @property integer $container_status_id
 *
 * @property ContainerStatus $status
 * @property Invoice $invoice
 */
class Container extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'container_number', 'booking_number', 'shipping_line', 'port', 'destination',
        'capacity', 'paid', 'tracking_link', 'departure_date', 'arrival_date',
        'container_status_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @deprecated Use the "casts" property
     *
     * @var array
     */
    protected $dates = [
        'departure_date', 'arrival_date'
    ];

    /**
     * Container status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(ContainerStatus::class);
    }

    /**
     * Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
