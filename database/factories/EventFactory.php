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
        'timezone' => $faker->timezone,
        'address_line_1' => $faker->streetAddress,
        'address_line_2' => null,
        'city' => $faker->city,
        'state' => $faker->state,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'host' => $faker->name,
        'google_map_embed' => google_map_embed(),
        'website_url' => $faker->url,
        'registration_url' => $faker->url
    ];
});
