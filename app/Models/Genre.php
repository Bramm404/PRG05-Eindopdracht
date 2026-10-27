<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function games(): BelongsToMany {
        return $this->belongsToMany(Game::class, 'genres_games', 'genre_id', 'game_id');
    }


}
