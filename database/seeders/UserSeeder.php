<?php

namespace Database\Seeders;

use Throwable;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($counts = 20)
    {
    
        if (!User::take(1)->first()) {
            
            exit('Before we continue please register at least 1 account first on the frontend. The account will be used as admin default account.');
        }
        for($i=0; $i<$counts; $i++) {
            
            try { 
           
                $person = file_get_contents('https://randomuser.me/api');
                // $person = '{"results":[{"gender":"female","name":{"title":"Ms","first":"Siham","last":"Kvalvåg"},"location":{"street":{"number":4991,"name":"Holmestrandgata"},"city":"Lervik","state":"Møre og Romsdal","country":"Norway","postcode":"4575","coordinates":{"latitude":"55.9982","longitude":"169.2780"},"timezone":{"offset":"-4:00","description":"Atlantic Time (Canada), Caracas, La Paz"}},"email":"siham.kvalvag@example.com","login":{"uuid":"d7f47576-3cdb-421c-a14c-c705614fe55e","username":"smallpeacock546","password":"crystal","salt":"UZSieW4g","md5":"94e22814637db357b179ea11690f6960","sha1":"68f91e05132c648208e1470ae5919caaefedcb18","sha256":"5ab9fea2defa4e7d684b9a8cb69fcbcbf0bfa06ec11c2750fa45d553c5ff29c5"},"dob":{"date":"1946-08-16T21:55:38.377Z","age":76},"registered":{"date":"2008-01-06T08:51:57.746Z","age":14},"phone":"22993396","cell":"46536528","id":{"name":"FN","value":"16084641484"},"picture":{"large":"https://randomuser.me/api/portraits/women/37.jpg","medium":"https://randomuser.me/api/portraits/med/women/37.jpg","thumbnail":"https://randomuser.me/api/portraits/thumb/women/37.jpg"},"nat":"NO"}],"info":{"seed":"78d353801f8df232","results":1,"page":1,"version":"1.3"}}';
                $person = (json_decode($person)->results)[0];
    
                $first_name = $person->name->first;
                $last_name = $person->name->last;
                $email = $person->email;
                $image_url = $person->picture->large;
                
                $contents = file_get_contents($image_url);
                $path = 'public/users/'.Str::random(16).'.'.pathinfo($image_url)['extension'];
                Storage::put($path, $contents);

                $path = preg_replace('#public/#', 'uploads/', $path);
                
                $url = asset($path);
            } catch (Throwable $e) {
                echo $e->getMessage();
            }

            if (isset($url) && !User::where('email', $email)->first()) {
                
                User::create([
                    'name' => $name = trim($first_name.' '.$last_name),
                    'slug' => Str::slug($name),
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10),
                    'avatar' => $url,
                ]);

            }
        }
    }
}
