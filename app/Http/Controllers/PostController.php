<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            'posts' => Post::latest()->filter(request(['category', 'search', 'user']))->get(),
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $attributes = array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        Post::create($attributes);

        return redirect('/posts/' . $attributes['slug']);
    }
    public function update(Post $post)
    {
        $attributes = $this->validatePost();

        if (isset($attributes['thumbnails'])) {
            $attributes['thumbnails'] = request()->file('thumbnail')->store('thumbnails');
        }

        $updatedPost = $post->update($attributes);

        return response()->json($updatedPost);
    }

    public function destroy(Post $post)
    {
        $deletedPost = $post->delete();

        return response()->json($deletedPost);
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}