<?php

namespace App\Models;

use Database\Factories\SettlementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static SettlementFactory factory()
 *
 * @mixin Settlement
 */
class Settlement extends Model
{
    use HasFactory;

    public    $timestamps = false;
    protected $guarded    = false;

    public function zipCode(): BelongsTo
    {
        return $this->belongsTo(ZipCode::class);
    }
}
