<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @method static truncate()
 * @method static Flight create(array $array)
 * @method static paginate($get)
 */
class Flight extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['number', 'departure_time', 'arrival_time', 'price', 'airline_id', 'departure_airport_id', 'arrival_airport_id', 'created_by'];

    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class);
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    public static function boot(): void
    {
        static::creating(function (Flight $flight) {
            /** @var User $user */
            $user = Auth::user();
            if (null !== $user) {
                $flight->created_by = $user->id;
            }
        });

        parent::boot();
    }
}
