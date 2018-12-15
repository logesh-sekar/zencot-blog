<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostsRequest;
use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request): View
    {
        return view('posts.index', [
            'posts' => Post::search($request->input('q'))
                             ->with('author')
                             ->withCount('comments')
                             ->latest()
                             ->paginate(20)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post): View
    {
        $post->comments_count = $post->comments()->count();
        return view('posts.show', [
            'post' => $post
        ]);
    }

     /**
     * Display the specified resource edit form.
     */
    public function edit(Post $post): View
    {
        return view('posts.edit', [
            'post' => $post,
            'users' => User::authors()->where('id', auth()->user()->id)->pluck('name', 'id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('posts.create', [
            'users' => User::authors()->where('id', auth()->user()->id)->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostsRequest $request): RedirectResponse
    {
        $post = Post::create($request->only(['title', 'content', 'posted_at', 'author_id', 'slug']));

        return redirect()->route('posts.edit', $post)->withSuccess(__('posts.created'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostsRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->only(['title', 'content', 'posted_at', 'author_id']));

        return redirect()->route('posts.edit', $post)->withSuccess(__('posts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post  $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->withSuccess(__('posts.deleted'));
    }
}
