<?php

namespace App\Models;

use Database\Factories\ZipCodeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static ZipCodeFactory factory()
 *
 * @mixin ZipCode
 */
class ZipCode extends Model
{
    use HasFactory;

    public    $timestamps = false;
    protected $guarded    = false;

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class);
    }
}
