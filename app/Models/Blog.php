<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';

    const CREATED_AT = 'dt_created';
    const UPDATED_AT = 'dt_updated';

    protected $fillable = [
        'title', 'description', 'text', 'category_id', 'user_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(Filter::class,
            'blog_filter', 'blog_id', 'filter_id');
    }
}
