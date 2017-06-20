<?php

/*
|--------------------------------------------------------------------------
| PostsFactory
|--------------------------------------------------------------------------
|
| Generate posts with some random data
| 	title 	= 	random name
|	body 	= 	random text
|	user_id	=	attach post to random user
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$users = App\User::get()->pluck('id')->toArray();
$factory->define(App\Post::class, function (Faker\Generator $faker) use ($users) {
    return [
        'user_id' => $faker->randomElement($users),
        'title' => $faker->name,
        'body' => $faker->text,
    ];
});
