<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 *
 *  @OA\Schema(
 *   schema="Country",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           required={"code"},
 *           @OA\Property(property="code"),
 *           @OA\Property(property="name")
 *       )
 *   }
 * )
 *
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
