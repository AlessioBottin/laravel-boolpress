<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::paginate(12);

        return response()->json([
            'success' => true,
            'posts' => $posts
        ]);
    }

    public function show($slug) {
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'posts' => $post
            ]);
        } else {
            return response()->json([
                'success' => false,
                'posts' => []
            ]);
        }
    }
}
