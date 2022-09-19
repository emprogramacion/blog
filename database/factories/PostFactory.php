<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence, //Crear una oración por cada título
        'body' => $faker->text(800), //Crear un texto de 800 caractéres por cada body
    ];
});
