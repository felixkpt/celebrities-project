<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\PersonController;
use App\Models\Option;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Mail;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class PersonFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'person:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting new or updating existing celebrities';

    private $base_url = 'https://www.famousbirthdays.com/';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = date('Y:m:d H:i:s');

        $exists = Option::where('name', 'person-fetcher')->first();
        $url = $this->base_url . (strtolower(date('F')) . (int) date('d') . '.html');
        if ($exists) {
            $url = $exists->value;
        }

        // Run the person fetcher
        $request = new Request();
        $request->merge(['url' => $url]);
        $person = new PersonController();
        $person->fetcher($request);

        // echo $person;
        $stop = preg_replace("/ ago/", "", \Carbon\Carbon::createFromTimeStamp(strtotime($start))->diffForHumans());

        $url = $this->nextUrl($url);
        if (!$exists) {
            Option::create([
                'name' => 'person-fetcher',
                'value' => $url
            ]);
        }else {
            $exists->update(['value' => $url]);
        }

        // Send email confirmation
        $this->sendMail();

        $this->info('Successfully run person fetcher for ' . $url . ', time taken: ' . $stop);
    }

    private function nextUrl(String $url)
    {
        $monthdate = explode("/", preg_replace("/(\/\/)/", "", $url))[1];
        $monthdate = preg_replace("#.html#", "", $monthdate);

        $month = preg_replace("/\d/", "", $monthdate);
        $date = explode($month, $monthdate);
        $date = $date[1];

        $fullDate = $month . ' ' . $date . ' ' . date('Y');

        $date = date('Y/m/d', strtotime($fullDate . ' +30 day'));
        $month = strtolower(date('F', strtotime($date)));
        $date = date('d', strtotime($date));

        return $this->base_url . $month . $date . '.html';
    }

    private function sendMail() {
                // // Setting up a random word
        // $key = array_rand($quotes);
        // $data = $quotes[$key];

        // $users = User::all();
        // foreach ($users as $user) {
        //     Mail::raw("{$key} -> {$data}", function ($mail) use ($user) {
        //         $mail->from('felixkpt@gmail.com');
        //         $mail->to($user->email)
        //             ->subject('Daily New Quote!');
        //     });
        // }
    }

}
