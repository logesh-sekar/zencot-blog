<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use App\Models\Post;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Show the application comments index.
     */
    public function index(): View
    {
        return view('comments.index', [
            'comments' => Comment::with('post', 'author')->latest()->paginate(50)
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit(Comment $comment): View
    {
        return view('comments.edit', [
            'comment' => $comment,
            'users' => User::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentsRequest $request): RedirectResponse
    {
        Comment::create($request->only(['comment', 'posted_at', 'author_id', 'post_id']));
        $post =  User::authors();
        return redirect()->route('posts.show', $post)->withSuccess(__('comments.created'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentsRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->validated());

        return redirect()->route('comments.edit', $comment)->withSuccess(__('comments.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('comments.index')->withSuccess(__('comments.deleted'));
    }
}
