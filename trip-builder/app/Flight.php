<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static truncate()
 * @method static Flight create(array $array)
 */
class Flight extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['number', 'departure_time', 'arrival_time', 'price'];

    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'id', 'departure_airport_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'id', 'arrival_airport_id');
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }
}
