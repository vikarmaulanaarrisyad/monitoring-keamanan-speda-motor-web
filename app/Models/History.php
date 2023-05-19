<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;
    protected $table = 'histories';

    /**
     * Get the location that owns the location.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
