<?php

namespace App\Http\Controllers;

use App\Models\MBTIVotes;
use Illuminate\Support\Facades\Auth;
use App\Models\MBTI;
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
        $people = Person::where('published', 'published')->orderby('updated_at', 'desc')->paginate($perPage);
        $data = ['title' => 'Famous celebrities', 'description' => 'All Famous celebrities', 'people' => $people];
        return view('people/mbti/index', $data);
    }

    /**
     * Showing specified people
     */
    public function show($slug) {
        $perPage = $this->perPage;  
        $typology = rtrim($slug, 's');
        $people = Person::where('published', 'published')->where('typology', '=', $typology)->orderby('updated_at', 'desc')->paginate($perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        
        $data = ['title' => 'Details about '.$slug, 'description' => 'Details about '.$slug, 'people' => $people];
        return view('people/mbti/index', $data);
        
    }


    /**
     * Showing people by typologies
     */
    public function mbtis() {
        $people = Person::where('published', 'published')->get();
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
    }

    /**
     * Showing specified typology type people
     */
    public function mbti($slug) {
        $perPage = $this->perPage;
        $typology = rtrim($slug, 's');
        $personality = strtoupper($typology);
        $personality = MBTI::where('name', '=', $personality)->first();
        if (!$personality) {
            abort(404);
        }

        $people = Person::where('published', 'published')->where('typology', '=', $typology)->orderby('updated_at', 'desc')->paginate($perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }

        $title = 'Most famous '.$personality->name.'s in the year '.date('2022');
        $description = 'Myers–Briggs Type Indicator (MBTI) & enneagram of most famous '.$personality->name.'s in the year '.date('2022');
        $data = ['title' => $title, 'description' => $description, 'people' => $people, 'personality' => $personality];
        return view('people/mbti/details', $data);
        
    }
    /**
     * Showing a single person
     */
    public function person($id, $slug) {
        $this->updateTypology($id);

        $person = Person::where('published', 'published')->where([['id', '=', $id,], ['slug', '=', $slug]])->with('personality')->first();
        $vote = null;
        if (!$person) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }elseif (Auth::user()) {
            $vote = MBTIVotes::where([['user_id', '=', Auth::user()->id], ['person_id', '=', $person->id]])->first();    
        }
                
        $title = 'Who is '.$person->first_name.' '.$person->last_name.'?';
        $description = "Comprehensive bio information about Princeton $title, Early life of $title, Trivia of $title, Family of $title";

        $data = ['title' => $title, 'description' => $description, 'person' => $person, 'vote' => $vote];
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
             $exists = MBTIVotes::where([['user_id', '=', $user_id], ['person_id', '=', $person_id]])->first();
             if (!$exists) {
                MBTIVotes::create($arr);
                return redirect()->back()->with('success', 'Successfully voted MBTI for this person.');
                
            }else{
                MBTIVotes::where('id', $exists->id)->update($arr);
                return redirect()->back()->with('success', 'Successfully updated MBTI vote for this person.');
            }
        }else{
            return redirect()->back()->with('danger', 'Invalid MBTI vote seletion.');
        }
    }
    public function updateTypology($id) {
        $choosen_typology = MBTIVotes::select('vote')->groupBy('vote')
        ->orderByRaw('count(*) desc')
        ->where('person_id', $id)->first();
        if ($choosen_typology) {
            Person::where('published', 'published')->where('id', $id)->update(['typology' => $choosen_typology->vote]);
        }

    }

}
