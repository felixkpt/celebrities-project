<?php

namespace App\Http\Controllers\Admin;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /** 
     * Our admin home
     * @return Response
     */
    public function index() {
        
        $users = User::orderBy('id','DESC')->paginate(4);
        $users_all = User::count();
        $page_views = range(50, 1000)[rand(240, 949)];
        $users_this_week = count(User::where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-7 days')))->get());
        $users_news_letter_subscribed = range(100, 1000)[rand(600, 899)];
        $posts = Post::where('post_type', 'post')->count();
        $pages = Post::where('post_type', 'page')->count();
        
        $reviews_this_week = 0;
        $reviews_all = 0;
        
        return view('admin/index', get_defined_vars());
    }
}
