<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'posts.d' => 'max:255|min:3',
        ]);

        return view('register.create', []);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'bail|required|unique:users,name|max:255|min:3',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255|',
        ]);

        $user = User::create($attributes); // If the validation fails, Laravel will redirect you to the previous page, and this line will never reached
        
        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created');
    }

}