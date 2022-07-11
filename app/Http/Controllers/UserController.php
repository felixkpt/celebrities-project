<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Models\User;

class UserController extends Controller
{
    
    /** The user repository implementation
     * @var UserRepository $users
    */
    protected $users;

    /**
     * Create a new user repository instance
     * @param UserRepository $users
     * @return void
     */
    public function __construct(UserRepository $users) 
    {
        $this->$users = $users;
        
    }

    /**
     * Show the profile for the give user
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $user = $this->users;
        dd($user);
        
        return view('user.profile', ['user' => $user]);
    }

}
