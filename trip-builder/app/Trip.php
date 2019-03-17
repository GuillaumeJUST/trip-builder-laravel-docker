<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $all)
 * @method static paginate($get)
 */
class Trip extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'departure_datetime',
        'departure_airport_id',
        'arrival_airport_id',
        'preferred_airline_id',
        'is_round_trip',
    ];

    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class);
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class);
    }

    public function preferredAirline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }
}
