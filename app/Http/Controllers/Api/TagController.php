<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{   
    // Per contare i related posts nella index
    // $tag->number_of_related_posts = $tag->posts->count();

    public function show($slug) {
        $tag = Tag::where('slug', '=', $slug)->with('posts')->first();

        

        if ($tag) {
            return response()->json([
                'success' => true,
                'results' => $tag
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => []
            ]);
        }
    }
}
