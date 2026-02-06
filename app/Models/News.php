<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'user_id',
        'is_published',
        'published_at',
        'views',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
