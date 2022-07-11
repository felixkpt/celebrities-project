<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {

        // Socialite::driver('google')->stateless()->user();

        try {
            $user = Socialite::driver('google')->user();

            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'slug' => Str::of($user->getName())->slug('-')->value(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            // Check if any user is register
            if (User::count() == 1) {
                $saveUser->assignRole('Admin');
            }

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('danger', 'Error logging you in, try again.');
        }
    }
}
