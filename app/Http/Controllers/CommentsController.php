<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
    	$this->validate($request, [
			'comment' => 'required|max:255',
		]);

    	$post = Post::find($id);
    	$post->comments()->create([
    		'user_id' => Auth::id() ?? null,
    		'body' => $request->comment,
    	]);

    	return back();
    }
}
