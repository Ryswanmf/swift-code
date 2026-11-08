<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'content',
        'author',
        'read_time',
        'image',
        'is_published',
        'published_at',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if (empty($article->published_at)) {
                $article->published_at = now();
            }
            if (empty($article->read_time)) {
                $words = str_word_count(strip_tags($article->content));
                $minutes = max(1, (int) ceil($words / 180));
                $article->read_time = "{$minutes} menit baca";
            }
        });
    }

    /**
     * Scope for published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('published_at', '<=', now());
    }
}
