<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *  @OA\Schema(
 *   schema="Region",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           required={"code"},
 *           @OA\Property(property="code"),
 *           @OA\Property(property="name"),
 *           @OA\Property(property="country_id")
 *       )
 *   }
 * )
 *
 * @method static truncate()
 * @method static Region create(array $array)
 * @method static paginate($get)
 */
class Region extends Model
{
    use ModelCodeTrait;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'country_id'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
