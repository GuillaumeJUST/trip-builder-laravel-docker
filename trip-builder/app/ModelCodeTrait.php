<?php
/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2019-03-16
 * Time: 15:23
 */

namespace App;


use Illuminate\Database\Eloquent\Builder;

/**
 * @method static findByCode(string $string)
 */
trait ModelCodeTrait
{
    public function scopeFindByCode(Builder $query, string $code)
    {
        return $query->where('code', $code)->first();
    }
}
