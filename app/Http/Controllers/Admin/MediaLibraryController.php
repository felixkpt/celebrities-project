<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MediaLibraryController extends Controller
{
    /**
     * @param string $image_rules
     * 
     */
    private $image_rules = 'mimes:jpg,png,jpeg,gif,svg,webp';

    private $route = 'admin.media';
    private $perPage = 30;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'All Media';
        if ($slug = $request->get('author')) {
            $author = User::where('slug', $slug)->first();
            if (!$author) {
                return redirect()->back()->with('warning', 'Whoops! Author not found.');
            }
            $media = MediaLibrary::where('user_id', $author->id)->with('author')->orderby('created_at', 'DESC')->paginate($this->perPage);
            $media->appends(['author' => $author->slug]);
            $title = 'Media uploaded by '.$author->name.' ('.$media->total().')';
        }else {
            $media = MediaLibrary::latest()->with('author')->paginate($this->perPage);
            $title = 'All Media ('.$media->total().')';
        }

        $data = ['media' => $media, 'title' => $title, 'url' => $request->fullUrl()];
        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view($this->route.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->route.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        if ($request->hasFile('file')) {
            $rules = array_merge($rules, ['image' => $this->image_rules]);
            $request->validate($rules);
            
            $file = $request->file('file');
            
            $dir = 'public/'.date('Y').'/'.date('m');
            
            $path = $file->store($dir);
            chmod(storage_path('app/public/'.date('Y')),0775);
            chmod(storage_path('app/public/'.date('Y').'/'.date('m')),0775);
            $path = preg_replace('#public/#', 'uploads/', $path);
            
            $url = asset($path);
            
            // Getting image dimensions
            $imagesize = getimagesize($url);
            $width = 0;
            $height = 0;
            if ($imagesize) {
                $width = $imagesize[0];
                $height = $imagesize[1];
            }
            // Getting image size
            $image = get_headers($url, 1);
            $bytes = $image["Content-Length"] ?? $image["content-length"];
            $kb = round($bytes/(1024));
            $mb = round($bytes/(1024 * 1024));
            $size = $kb.' KB';
            if ($mb >= 1) {
                $size = $mb.' MB';
            }
            
            $type = $file->getType();
            $mime = $file->getMimeType();
            $data = ['user_id' => Auth::user()->id, 'url' => $url, 'type' => $type, 'mime' => $mime, 'size' => $size, 'width' => $width, 'height' => $height];

            $media = MediaLibrary::create($data);
            if ($media) {
                $media = MediaLibrary::where('id', $media->id)->with('author')->first();
                return response()->json($media);
            }
            return response()->json(['error' => 'Server Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = MediaLibrary::findOrFail($id);
        return view($this->route.'.show', ['media' => $media]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $redirect = $request->redirect ?? url('admin/media');
        
        $media = MediaLibrary::findOrFail($request->id);
        $existing_path = preg_replace("#".asset('uploads')."#", "public", $media->first()->url);
        Storage::delete($existing_path);
        $media->delete();
        return redirect($redirect)->with('success', 'File was deleted.');
    }
}