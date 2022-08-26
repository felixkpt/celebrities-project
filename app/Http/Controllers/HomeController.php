<?php
namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\MBTI;
use App\Settings\SiteInfo;
class HomeController extends Controller
{
    /** 
     * Our homepage method
     * @return Response
     */
    public function index() {
        $personalities = MBTI::orderby('strength')->limit(8)->get();
        $people = Person::where('published', 'published')->where('birth_month', date('m'))->limit(16)->inRandomOrder()->get();
        $title = SiteInfo::title();
        $description = SiteInfo::description();
        $data = ['title' => $title, 'description' => $description, 'personalities' => $personalities, 'people' => $people];
        return view('home/index', $data);
    }
}
