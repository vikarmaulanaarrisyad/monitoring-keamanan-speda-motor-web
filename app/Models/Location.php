<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;
    protected $table = 'gps';

    // /**
    //  * Get the vehicle that owns the location.
    //  */
    // public function vehicle(): BelongsTo
    // {
    //     return $this->belongsTo(Vehicle::class);
    // }
}
