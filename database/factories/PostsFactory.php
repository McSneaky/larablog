<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$users = App\User::get()->pluck('id')->toArray();
$factory->define(App\Post::class, function (Faker\Generator $faker) use ($users) {
    return [
        'user_id' => $faker->randomElement($users),
        'title' => $faker->name,
        'body' => $faker->text,
    ];
});
