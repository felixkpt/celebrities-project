<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Http\Controllers\Admin\FamousSource;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Person;
use App\Models\PersonContent;
use App\Models\Professional;
use App\Models\Typology;
use App\Models\User;
use App\Models\Enneagram;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PersonController extends Controller
{
    protected $route = 'admin.people';
    protected $horoscope_dates = [
        'Aquarius' => ['01-20', '02-18'],
        'Pisces' => ['02-19', '03-20'],
        'Aries' => ['03-21', '04-19'],
        'Taurus' => ['04-20', '05-20'],
        'Gemini' => ['05-21', '06-20'],
        'Cancer' => ['06-21', '07-22'],
        'Leo' => ['07-23', '08-22'],
        'Virgo' => ['08-23', '09-22'],
        'Libra' => ['09-23', '10-22'],
        'Scorpio' => ['10-23', '11-21'],
        'Sagittarius' => ['11-22', '12-21'],
        'Capricorn' => ['12-22', '01-19']
    ];
    /**
     * @param string $image_rules
     */
    private $image_rules = 'mimes:jpg,png,jpeg,gif|min:2|max:2024|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000';
    private $rules = [
        'title' => 'nullable|string|max:10',
        'first_name' => 'required|min:1|max:30',
        'last_name' => 'max:30',
        'nickname' => 'max:30',
        'gender' => 'string',
        'dob' => 'date',
        'county' => 'nullable|string|max:50',
        'state' => 'nullable|string|max:50',
        'city' => 'string|max:50',
        'birth_place' => 'string|max:50',
        'birth_sign' => 'string|max:30',
        'country_code' => 'string|max:30',
        'professional' => 'string|max:30',
        'typology' => 'required|min:4|max:4',
        'timezone' => 'max:20',
        'timezone_description' => 'max:150',
        'died_on' => 'nullable|date',
    ];
    private $rules2 = [
        'worth' => 'nullable|integer',
        'hobbies' => 'nullable|string|max:100',
        'quotes' => 'nullable|string|max:1000',
        'content' => 'required|min:10|max:20000',
        'website' => 'nullable|url|max:100',
    ];

    private $perPage = 20;

    public function index(Request $request)
    {
        $title = 'All People';

        if ($slug = $request->get('author')) {
            $author = User::where('slug', $slug)->first();
            if (!$author) {
                return redirect()->back()->with('warning', 'Whoops! Author not found.');
            }
            $people = Person::whereHas('author', function ($q) use ($author) {
                $q->where([['person_user.user_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $people->appends(['author' => $slug]);
            $title = 'All People by ' . $author->name . ' (' . $people->total() . ')';
        } elseif ($slug = $request->get('category')) {
            $category = Category::where('slug', $slug)->first();
            if (!$category) {
                return redirect()->back()->with('warning', 'Whoops! Category not found.');
            }
            $people = Person::whereHas('category', function ($q) use ($category) {
                $q->where([['post_category.category_id', $category->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $people->appends(['category' => $slug]);
            $title = 'All People in the category ' . $category->name . ' (' . $people->total() . ')';
        } else {
            $people = Person::with('authors')->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $title = 'All People (' . Person::count() . ')';
        }

        $data = ['people' => $people, 'route' => $this->route, 'title' => $title];
        return view($this->route . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = ['route' => $this->route . '.index', 'method' => 'post', 'require_editor' => true];
        $data['notification_type'] = 'inline';
        return view($this->route . '.create', $data);
    }

    /**
     * Fetching new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        return view($this->route . '.fetch', ['route' => $this->route . '.index', 'method' => 'post']);
    }
    public function store(Request $request)
    {

        $data = $this->validity($request, false);
        $values = $data['fields'];
        $values['published'] = 'published';
        $fields2 = $data['fields2'];

        try {
            DB::beginTransaction();
            $person = Person::create($values);
            PersonContent::create(array_merge(['person_id' => $person->id], $fields2));
            // Attaching author
            $person->authors()->attach(User::auth()->id, ['manager_id' => User::auth()->id]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
        }

        return redirect()->route($this->route . '.index')->with('success', 'Successfully added person.');
    }

    private function validity($request, $update = false)
    {
        if (!$update) {

            $person = Person::where([
                ['first_name', '=', $request->get('first_name')],
                ['first_name', '=', $request->get('first_name')],
                ['city', '=', $request->get('city')],
                ['dob', '=', $request->get('dob')]
            ])->first();
            if ($person) {
                return redirect()->back()->withInput()->with('danger', 'Similar person exists');
            }
        }

        $rules = array_merge($this->rules, ['image' => ($update ?: 'required|') . $this->image_rules]);

        if ($request->hasFile('image')) {
            $rules = array_merge($rules, ['image' => $this->image_rules]);
        }

        $fields = $request->validate($rules);

        $rules = $this->rules2;
        $fields2 = $request->validate($rules);

        $slug = Str::slug($request->get('first_name') . ' ' . $request->get('last_name'));
        $birth_day = date('d', strtotime($request->get('dob')));
        $birth_month = date('m', strtotime($request->get('dob')));
        $md = $birth_month . '-' . $birth_day;
        $birth_sign = '';
        foreach ($this->horoscope_dates as $b_s => $horo) {
            if ($md >= $horo[0] && $md <= $horo[1]) {
                $birth_sign = $b_s;
            }
        }

        $age = \Carbon\Carbon::parse($request->get('dob'))->diffInYears(now());

        $country = Country::where('code', $request->get('country_code'))->first()->name;

        $computed = ['slug' => $slug, 'birth_day' => $birth_day, 'birth_month' => $birth_month, 'birth_sign' => $birth_sign, 'age' => $age, 'country' => $country];
        $values = array_merge($fields, $computed);
        // var_dump($values);die;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/people');
            $path = preg_replace('#public/#', 'uploads/', $path);
            $values['image'] = $path;
        }

        return ['fields' => $values, 'fields2' => $fields2];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);
        $data = ['person' => $person, 'route' => $this->route . '.update', 'method' => 'patch', 'require_editor' => true];
        $data['notification_type'] = 'inline';
        return view($this->route . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->get('id');

        $data = $this->validity($request, true);
        $values = $data['fields'];
        $values['published'] = 'published';
        $fields2 = $data['fields2'];

        try {
            DB::beginTransaction();
            $person = Person::find($id);
            $person->update($values);
            PersonContent::where('person_id', $id)->update($fields2);
            // Attaching author
            $authors = $person->mainAuthors->toArray();
            if (!in_array(Auth::user()->id, array_column($authors, 'id'))) {
                $person->authors()->attach(Auth::user()->id, ['manager_id' => Auth::user()->id]);
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
        }

        return redirect()->route($this->route . '.index')->with('success', 'Successfully edited person.');
    }

    /** 
     * Fetcher method
     */
    public function fetcher(Request $request)
    {
        $total_cities = 113529;
        if (City::count() < $total_cities) {
            return redirect()->back()->with('danger', 'Please run cities seeder first.');
        }

        $url = $request->get('url');
        $single = $request->get('single');
        $urls = [$url];

        if (!$single) {
            $urls = [];
            $data = FamousSource::getLinks($url);
            if ($data) {
                $urls = $data['links'];
            }
        }
        // dd($urls);
        // dd(Person::count()+1);
        foreach ($urls as $url) {
            /**
             * Create a Goutte Client instance (which extends Symfony\Component\BrowserKit\HttpBrowser):
             */
            // $client = new Client();
            $client = new Client(HttpClient::create(['timeout' => 60]));
            /**
             * Make requests with the request() method:
             * Go to the symfony.com website
             */
            $crawler = $client->request('GET', $url);
            /**
             * The method returns a Crawler object (Symfony\Component\DomCrawler\Crawler).
             * To use your own HTTP settings, you may create and pass an HttpClient instance to Goutte. For example, to add a 60 second request timeout:
             */

            /**
             * Images
             */
            $images = FamousSource::getImages($crawler);
            if (!is_array($images)) {
                echo $url;
                die;
            }
            shuffle($images);
            $images = array_slice($images, 0, 1);

            /**
             * Name & Profession
             * Bio
             */
            $bio = FamousSource::getMainInfo($crawler, $url);

            $bio['image'] = $images[0];
            $typo = Typology::inRandomOrder()->first()->name;
            $bio['typology'] = $typo;
            $enneagram = Enneagram::inRandomOrder()->first()->name;
            $bio['enneagram'] = $enneagram;

            // Saving data

            $validation = Validator::make($bio, array_merge($this->rules, $this->rules2));
            // dd(count($validation->errors()->messages()), $bio['dob']);
            $proceed = false;
            if (count($validation->errors()->messages()) == 0) {
                $proceed = true;
                $person = Person::where([
                    ['first_name', '=', $bio['first_name']],
                    ['first_name', '=', $bio['first_name']],
                    ['city', '=', $bio['city']],
                    ['dob', '=', $bio['dob']]
                ])->first();
            }
            
            if ($proceed && !$person) {

                $fields = $bio;
                $slug = Str::slug($bio['first_name'] . ' ' . $bio['last_name']);
                $birth_day = date('d', strtotime($bio['dob']));
                $birth_month = date('m', strtotime($bio['dob']));
                $age = \Carbon\Carbon::parse($bio['dob'])->diffInYears(now());

                $country_code = @City::where('city', $bio['city'])->first()->country;
                $country = @Country::where('code', $country_code)->first()->name;

                $values = array_merge($fields, [
                    'slug' => $slug, 'birth_day' => $birth_day, 'birth_month' => $birth_month, 'age' => $age,
                    'country' => $country, 'country_code' => $country_code
                ]);
                // var_dump($values);die;

                if ($bio['image'] && $country) {
                    // create profession if not exists
                    $professional = Professional::where('name', $bio['professional'])->first();
                    if (!$professional) {
                        $professional = Professional::create(['name' => $bio['professional'], 'slug' => Str::slug($bio['professional'])]);
                    }
                    $values['professional_id'] = $professional->id;
                    $values['published'] = 'unpublished';

                    $image = $bio['image'];
                    $extension = pathinfo($image, 4);
                    $ct = Person::count() + 1;
                    $path = 'public/images/people/' . $ct . '.' . $extension;
                    try {
                        $values['image'] = $path;
                        $contents = file_get_contents($image);
                        Storage::put($path, $contents);
                        $path = preg_replace('#public/#', 'uploads/', $path);
                        $values['image'] = $path;

                        // dd($values);
                        $content = $values['content'];
                        unset($values['quotes']);
                        unset($values['content']);

                        try {
                            DB::beginTransaction();
                            $person = Person::create($values);
                            PersonContent::create(['person_id' => $person->id, 'content' => $content]);
                            
                            // Attaching author
                            $default_email = 'admin@email.com';
                            $user = User::where('email', $default_email)->first();
                            if (!$user) {
                                throw new Exception('The admin email: '.$default_email.' is missing.');
                            }
                            $user_id = $user->id;
                            $person->authors()->attach($user_id, ['manager_id' => $user_id]);

                            DB::commit();
                        } catch (Throwable $e) {
                            echo $e->getMessage();
                            die;
                            DB::rollback();
                        }
                        if ($single) {
                            return redirect()->back()->with('success', 'Successfully added person.');
                        }
                    } catch (Throwable $e) {
                        echo $e->getMessage();
                        if ($single) {
                            return redirect()->back()->with('danger', 'Could not add person, image was not found.');
                        }
                    }
                }
            } else {
                if ($single) {
                    return redirect()->back()->with('danger', 'Validation failed.');
                }
            }
        }
        return redirect()->back()->with('success', 'Successfully added people.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Person::find($request->get('id'))->delete();
        return redirect()->back()->with('danger', 'Person was deleted.');
    }
}
