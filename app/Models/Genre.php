<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public static function updateOrCreate(array $array)
    {
        return static::firstOrNew(['name' => $array['name']], $array)->save();
    }

    public function games(): BelongsToMany {
        return $this->belongsToMany(Game::class, 'genres_games', 'genre_id', 'game_id');
    }


}
