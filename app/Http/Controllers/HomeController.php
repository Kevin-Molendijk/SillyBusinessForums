<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); // Haal alle posts op, gesorteerd op nieuwste eerst
        return view('home', compact('posts'));
    }
}
