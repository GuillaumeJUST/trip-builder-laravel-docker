<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *  @OA\Schema(
 *   schema="City",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           required={"code"},
 *           @OA\Property(property="code"),
 *           @OA\Property(property="name"),
 *           @OA\Property(property="region_id")
 *       )
 *   }
 * )
 *
 * @method static City create(array $array)
 * @method static truncate()
 * @method static paginate($get)
 */
class City extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'region_id'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function airports(): HasMany
    {
        return $this->hasMany(Airline::class);
    }


}
