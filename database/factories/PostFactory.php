<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'img' => $faker->image('public/storage/images', 400, 300, null, false),
        'title' => $faker->sentence,
        'body' => $faker->paragraph(rand(2, 6))
    ];
});
