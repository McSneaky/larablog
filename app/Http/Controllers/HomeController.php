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
		// Protect whole controller with authentication
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *  For admins show admin panel
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Get user greeting message
		$message = Auth::user()->greetingMessage();

		// If user is admin and attach data for admin dashboard
		if (Auth::user()->isAdmin()) {
			
			$users = User::with('role')->paginate(10);
			$roles = Role::get();

			return view('home', compact('message', 'users', 'roles'));
		}

		return view('home', compact('message'));
	}
}
