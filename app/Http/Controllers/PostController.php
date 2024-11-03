<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); // Ophalen van berichten met gebruikersinfo
        return view('posts.index', compact('posts')); // Doorsturen naar de index-view
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // PostController.php
    public function store(Request $request)
    {
        // Valideer de input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Maak de post aan
        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],  // Gebruik gevalideerde data voor category_id
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post successfully created!');
    }


    public function edit(Post $post)
    {
        // Zorg ervoor dat de gebruiker alleen zijn eigen posts kan bewerken
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // Validatie van de ingevoerde data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Update de post met nieuwe gegevens
        $post->update($validatedData);

        // Redirect terug naar de post index of detailpagina
        return redirect()->route('posts.index')->with('success', 'Post bijgewerkt!');
    }

    public function destroy(Post $post)
    {;
        $post->delete();

        return redirect()->route('posts.index')->with('status', 'Post succesvol verwijderd!');
    }

    public function show(Post $post)
    {
        // Haal de comments op die bij deze post horen
        $comments = $post->comments()->with('user')->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Zoeken op posts op titel
        $posts = Post::where('title', 'like', '%' . $query . '%')->get();

        // Geef de resultaten door aan de zoekresultatenpagina
        return view('posts.search-results', compact('posts', 'query'));
    }

    public function filterByCategory($categoryId)
    {
        // Haal de categorie op
        $category = Category::findOrFail($categoryId);

        // Haal alle posts binnen deze categorie op
        $posts = Post::where('category_id', $categoryId)->latest()->get();

        // Stuur de gegevens naar de view, inclusief de categorie om de naam te tonen
        return view('posts.index', compact('posts', 'category'));
    }

}
