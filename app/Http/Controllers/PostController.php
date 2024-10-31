<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
// app/Http/Controllers/PostController.php
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); // Ophalen van berichten met gebruikersinfo
        return view('posts.index', compact('posts')); // Doorsturen naar de index-view
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Valideer de input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string', // Zorg ervoor dat 'content' vereist is
        ]);

        // Maak de post aan
        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post successfully created!');
    }

}
