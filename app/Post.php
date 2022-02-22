<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = [
        'title',
        'content'
    ];

    public static function generateSlug($title) {
        $slug = Str::slug($title);
        $original_slug = $slug;

        $slug_found = Post::where('slug', '=', $slug)->first();
        $counter = 1;

        while ($slug_found) {
            $slug = $original_slug . '-' . $counter;
            $slug_found = Post::where('slug', '=', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}
