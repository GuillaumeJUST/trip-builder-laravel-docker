<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Airport
 * @package App
 * @method static truncate()
 * @method static Airport create(array $array)
 */
class Airport extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'longitude', 'latitude', 'timezone'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function departureFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'departure_airport_id');
    }

    public function arrivalFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'arrival_airport_id');
    }
}
