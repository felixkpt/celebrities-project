<?php
    namespace App\Http\Controllers;
    
    use App\Models\Person;
    use Illuminate\Http\Request;
    
    class TimeZoneController extends Controller
    {
    
        /**
         * @property $perPage
         */
        private $perPage = 15;
    
        /**
         * The show method for displaying the people by timezone
         */
        public function show($timezone, $timezone_description) {
            // dd($timezone, $timezone_description);
            $people = Person::where('timezone', 'like', $timezone)->paginate($this->perPage);
            if (count($people) < 1) {
                return redirect()->back()->with('warning', 'Whoops! Not found.');
            }
            $percentage = 0;
            similar_text(preg_replace("#-#", " ", $timezone_description), $people[0]->timezone_description, $percentage);
            if ($percentage < 70) {
                return redirect()->back()->with('warning', 'Whoops! Not found.');
            }

            $data = ['title' => 'Showing people by their timezone', 'description' => 'Celebrities living in timezone '.$people[0]->timezone_description, 'people' => $people, 'timezone' => $people[0]->timezone, 'timezone_description' => $people[0]->timezone_description];
            return view('timezones/details', $data);
        }
    
        /**
         * The month method for displaying the people born by month
         */
        public function month($month) {
            $people = Person::where([['birth_month', $month]])->paginate($this->perPage);
            if (count($people) < 1) {
                return redirect()->back()->with('warning', 'Whoops! Not found.');
            }
            $day = '01';
            $data = ['title' => 'Showing the people by born month', 'description' => 'Showing the people by born month', 'people' => $people, 'month' => $month, 'day' => $day];
            return view('birthdays/month', $data);
        }
    
        /**
         * The day method for displaying the people born by day
         */
        public function day($day) {
            $people = Person::where([['birth_day', $day]])->paginate($this->perPage);
            if (count($people) < 1) {
                return redirect()->back()->with('warning', 'Whoops! Not found.');
            }
            $month = '01';
            $data = ['title' => 'Showing the people by born day', 'description' => 'Showing the people by born day', 'people' => $people, 'month' => $month, 'day' => $day];
            return view('birthdays/day', $data);
        }
        
    }
    