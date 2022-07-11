<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $perPage = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ititle = 'All reviews';
        if ($slug = $request->get('author')) {
            $author = User::where('slug', $slug)->first();
            if (!$author) {
                return redirect()->back()->with('warning', 'Whoops! Author not found.');
            }
            $reviews = Review::where('user_id', $author->id)->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $reviews->appends(['author' => $author->slug]);
            $title = 'Reviews by '.$author->name.' ('.$reviews->total().')';

        } elseif($slug = $request->get('post')) {
            $post = Post::where('slug', $slug)->first();
            if (!$post) {
                return redirect()->back()->with('warning', 'Whoops! Post not found.');
            }
            $reviews = Review::where('post_id', $post->id)->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $reviews->appends(['post' => $post->slug]);
            $title = 'Reviews for '.$post->company_name.' ('.$reviews->total().')';

        } else {
            $reviews = Review::orderBy('updated_at', 'desc')->paginate($this->perPage);
            $title = 'All reviews ('.Review::count().')';
        }
        return view('admin/reviews/index', ['reviews' => $reviews, 'title' => $title]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('admin/reviews/show', ['review' => $review]);
    }

    public function approve(Request $request) {
        Review::findOrFail($request->get('id'))->update(['published' => 'published']);
        return redirect()->back()->with('success', 'Review approved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Review::findOrFail($request->get('id'))->delete();
        if ($redirect = $request->get('redirect')) {
            return \redirect()->to($redirect)->with('success', 'Review deleted.');
        }
        return \redirect()->back()->with('success', 'Review deleted.');
    }
}
