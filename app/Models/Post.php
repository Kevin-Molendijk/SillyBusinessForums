<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'title',    // Voeg title hier toe
        'content',  // Voeg ook andere velden toe die ingevuld moeten kunnen worden
        'user_id',  // Bijv. ID van de auteur van de post
    ];
}
