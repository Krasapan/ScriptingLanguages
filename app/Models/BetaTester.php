<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BetaTester extends Model
{
    protected $table = 'beta_testers';
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'age', 'platform', 'experience',
    ];

    // Додаємо константу для зручного керування мовами
    public const AVAILABLE_LOCALES = [
        'uk' => 'Українська',
        'en' => 'English',
        'fr' => 'Français',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(BetaTesterTranslation::class, 'beta_tester_id');
    }

    public function getTranslatedExperience(string $lang = 'uk'): string
    {
        $translation = $this->translations->where('locale', $lang)->first();
        return $translation ? $translation->experience : ($this->experience ?? '');
    }
}
