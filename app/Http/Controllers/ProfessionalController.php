<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Person;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    private $perPage = 15;

    public function index() {
        $countries = Professional::paginate(50);
        $data = ['title' => 'All countries', 'description' => 'All countries', 'countries' => $countries];
        return view('countries/index', $data);
    }

    public function show($slug) {
       $professional = Professional::where('slug', '=', $slug)->first();
        if (!$professional) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $people = Person::where('professional_id', '=', $professional->id)->paginate($this->perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! No people.');
        }
        $data = ['title' => $professional->name.'s', 'description' => 'People who are '.$professional->name, 'professional' => $professional, 'people' => $people];
        return view('professional/details', $data);
    }
}
