<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'body' => '<p>' . implode('</p><p>', $faker->paragraphs(5)) . '</p>',
        'cover' => unsplash(800, 540),
        'started_at' => $date = Carbon::parse($faker->date),
        'ended_at' => $date->copy()->addDays(3),
        'location' => $faker->address,
        'host' => $faker->name,
        'website_url' => $faker->url,
        'registration_url' => $faker->url,
    ];
});
