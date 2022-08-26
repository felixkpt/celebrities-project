<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\MBTI;
use Illuminate\Http\Request;

class MBTIController extends Controller{
    
    public function index() {
        $personalities = MBTI::all();
        $data = ['title' => 'Typologies', 'description' => 'Typologies', 'personalities' => $personalities];
        return view('mbti/index', $data);
    }

    public function details(Request $request, String $slug) {
        $personality = strtoupper($slug);
        $personality = MBTI::where('name', '=', $slug)->first();
        if (!$personality) {
            abort(404);
        }

        $people = Person::where('published', 'published')->where('typology', '=', $slug)->limit(20)->inRandomOrder()->get();
        $title = 'All about '. $personality->name.', The '.$personality->strength;
        $description = $title;

        $data = ['title' => $title, 'description' => $description, 'personality' => $personality, 'people' => $people];
        return view('mbti/details', $data);
    }
}
