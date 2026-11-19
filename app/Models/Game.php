<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'game_id';
    public $timestamps = false;
    protected $fillable = ['title', 'genre'];

    public function betaTesters(): BelongsToMany
    {
        return $this->belongsToMany(BetaTester::class,
            'beta_tester_game', 'game_id', 'beta_tester_id');
    }
}
