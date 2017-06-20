<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UsersController extends Controller
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
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate user input
    	$this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'sometimes|nullable|exists:roles,id',
		]);

        // If some modem or regular user tries to change user data exit function
        if (!Auth::user()->isAdmin()) {
        	return;
        }

        // Change user data
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Check for new role
        if (!$request->role || $request->role == 0) {
        	$user->role_id = null;
        } else {
        	$user->role_id = $request->role;
        }

        // Save user data
        $user->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Allow only admin to delete user
        if (!Auth::user()->isAdmin()) {
        	return;
        }

        // Search and destroy user
        $user = User::find($id);
        $user->delete();

        return redirect()->route('home');
    }
}
