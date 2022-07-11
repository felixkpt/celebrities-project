<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\Controller;
use App\Models\PostContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    protected $post_type = 'page';
    protected $route = 'admin.pages';
    protected $perPage = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'All Pages';
        if ($slug = $request->get('author')) {
            $author = User::where('slug', $slug)->first();
            if (!$author) {
                return redirect()->back()->with('warning', 'Whoops! Author not found.');
            }
            $posts = Post::where('post_type', $this->post_type)->whereHas('author', function($q) use($author) {
                $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $posts->appends(['author' => $slug]);
            $title = 'All Pages by '.$author->name.' ('.$posts->total().')';

        }else {
            $posts = Post::where('post_type', $this->post_type)->with('authors')->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $title = 'All Pages ('.Post::where('post_type', $this->post_type)->count().')';
        }
        
        return view($this->route.'.index', ['posts' => $posts, 'route' => $this->route, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['route' => $this->route.'.index', 'method' => 'post', 'require_editor' => true];
        $data['notification_type'] = 'inline';
        return view($this->route.'.create', $data);
    }

    /** 
     * Store a new blog post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $rules = [
            'title' => 'required|string|min:3|max:150|unique:posts,title',
            'slug' => 'nullable|string|min:3|max:150|unique:posts,slug',
            'content' => 'required|string|min:3|max:2000000',
        ];
        $request->validate($rules);

        $user_id = Auth::user()->id;
        $title = ucfirst(trim($request->post('title')));
        $slug = Str::of($request->post('slug') ?? $title)->slug('-')->value();
        $content = ucfirst($request->get('content'));
        $data = ['title' => $title, 'slug' => $slug, 'description' => Str::limit(strip_tags($content), 150), 'user_id' => $user_id, 'post_type' => $this->post_type];
        
        
        try {
            DB::beginTransaction();
        
            $post = Post::create($data);
        
            PostContent::create(['post_id' => $post->id, 'content' => $content]);
            // Attaching author
            $post->authors()->attach($user_id, ['manager_id' => $user_id]);
            // Snippet for setting homepage post
            if ($request->get('show_in_homepage') == 'on') {
                $option = Option::where('name', 'show_in_homepage')->first();
                if (!$option) {
                    Option::create(['name' => 'show_in_homepage', 'value' => $post->id]);
                }else {
                    Option::where('id', $option->id)->update(['value' => $post->id]);
                }
            }

            DB::commit();
        
        } catch (Throwable $e) {
            DB::rollback();
        }
        
        return redirect()->to($request->post('redirect'))->with('success', ucfirst($this->post_type).' was created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('post_type', $this->post_type)->where('id', $id)->with('content')->first();
        $data = ['route' => $this->route.'.update', 'method' => 'patch', 'post' => $post, 'require_editor' => true];
        $data['notification_type'] = 'inline';
        return view($this->route.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:3|max:150|unique:posts,title,'.$request->id,
            'slug' => 'nullable|string|min:3|max:150|unique:posts,slug,'.$request->id,
            'content' => 'required|string|min:3|max:2000000',
        ];
        $request->validate($rules);
        
        $user_id = Auth::user()->id;
        $title = ucfirst(trim($request->post('title')));
        $slug = Str::of($request->post('slug') ?? $title)->slug('-')->value();
        $content = ucfirst($request->get('content'));
        $data = ['title' => $title, 'slug' => $slug, 'description' => Str::limit(strip_tags($content), 150),];
        $post = Post::where('post_type', $this->post_type)->find($request->id);
        
        try {
            DB::beginTransaction();
        
            $post = Post::where('post_type', $this->post_type)->find($request->id);
            $post->update($data);
            PostContent::where('post_id', $post->id)->update(['content' => $content]);
            // Attaching author
            $authors = json_decode(json_encode($post->mainAuthors), true);
            if (!in_array($user_id, array_column($authors, 'id'))) {
                $post->authors()->attach($user_id, ['manager_id' => $user_id]);
            }
            // Snippet for setting homepage post
            if ($request->get('show_in_homepage') == 'on') {
                $option = Option::where('name', 'show_in_homepage')->first();
                if (!$option) {
                    Option::create(['name' => 'show_in_homepage', 'value' => $post->id]);
                }else {
                    Option::where('id', $option->id)->update(['value' => $post->id]);
                }
            }
            // Unsetting it
            elseif ($option = Option::where('name', 'show_in_homepage')->where('value', $post->id)->first()) {
                Option::where('id', $option->id)->delete();
            }
    
            DB::commit();
        
        } catch (Throwable $e) {
            DB::rollback();
        }

        return redirect()->to($request->post('redirect'))->with('success', ucfirst($this->post_type).' was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Post::where('post_type', $this->post_type)->find($request->get('id'))->delete();
        return redirect()->back()->with('danger', ucfirst($this->post_type).' deleted.');
    }
}
