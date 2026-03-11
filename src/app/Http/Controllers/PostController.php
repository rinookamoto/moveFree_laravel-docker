<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User; // 追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 追加

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function dashboard(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $posts = $user->posts()->latest()->get();

        return view('dashboard', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        /** @var User $user */
        $user = $request->user();
        $user->posts()->create($validated);

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // auth()->id() の代わりに Auth::id() を使うとエラーが出にくいです
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('dashboard');
    }
}