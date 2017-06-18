<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;

use Auth;
use App\Post;
use App\User;

class PostsController extends Controller
{

	public function __construct()
	{
        $this->middleware('auth')->except(['index', 'show']);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Reverse order
		// Doing simple paginate instead of reagular to use less server resources
		$posts = Post::orderBy('updated_at', 'desc')->simplePaginate(20);

		return view('post/index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

		return view('post/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|max:255',
			'body' => 'max:4000',
		]);

		$post = Auth::user()->posts()->create([
			'title' => $request->title,
			'body' => $request->body,
		]);

		return redirect('post/' . $post->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$post = Post::find($id);

		return view('post/show', compact('post'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$post = Auth::user()->posts()->find($id);

		return view('post/edit', compact('post'));
	}

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
			'title' => 'required|max:255',
			'body' => 'max:4000',
		]);

		$post = Auth::user()->posts()->find($id);
		if ($post) {
			$post->title = $request->title;
			$post->body = $request->body;
			$post->save();
		}

		return redirect('post/' . $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Auth::user()->posts()->find($id)->delete();

		return redirect('posts');
	}
}