<?php

use App\Models\Comment;
use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\User;

test('games can be searched by name, developer, or genre and filtered by multiple genres', function () {
    $genre = Genre::create(['name' => 'RPG']);
    $secondGenre = Genre::create(['name' => 'Soulslike']);
    $game = Game::factory()->create(['name' => 'Moon Quest', 'developer_id' => Developer::create(['name' => 'Moon Studio'])->id]);
    $game->genres()->attach([$genre->id, $secondGenre->id]);
    Game::factory()->create(['name' => 'Racing World']);

    $this->get(route('games.index', ['search' => 'Moon']))
        ->assertOk()
        ->assertSee('Moon Quest')
        ->assertDontSee('Racing World');
    $this->get(route('games.index', ['genres' => [$genre->id, $secondGenre->id]]))
        ->assertOk()
        ->assertSee('Moon Quest')
        ->assertDontSee('Racing World');
    $this->get(route('games.index', ['search' => 'Soulslike']))
        ->assertOk()
        ->assertSee('Moon Quest');
});

test('users need three comments before creating a game', function () {
    $user = User::factory()->create();
    $genre = Genre::create(['name' => 'Action']);

    $this->actingAs($user)->post(route('games.store'), [
        'name' => 'Blocked Game',
        'description' => 'Description',
        'developer' => 'Studio',
        'genres' => [$genre->name],
    ])->assertRedirect(route('games.index'));

    $this->actingAs($user)->get(route('games.create'))
        ->assertRedirect(route('games.index'));

    Comment::factory()->count(3)->create(['user_id' => $user->id]);
    $response = $this->actingAs($user)->post(route('games.store'), [
        'name' => 'Allowed Game',
        'description' => 'Description',
        'developer' => 'Studio',
        'genres' => [$genre->name],
    ]);

    $response->assertRedirect();
    expect(Game::where('name', 'Allowed Game')->exists())->toBeTrue();
});

test('dashboard shows favorites and authored comments', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();
    $user->favorites()->attach($game);
    Comment::factory()->create(['user_id' => $user->id, 'game_id' => $game->id]);

    $this->actingAs($user)->get(route('dashboard'))
        ->assertOk()
        ->assertSee($game->name)
        ->assertSee('Jouw reacties');
});

test('admins can remove games owned by another user', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $game = Game::factory()->create();

    $this->actingAs($admin)->delete(route('games.destroy', $game))
        ->assertRedirect(route('games.index'));
    expect(Game::find($game->id))->toBeNull();
});

test('comment authors can edit and delete their comments', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $user->id, 'game_id' => $game->id]);

    $this->actingAs($user)->put(route('comments.update', $comment), ['body' => 'Updated thoughts'])
        ->assertRedirect();
    expect($comment->fresh()->body)->toBe('Updated thoughts');

    $this->actingAs($user)->delete(route('comments.destroy', $comment))
        ->assertRedirect();
    expect(Comment::find($comment->id))->toBeNull();
});

test('game subpages provide a link back to the games index', function () {
    $user = User::factory()->create();
    Comment::factory()->count(3)->create(['user_id' => $user->id]);
    $game = Game::factory()->create(['user_id' => $user->id]);

    $this->get(route('games.show', $game))
        ->assertOk()
        ->assertSee('Back to games');
    $this->actingAs($user)->get(route('games.create'))
        ->assertOk()
        ->assertSee('Back to games');
    $this->actingAs($user)->get(route('games.edit', $game))
        ->assertOk()
        ->assertSee('Back to games');
});
