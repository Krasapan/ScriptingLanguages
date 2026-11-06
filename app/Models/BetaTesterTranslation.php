<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BetaTesterTranslation extends Model
{
    protected $fillable = ['beta_tester_id', 'locale', 'experience'];

    public function betaTester(): BelongsTo
    {
        return $this->belongsTo(BetaTester::class, 'beta_tester_id');
    }
}
