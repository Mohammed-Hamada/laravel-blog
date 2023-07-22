<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request, Post $post)
    {

        $validated = $request->validate([
            'body' => 'required|min:3'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $validated["body"]
        ]);

        return back();
    }
}