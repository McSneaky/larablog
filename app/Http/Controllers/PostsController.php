<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;

use Auth;
use DB;
use App\Post;
use App\User;
use App\Image;
use Storage;

class PostsController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Protect whole controller with authentication
		// 	expect "view all posts" and "show single post" parts
		$this->middleware('auth')->except(['index', 'show']);
	}


	/**
	 * Display all posts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Get all posts and show latest updated ones first
		// 	Doing simple paginate instead of reagular to use less server resources
		// 	since there might be millions of posts
		$posts = Post::orderBy('updated_at', 'desc')->simplePaginate(21);

		return view('post/index', compact('posts'));
	}

	/**
	 * Show the form for creating a new post.
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
		// Validate new post title, body and uploaded images
		$this->validate($request, [
			'title' => 'required|max:255',
			'body' => 'max:4000',
			'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		// Create new post and attach it to currently logged in user
		$post = Auth::user()->posts()->create([
			'title' => $request->title,
			'body' => $request->body,
		]);

		// If post has images, then store them all into /storage/app/public/img_name
		// 	and save path to database
		if ($request->file('images')){
			foreach ($request->file('images') as $image)
			{
				$path = $image->store('public');
				$post->images()->create([
					'path' => $path,
				]);
			}
		}

		return redirect()->route('post_show', $post->id);
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		// Check if post exists, if it doesn't then return to all posts page
		// 	with error message
		$post = Post::find($id);
		if (!$post) { 
			return redirect()->route('posts')->with('message', 'no_post');
		}

		// Get all post comments with their owner and reverse order to show new ones first
		$post->comments = $post->comments()->with('User')->get()->reverse();

		return view('post/show', compact('post'));
	}


	/**
	 * Show the form for editing the specified post.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		return view('post/edit', compact('post'));
	}

	/**
	 * Update the specified post in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		// Validate post title and body
		$this->validate($request, [
			'title' => 'required|max:255',
			'body' => 'max:4000',
		]);

		// After validation is passed then update given post
		$post = Post::find($id);
		if ($post) {
			$post->title = $request->title;
			$post->body = $request->body;
			$post->save();
		}

		return redirect()->route('post_show', $id);
	}

	/**
	 * Remove the specified post from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$post = Post::with('user')->find($id);

		// Allow only owner and admin / modem delete it
		if (Auth::user()->canModerate() || $post->user_id == Auth::id()) {
			$post->delete();
		}

		return redirect()->route('posts');
	}

	/**
	 * Remove the specified image from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function removeImage($id)
	{
		// If image is not found, then redirect back
		$image = Image::find($id);
		if (!$image) { return back(); }

		// Allow only owner and admin / modem delete it
		$post = $image->post;
		if ($post->user_id == Auth::id() || Auth::user()->canModerate()) {
			Storage::delete($image->path);
			$image->delete();
		}

		return back();
	}
}