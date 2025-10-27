<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'image_path',
        'user_id', // Make sure this is included
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}