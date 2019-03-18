<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 *
 *  @OA\Schema(
 *   schema="Airline",
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
 * Class Airline
 * @package App
 *
 * @method static Airline create(array $array)
 * @method static truncate()
 * @method static paginate($get)
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
        return $this->belongsTo(User::class);
    }

    public static function boot(): void
    {
        static::creating(function (Airline $airline) {
            /** @var User $user */
            $user = Auth::user();
            if (null !== $user) {
                $airline->created_by = $user->id;
            }
        });

        parent::boot();
    }
}
