<?php

namespace App\Http\Controllers;

use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        return view('admin.dashboard', compact('categories'));
    }
}
