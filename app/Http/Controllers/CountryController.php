<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Person;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $perPage = 15;

    public function index() {
        $countries = Country::paginate(50);
        $data = ['title' => 'All countries', 'description' => 'All countries', 'countries' => $countries];
        return view('countries/index', $data);
    }

    public function show($slug) {
       $country = Country::where('slug', '=', $slug)->first();
        if (!$country) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $people = Person::where('country_code', '=', $country->code)->paginate($this->perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! No people.');
        }
        $data = ['title' => 'Celebrities from '.$country->name, 'description' => 'Celebrities by country', 'country' => $country, 'people' => $people];
        return view('countries/details', $data);
    }
}
