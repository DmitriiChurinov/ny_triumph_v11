<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model {
    protected $fillable = ['title', 'search_title', 'content', 'user_id'];

    protected static function booted() {
        static::saving(function ($article) {
            $article->search_title = mb_strtolower($article->title, 'UTF-8');
        });
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function comments(): HasMany { return $this->hasMany(Comment::class)->whereNull('parent_id'); }
    public function ratings(): HasMany { return $this->hasMany(Rating::class); }
    public function averageRating() { return round($this->ratings()->avg('value'), 1) ?: 0; }
}
