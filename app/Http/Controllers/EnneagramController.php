<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Enneagram;
use Illuminate\Http\Request;

class EnneagramController extends Controller{
    
    public function index() {
        $personalities = Enneagram::all();
        $data = ['title' => 'Enneagrams', 'description' => 'Enneagrams', 'personalities' => $personalities];
        return view('enneagrams/index', $data);
    }

    public function details(Request $request, String $slug) {
        $enneagram = Enneagram::where('slug', '=', $slug)->first();
        if (!$enneagram) {
            abort(404);
        }

        $people = Person::where('enneagram', '=', $enneagram->name)->limit(20)->inRandomOrder()->get();
        $title = 'All about '. $enneagram->name.', '.$enneagram->strength;
        $description = $title;

        $data = ['title' => $title, 'description' => $description, 'enneagram' => $enneagram, 'people' => $people];
        return view('enneagrams/details', $data);
    }
}
