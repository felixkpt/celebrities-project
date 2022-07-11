<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $perPage =20;
    /**
     * Showing all posts
     */
    public function index() {
        $perPage = $this->perPage;
        $posts = Post::where('post_type', 'post')->orderby('updated_at', 'desc')->with('authors')->paginate($perPage);
        // dd($posts[0]->authors[0]->pivot->created_at);
        if (!$posts) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $title = 'All posts';
        $description = 'All posts';
        $data = ['title' => $title, 'description' => $description, 'posts' => $posts];
        return view('posts/index', $data);
    }
    /**
     * Showing all posts with their managers only
     */
    public function managers() {
        $perPage = $this->perPage;
        $posts = Post::where('post_type', 'post')->orderby('updated_at', 'desc')->with('managers')->paginate($perPage);

        if (!$posts) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $title = 'All posts';
        $description = 'Post managers';
        $data = ['title' => $title, 'description' => $description, 'posts' => $posts];
        return view('posts/managers', $data);
    }

    /**
     * Showing specified posts
     */
    public function show($slug) {
        $post = Post::where('post_type', 'post')->where('slug', '=', $slug)->with('authors')->first();
        if (!$post) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $title = $post->title;
        $description = $post->description;
        $data = ['title' => $title, 'description' => $description, 'post' => $post];
        return view('posts/show', $data);
    }

}
