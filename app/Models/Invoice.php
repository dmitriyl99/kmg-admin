<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 * @package App\Models
 *
 * @property boolean $active
 * @property Carbon $invoice_date
 * @property string $container_size
 * @property string $company
 * @property integer $total_due
 * @property string $shipper
 * @property string $consignee
 *
 * @property Container $container
 */
class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'active', 'invoice_date', 'container_size', 'company', 'total_due',
        'shipper', 'consignee'
    ];

    protected $dates = [
        'invoice_date'
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}
