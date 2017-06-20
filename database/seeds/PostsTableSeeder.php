<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate $posts nr of random posts
    	$posts = 50;
        factory(Post::class, $posts)->create();
    }
}
