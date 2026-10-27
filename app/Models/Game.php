<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    protected $fillable = ['name', 'description', 'image', 'developer_id', 'user_id'];

    public function genres(): BelongsToMany {
        return $this->belongsToMany(Genre::class, 'genres_games', 'game_id', 'genre_id');
    }
}
