<?php

namespace App\Http\Controllers;

use App\Models\TypologyVotes;
use Illuminate\Support\Facades\Auth;
use App\Models\Typology;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    private $perPage =20;
    /**
     * Showing all people
     */
    public function index() {
        $perPage = $this->perPage;
        $people = Person::orderby('updated_at', 'desc')->paginate($perPage);
        $data = ['title' => 'Famous celebrities', 'description' => 'All Famous celebrities', 'people' => $people];
        return view('people/typologies/index', $data);
    }

    /**
     * Showing specified people
     */
    public function show($slug) {
        $perPage = $this->perPage;  
        $typology = rtrim($slug, 's');
        $people = Person::where('typology', '=', $typology)->orderby('updated_at', 'desc')->paginate($perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        
        $data = ['title' => 'Details about '.$slug, 'description' => 'Details about '.$slug, 'people' => $people];
        return view('people/typologies/index', $data);
        
    }


    /**
     * Showing people by typologies
     */
    public function typologies() {
        $people = Person::all();
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
    }

    /**
     * Showing specified typology type people
     */
    public function typology($slug) {
        $perPage = $this->perPage;
        $typology = rtrim($slug, 's');
        $personality = strtoupper($typology);
        $personality = Typology::where('name', '=', $personality)->first();
        if (!$personality) {
            abort(404);
        }

        $people = Person::where('typology', '=', $typology)->orderby('updated_at', 'desc')->paginate($perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $data = ['title' => 'Famous celebrities', 'description' => 'All Famous celebrities', 'people' => $people, 'personality' => $personality];
        return view('people/typologies/details', $data);
        
    }
    /**
     * Showing a single person
     */
    public function person($id, $slug) {
        $this->updateTypology($id);
        $person = Person::where([['id', '=', $id,], ['slug', '=', $slug]])->with('personality')->first();
        $vote = null;
        if (!$person) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }elseif (Auth::user()) {
            $vote = TypologyVotes::where([['user_id', '=', Auth::user()->id], ['person_id', '=', $person->id]])->first();    
        }
                
        $data = ['title' => $person->name, 'description' => $person->name, 'person' => $person, 'vote' => $vote];
        return view('people/person', $data);
        
    }
    /** 
    * Vote MBTI
     */
     public function vote(Request $request) {
         $person_id = $request->get('id');
         $user_id = Auth::user()->id;
         $vote = $request->get('vote');
         if ($vote !== 'empty') {
             $arr = ['person_id' => $person_id, 'user_id' => $user_id, 'vote' => $vote]; 
             $exists = TypologyVotes::where([['user_id', '=', $user_id], ['person_id', '=', $person_id]])->first();
             if (!$exists) {
                TypologyVotes::create($arr);
                return redirect()->back()->with('success', 'Successfully voted MBTI for this person.');
                
            }else{
                TypologyVotes::where('id', $exists->id)->update($arr);
                return redirect()->back()->with('success', 'Successfully updated MBTI vote for this person.');
            }
        }else{
            return redirect()->back()->with('danger', 'Invalid MBTI vote seletion.');
        }
    }
    public function updateTypology($id) {
        $choosen_typology = TypologyVotes::select('vote')->groupBy('vote')
        ->orderByRaw('count(*) desc')
        ->where('person_id', $id)->first();
        if ($choosen_typology) {
            Person::where('id', $id)->update(['typology' => $choosen_typology->vote]);
        }

    }

}
