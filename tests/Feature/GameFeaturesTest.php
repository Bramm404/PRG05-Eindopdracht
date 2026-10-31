<?php

use App\Models\Comment;
use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\User;

test('games can be searched by name and developer and filtered by genre', function () {
    $genre = Genre::create(['name' => 'RPG']);
    $game = Game::factory()->create(['name' => 'Moon Quest', 'developer_id' => Developer::create(['name' => 'Moon Studio'])->id]);
    $game->genres()->attach($genre);
    Game::factory()->create(['name' => 'Racing World']);

    $this->get(route('games.index', ['search' => 'Moon']))
        ->assertOk()
        ->assertSee('Moon Quest')
        ->assertDontSee('Racing World');
    $this->get(route('games.index', ['genre' => $genre->id]))
        ->assertOk()
        ->assertSee('Moon Quest')
        ->assertDontSee('Racing World');
});

test('users need three comments before creating a game', function () {
    $user = User::factory()->create();
    $genre = Genre::create(['name' => 'Action']);

    $this->actingAs($user)->post(route('games.store'), [
        'name' => 'Blocked Game',
        'description' => 'Description',
        'developer' => 'Studio',
        'genres' => [$genre->name],
    ])->assertForbidden();

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
        ->assertSee('Your comments');
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
