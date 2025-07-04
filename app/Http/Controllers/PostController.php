<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Post/Index', [
            'posts' => Post::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(Request $request)
    {
        Post::create($request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]));

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
