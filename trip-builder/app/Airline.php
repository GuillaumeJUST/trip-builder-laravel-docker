<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Airline
 * @package App
 *
 * @method static Airline create(array $array)
 * @method static truncate()
 */
class Airline extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'created_by'];

    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class, 'airline_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }
}
