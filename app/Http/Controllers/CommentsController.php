<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
class CommentsController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect back
     */
    public function store($id, Request $request)
    {
        // Comment is required and with max lenght 255 characters
    	$this->validate($request, [
			'comment' => 'required|max:255',
		]);


        // Check if post exists, if it doesnt, then return back
    	$post = Post::find($id);
    	if (!$post) { return back(); }

    	// After comment is validated and post selected,
        //  then insert comment into database
    	$post->comments()->create([
    		'user_id' => Auth::id(), // null if none
    		'body' => $request->comment,
    	]);

        // Go back to previous page
    	return back();
    }
}
