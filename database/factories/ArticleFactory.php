<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'author_id' => factory(User::class),
        'title' => $faker->sentence,
        'body' => $faker->paragraphs(5, true),
        'cover' => unsplash(),
        'published_at' => Carbon::parse($faker->date),
    ];
});
