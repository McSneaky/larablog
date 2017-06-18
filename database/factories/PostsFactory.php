<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->name,
        'body' => $faker->text,
    ];
});
