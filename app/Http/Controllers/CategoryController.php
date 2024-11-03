<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.dashboard')->with('status', 'Categorie aangemaakt!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.dashboard')->with('status', 'Categorie verwijderd!');
    }
}
