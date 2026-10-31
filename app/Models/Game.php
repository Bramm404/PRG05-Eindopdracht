<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'developer_id', 'user_id'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genres_games', 'game_id', 'genre_id');
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function imageUrl(): ?string
    {
        return $this->image && ! str_starts_with($this->image, 'http')
            ? asset('storage/'.$this->image)
            : $this->image;
    }
}
