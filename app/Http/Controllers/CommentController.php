<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Game $game): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);
        $game->comments()->create([
            'body' => $validated['body'],
            'user_id' => $request->user()->id,
        ]);

        return back()->with('status', 'Comment added.');
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $this->authorizeComment($request, $comment);
        $comment->update($request->validate(['body' => ['required', 'string', 'max:2000']]));

        return back()->with('status', 'Comment updated.');
    }

    public function destroy(Request $request, Comment $comment): RedirectResponse
    {
        $this->authorizeComment($request, $comment);
        $comment->delete();

        return back()->with('status', 'Comment deleted.');
    }

    private function authorizeComment(Request $request, Comment $comment): void
    {
        abort_unless($request->user()->is_admin || $request->user()->id === $comment->user_id, 403);
    }
}
