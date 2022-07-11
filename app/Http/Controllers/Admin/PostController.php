<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PostContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $post_type = 'post';
    protected $route = 'admin.posts';
    protected $perPage = 20;
    protected $max_words = 150;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'All Posts';

        if ($slug = $request->get('author')) {
            $author = User::where('slug', $slug)->first();
            if (!$author) {
                return redirect()->back()->with('warning', 'Whoops! Author not found.');
            }
            $posts = Post::where('post_type', $this->post_type)->whereHas('author', function ($q) use ($author) {
                $q->where([['post_user.user_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $posts->appends(['author' => $slug]);
            $title = 'All Posts by ' . $author->name . ' (' . $posts->total() . ')';
        } elseif ($slug = $request->get('category')) {
            $category = Category::where('slug', $slug)->first();
            if (!$category) {
                return redirect()->back()->with('warning', 'Whoops! Category not found.');
            }
            $posts = Post::where('post_type', $this->post_type)->whereHas('category', function ($q) use ($category) {
                $q->where([['post_category.category_id', $category->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $posts->appends(['category' => $slug]);
            $title = 'All Posts in the category ' . $category->name . ' (' . $posts->total() . ')';
        } else {
            $posts = Post::where('post_type', $this->post_type)->with('authors')->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $title = 'All Posts (' . Post::where('post_type', $this->post_type)->count() . ')';
        }

        $data = ['posts' => $posts, 'route' => $this->route, 'title' => $title];
        return view($this->route . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['route' => $this->route . '.index', 'method' => 'post', 'require_editor' => true];
        $data['notification_type'] = 'inline';
        return view($this->route . '.create', $data);
    }

    /** 
     * Store a new blog post
     * @param \Illuminate\Http\Requests\StorePostReqoest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string|min:3|max:150|unique:posts,title',
            'slug' => 'nullable|string|min:3|max:150|unique:posts,slug',
            'description' => [
                'nullable', 'string',
                'min:100', 'max:160'
            ],
            'content' => 'required|string|min:3|max:2000000',
        ];

        $request->validate($rules);

        $user_id = Auth::user()->id;
        $title = ucfirst(trim($request->post('title')));
        $slug = Str::of($request->post('slug') ?? $title)->slug('-')->value();
        $content = ucfirst($request->get('content'));
        $description =  ucfirst($request->get('description')) ?: Str::limit(strip_tags($content), 150);
        $data = ['title' => $title, 'slug' => $slug, 'description' => $description, 'user_id' => $user_id, 'post_type' => $this->post_type];
        if ($image_url = $request->get('image_url')) {
            $data['image'] = $image_url;
        }

        try {
            DB::beginTransaction();

            $post = Post::create($data);

            PostContent::create(['post_id' => $post->id, 'content' => $content]);
            // Attaching author
            $post->authors()->attach($user_id, ['manager_id' => $user_id]);
            // Attaching categories
            if ($request->get('categories')) {
                foreach ($request->get('categories') as $category) {
                    $post->categories()->attach($category);
                }
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            var_dump($e->getMessage());
        }

        return redirect()->to($request->post('redirect'))->with('success', ucfirst($this->post_type) . ' was created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('post_type', $this->post_type)->where('id', $id)->first();
        $data = ['route' => $this->route . '.update', 'method' => 'patch', 'post' => $post, 'require_editor' => true];
        $data['notification_type'] = 'inline';
        return view($this->route . '.edit', $data);
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

        $user_id = Auth::user()->id;
        $rules = [
            'title' => 'required|string|min:3|max:150|unique:posts,title,' . $request->id,
            'slug' => 'nullable|string|min:3|max:150|unique:posts,slug,' . $request->id,
            'description' => [
                'nullable', 'string',
                'min:100', 'max:160'
            ],
            'content' => 'required|string|min:3|max:2000000',
        ];

        $request->validate($rules);

        $title = ucfirst(trim($request->post('title')));
        $slug = Str::of($request->post('slug') ?? $title)->slug('-')->value();
        $content = ucfirst($request->get('content'));
        $description =  ucfirst($request->get('description')) ?: Str::limit(strip_tags($content), 150);
        $data = ['title' => $title, 'slug' => $slug, 'description' => $description];
        if ($image_url = $request->get('image_url')) {
            $data['image'] = $image_url;
        }

        try {
            DB::beginTransaction();

            $post = Post::where('post_type', $this->post_type)->find($request->id);
            $post->update($data);
            PostContent::where('post_id', $post->id)->update(['content' => $content]);
            // Attaching author
            $authors = $post->mainAuthors->toArray();
            if (!in_array($user_id, array_column($authors, 'id'))) {
                $post->authors()->attach($user_id, ['manager_id' => $user_id]);
            }
            // Attaching categories
            if ($request->get('categories')) {
                $categories = $post->categories->toArray();
                foreach ($request->get('categories') as $category) {
                    if (!in_array($category, array_column($categories, 'id'))) {
                        $post->categories()->attach($category);
                    }
                }
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
        }

        return redirect()->to($request->post('redirect'))->with('success', ucfirst($this->post_type) . ' was updated.');
    }

    public function approve(Request $request)
    {
        Post::where('post_type', $this->post_type)->find($request->get('id'))->update(['published' => 'published']);
        return redirect()->back()->with('success', ucfirst($this->post_type) . ' approved.');
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
        return redirect()->back()->with('danger', ucfirst($this->post_type) . ' deleted.');
    }
}
