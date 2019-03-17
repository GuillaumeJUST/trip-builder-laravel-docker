<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class Airport
 * @package App
 * @method static truncate()
 * @method static Airport create(array $array)
 * @method static paginate($get)
 */
class Airport extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'longitude', 'latitude', 'timezone', 'city_id'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function departureFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'departure_airport_id');
    }

    public function arrivalFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'arrival_airport_id');
    }

    public static function boot(): void
    {
        static::creating(function (Airport $airport) {
            /** @var User $user */
            $user = Auth::user();
            if (null !== $user) {
                $airport->created_by = $user->id;
            }
        });

        parent::boot();
    }
}
