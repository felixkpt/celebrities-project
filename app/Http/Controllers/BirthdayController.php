<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{

    /**
     * @property $perPage
     */
    private $perPage = 15;

    /**
     * The index method for displaying months and dates
     */
    public function index() {
        $data = ['title' => 'Birthdays by month', 'description' => 'Birthdays'];
        return view('birthdays/index', $data);
    }
    /**
     * The year method for displaying the people born by year
     */
    public function year($year) {
        $people = Person::where('dob', 'regexp', '^'.$year.'-')->paginate($this->perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $data = ['title' => 'Birthdays', 'description' => 'Birthdays', 'people' => $people, 'year' => $year];
        return view('birthdays/year', $data);
    }
    /**
     * The year method for displaying the people born by year
     */
    public function yearMonth($year, $month) {
        $people = Person::where([['dob', 'regexp', '^'.$year.'-'], ['birth_month', $month]])->paginate($this->perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }

        $data = ['title' => 'Birthdays', 'description' => 'Birthdays', 'people' => $people, 'year' => $year, 'month' => $month];
        return view('birthdays/year-month', $data);
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

        $data = ['title' => 'Birthdays', 'description' => 'Birthdays', 'people' => $people, 'month' => $month, 'day' => $day];
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

        $data = ['title' => 'Birthdays', 'description' => 'Birthdays', 'people' => $people, 'month' => $month, 'day' => $day];
        return view('birthdays/day', $data);
    }
     
    /**
     * The monthday method for displaying the people born by month and day
     */
    public function monthDay($month, $day) {
        $people = Person::where([['birth_month', $month], ['birth_day', $day]])->paginate($this->perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        
        $data = ['title' => 'Birthdays', 'description' => 'Birthdays', 'people' => $people, 'month' => $month, 'day' => $day];
        return view('birthdays/month-day', $data);
    }

     /**
     * The monthday method for displaying the people born by month and day
     */
    public function yearMonthDay($year, $month, $day) {
        $people = Person::where([['dob', 'regexp', '^'.$year.'-'], ['birth_month', $month], ['birth_day', $day]])->paginate($this->perPage);
        if (count($people) < 1) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $data = ['title' => 'People born '.date('Y, F, jS', strtotime($people[0]->dob)), 'description' => 'Birthdays', 'people' => $people, 'year' => $year, 'month' => $month, 'day' => $day];
        return view('birthdays/year-month-day', $data);
    }
    
}
