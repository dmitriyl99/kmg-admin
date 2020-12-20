<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App\Models
 *
 * @property string $url
 * @property string $filename
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'filename'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
