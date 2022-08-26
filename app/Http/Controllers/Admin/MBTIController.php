<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\MBTI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MBTIController extends Controller
{
    protected $route = 'admin.mbti';
    /**
     * @param string $image_rules
     */
    private $image_rules = 'image|min:5|max:1024|mimes:jpg,png,jpeg,gif,webp|dimensions:min_width=150,min_height=150,max_width=1200,max_height=1200';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $personalities = MBTI::all();    
        return view('admin/mbti/index', ['personalities' => $personalities]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( count(MBTI::all()) > 16 ) {
            return redirect()->route($this->route.'.index')->with('waring', 'The maximum number of 16 typologies already saved.');
        }
        return view('admin/mbti/create', ['route' => preg_replace('#\.#', '/', $this->route), 'method' => 'post']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
       
        $rules = [
            'name' => 'required|string|min:4|max:4,unique:typologies,name',
            'strength' => 'required|min:3|max:20,unique:typologies,strength',
            'description' => 'required|min:10|max:2000',
            'prevalence' => 'required|integer|min:1|max:20',
            'image' => $this->image_rules,
                ];
        $request->validate($rules);

        $slug = Str::slug($request->get('name'));
        $values = [
            'name' => strtoupper($request->post('name')),
            'slug' => $slug,
            'strength' => $request->post('strength'),
            'description' => $request->post('description'),
            'prevalence' => $request->post('prevalence'),
        ];
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/typologies');
            $path = preg_replace('#public/#', 'uploads/', $path);
            $values = array_merge($values, ['featured_image' => $path]);
        }
        
        MBTI::create($values);    
        return redirect()->route($this->route.'.index')->with('success', 'Typology was created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $personality = MBTI::find($id);
        return view('admin/mbti/edit', ['personality' => $personality, 'route' => preg_replace('#\.#', '/', $this->route).'/'.$personality->id, 'method' => 'patch']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        
        $id = $request->get('id');
        $rules = [
            'name' => 'required|string|min:4|max:4,unique:typologies,name'.$id,
            'strength' => 'required|min:3|max:20,unique:typologies,strength'.$id,
            'description' => 'required|min:10|max:2000',
            'prevalence' => 'required|integer|min:1|max:20',
                ];
        if ($request->hasFile('image')) {
            $rules = array_merge($rules, ['image' => $this->image_rules]);
        }

        $request->validate($rules);

        $slug = Str::slug($request->get('name'));
        $values = [
            'name' => strtoupper($request->post('name')),
            'slug' => $slug,
            'strength' => $request->post('strength'),
            'description' => $request->post('description'),
            'prevalence' => $request->post('prevalence'),
        ];
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/typologies');
            $path = preg_replace('#public/#', 'uploads/', $path);
            $values = array_merge($values, ['featured_image' => $path]);
          }
      
        MBTI::where('id', '=', $id)->update($values);    
        return redirect()->route($this->route.'.index')->with('success', 'Typology was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        MBTI::find($request->get('id'))->delete();    
        return redirect()->back()->with('danger', 'Typology was daleted');
    }
}
