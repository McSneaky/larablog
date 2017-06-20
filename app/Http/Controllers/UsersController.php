<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UsersController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'sometimes|nullable|exists:roles,id',
		]);

        if (!Auth::user()->isAdmin()) {
        	return;
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if (!$request->role || $request->role == 0) {
        	$user->role_id = null;
        } else {
        	$user->role_id = $request->role;
        }

        $user->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
        	return;
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->route('home');
    }
}
