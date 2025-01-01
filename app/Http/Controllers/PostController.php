<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{
    public function index(Request $request)
    {
        // Begin met het ophalen van alle zichtbare posts met bijbehorende categorie
        $query = Post::with('user', 'category')->latest();

        // Alleen niet-verborgen posts ophalen, behalve voor admins of de eigenaar
        $query->where(function ($query) {
            $query->where('hidden', false)
                ->orWhere('user_id', auth()->id());
        });

        // Filter op categorie
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Zoekfunctie
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Voer de query uit
        $posts = $query->get();

        // Haal alle categorieën op voor de dropdown
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

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


    public function toggleHidden(Request $request, Post $post)
    {
        // Zorg ervoor dat alleen de eigenaar de status kan wijzigen
        if ($request->user()->id !== $post->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Toggle de hidden status
        $post->hidden = !$post->hidden;
        $post->save();

        return response()->json(['hidden' => $post->hidden]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        // Haal alleen de posts van de ingelogde gebruiker op, inclusief verborgen posts
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('profile', compact('posts'));
    }

}
