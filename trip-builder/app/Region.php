<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static truncate()
 * @method static Region create(array $array)
 */
class Region extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
