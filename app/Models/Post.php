<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'url', 'thumbnail', 'author', 'description', 'published_at',
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
