<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Typology;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class TypologyController extends Controller{
    
    public function index() {
        $personalities = Typology::all();
        $data = ['title' => 'Typologies', 'description' => 'Typologies', 'personalities' => $personalities];
        return view('typologies/index', $data);
    }

    public function details(Request $request, String $slug) {
        $personality = strtoupper($slug);
        $personality = Typology::where('name', '=', $slug)->first();
        if (!$personality) {
            abort(404);
        }

        $people = Person::where('typology', '=', $slug)->limit(20)->inRandomOrder()->get();
        $title = 'All about '. $personality->name.', The '.$personality->strength;
        $description = $title;

        $data = ['title' => $title, 'description' => $description, 'personality' => $personality, 'people' => $people];
        return view('typologies/details', $data);
    }
}
