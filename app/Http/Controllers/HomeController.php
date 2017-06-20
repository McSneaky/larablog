<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = Auth::user()->greetingMessage();

        if (Auth::user()->isAdmin()) {
            $users = User::with('role')->paginate(10);
            $roles = Role::get();
            return view('home', compact('message', 'users', 'roles'));
        }

        return view('home', compact('message'));
    }
}
