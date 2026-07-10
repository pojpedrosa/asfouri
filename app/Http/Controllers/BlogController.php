<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->paginate(9);

        return view('pages.blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Only published, non-future posts are publicly visible.
        abort_unless(
            $post->is_published && $post->published_at !== null && $post->published_at->lte(now()),
            404
        );

        $more = Post::published()->where('id', '!=', $post->id)->limit(3)->get();

        return view('pages.blog.show', compact('post', 'more'));
    }
}
