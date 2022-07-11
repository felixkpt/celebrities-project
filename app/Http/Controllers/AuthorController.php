<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $perPage = 15;
    public function index() {
        $authors = User::with('posts')->limit(213)->paginate(5) ;
        // dd($authors);
        $data = ['title' => 'Post Authors', 'description' => 'Post Authors', 'authors' => $authors];
        return view('authors/index', $data);   
    }
    public function show($slug) {
        $author = User::where('slug', $slug)->first();
        if (!$author) {
            return redirect()->back()->with('warning', 'Whoops! Author not found.');
        }
        $posts = Post::where('post_type', 'post')->whereHas('author', function($q) use($author) {
            $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
        })->orderBy('updated_at', 'desc')->paginate($this->perPage);
        
        $data = ['title' => 'Posts by Author', 'description' => 'Posts by Author', 'author' => $author, 'posts' => $posts];
        return view('authors/show', $data);   
    }

    /**
     * Showing all posts where a given user is manager
     */
    public function lead($slug) {
        $author = User::where('slug', $slug)->first();
        if (!$author) {
            return redirect()->back()->with('warning', 'Whoops! Author not found.');
        }
        $posts = Post::where('post_type', 'post')->whereHas('author', function($q) use($author) {
            $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
        })->orderBy('updated_at', 'desc')->paginate($this->perPage);

        $data = ['title' => 'Post lead by Author', 'description' => 'Post lead by Author', 'author' => $author, 'posts' => $posts];
        return view('authors/managers', $data);   
    }
    
}
