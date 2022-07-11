<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Models\Person;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\PersonContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
class PersonSeeder extends Seeder
{
    protected $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create();
        $counts = 100;
        for($i=0; $i<$counts; $i++) {
            // sleep(2);
            $person = file_get_contents('https://randomuser.me/api');
            // $person = '{"results":[{"gender":"female","name":{"title":"Ms","first":"Siham","last":"Kvalvåg"},"location":{"street":{"number":4991,"name":"Holmestrandgata"},"city":"Lervik","state":"Møre og Romsdal","country":"Norway","postcode":"4575","coordinates":{"latitude":"55.9982","longitude":"169.2780"},"timezone":{"offset":"-4:00","description":"Atlantic Time (Canada), Caracas, La Paz"}},"email":"siham.kvalvag@example.com","login":{"uuid":"d7f47576-3cdb-421c-a14c-c705614fe55e","username":"smallpeacock546","password":"crystal","salt":"UZSieW4g","md5":"94e22814637db357b179ea11690f6960","sha1":"68f91e05132c648208e1470ae5919caaefedcb18","sha256":"5ab9fea2defa4e7d684b9a8cb69fcbcbf0bfa06ec11c2750fa45d553c5ff29c5"},"dob":{"date":"1946-08-16T21:55:38.377Z","age":76},"registered":{"date":"2008-01-06T08:51:57.746Z","age":14},"phone":"22993396","cell":"46536528","id":{"name":"FN","value":"16084641484"},"picture":{"large":"https://randomuser.me/api/portraits/women/37.jpg","medium":"https://randomuser.me/api/portraits/med/women/37.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/37.jpg"},"nat":"NO"}],"info":{"seed":"78d353801f8df232","results":1,"page":1,"version":"1.3"}}';
            if ($person) {
                $person = (json_decode($person)->results)[0];
    
                $gender = $person->gender;
                $title = $person->name->title;
                $first_name = $person->name->first;
                $last_name = $person->name->last;
                $slug = Str::slug($first_name.' '.$last_name, '-');
                $dbDate = \Carbon\Carbon::parse($person->dob->date);
                $dob = $dbDate->format('Y-m-d H:i:s');
                $age = \Carbon\Carbon::now()->diffInYears($dbDate);

                $birth_month = date('m', strtotime($dob));
                $birth_day = date('d', strtotime($dob));
                $image = $person->picture->large;
                $city = $person->location->city;
                $state = $person->location->state;
                $country = $person->location->country;
                $c = Country::where('name', 'like', $country)->first();
                $country_code = 'ZZZ'; 
                    if ($c) {
                        $country = $c->name;
                        $country_code = $c->code;
                }                
                $timezone = $person->location->timezone->offset;
                $timezone_description = $person->location->timezone->description;
    
                $url = $image;
                $contents = file_get_contents($url);
                $path = 'public/images/people/random/'.Str::random(16).'.'.pathinfo($url)['extension'];
                Storage::put($path, $contents);
                $path = preg_replace('#public/#', 'uploads/', $path);
                
                $personalities = [
                    'ISTJ',
                    'ISTP',
                    'ISFJ',
                    'ISFP',
                    'INFJ',
                    'INFP',
                    'INTJ',
                    'INTP',
                    'ESTP',
                    'ESTJ',
                    'ESFP',
                    'ESFJ',
                    'ENFP',
                    'ENFJ',
                    'ENTP',
                    'ENTJ'];
    
                    $data =  [
                    'title' => $title,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'nickname' => $this->faker->name($gender),
                    'slug' => $slug,
                    'gender' => $gender,
                    'dob' => $dob,
                    'age' => $age,
                    'birth_month' => $birth_month,
                    'birth_day' => $birth_day,
                    'county' => $this->faker->text(20),
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'country_code' => $country_code,
                    'professional' => ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(3, 10)))),
                    'worth' => $this->faker->numberBetween(500, 1000000),
                    'hobbies' => ucwords(implode(', ', $this->faker->words(5))),
                    'typology' => $this->faker->randomElement($personalities),
                    'website' => $this->faker->url(),
                    'image' => $path,
                    'timezone' => $timezone,
                    'timezone_description' => $timezone_description,
                ];
                    // var_dump($data);die;
                $obj = new Person();

                $quotes = '<ul><li>'.implode("</li><li>", $this->faker->words($this->faker->numberBetween(4, 10))).'</li></ul>';
                $content = '<p>'.implode("</p><p>", $this->faker->paragraphs($this->faker->numberBetween(1, 10))).'</p>';
                   
                try {
                    DB::beginTransaction();
                 
                    $person = $obj::create($data);
                    PersonContent::create(['person_id' => $person->id, 'quotes' => $quotes, 'content' => $content]);

                    DB::commit();
                
                } catch (Throwable $e) {
                    DB::rollback();
                }
            }
        }
    }
}
