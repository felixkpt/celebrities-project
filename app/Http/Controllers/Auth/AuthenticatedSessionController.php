<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\MessageBag;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Settings\SiteInfo;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Login | '.SiteInfo::name();
        $description = 'Login, Sign in | '.SiteInfo::name();
        $data = ['title' => $title, 'description' => $description, 'hide_sidebar' => true, 'notification_type' => 'none'];
        return view('auth.login', $data);
    }

    function loginEmail(Request $request) {
        $name = $request->get('email') ?? session()->get('email');
        $user = User::where('email', '=', $name)->orWhere('slug', '=', $name)->first();
        if (!$user) {
            return redirect()->to('login')->with('danger', 'Username/Email not found.')->withInput();
        }
        if ($user->google_id) {
            return redirect()->to('login')->with('danger', 'Account is associated with google. Please login with google.')->withInput();
        }

        $email = $user->email;
        session()->put(['email' => $email]);
        
         $data = ['title' => 'Login with email', 'description' => 'Login in with your email', 'hide_sidebar' => true, 'notification_type' => 'none', 'email' => $email];
         return view('auth.login-email', $data);
 
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request, MessageBag $message_bag)
    {
        if (User::where(['email' => $request->post('email'), 'is_active' => false])->first()) {
            $message_bag->add('in_active', 'Account is not acitve');
            return redirect()->back()->withErrors($message_bag);
        }
        $request->authenticate();
        // dd($request->all());

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
