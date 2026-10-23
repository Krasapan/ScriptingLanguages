<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BetaTester extends Model
{
    protected $table = 'beta_testers';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'age',
        'platform',
        'experience',
    ];
}
