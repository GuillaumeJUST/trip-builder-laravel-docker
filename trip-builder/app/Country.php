<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @method static truncate()
 * @method static Country create(array $array)
 * @method static paginate($get)
 */
class Country extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }
}
