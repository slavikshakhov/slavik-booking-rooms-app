<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Room;
use Illuminate\Support\Arr;

$rooms_description = [
    'Great View',
    'Central Location',
    'Spacial room downtown',
    'Loft with garden',
    'Room for students',
    'Family house',
    'View to the Central Park',
    'Newly Renovated Apartment',
    'Room for the summer',
    'Apartment for students',
    'Shared room for students',
    'Downtown accomodation',
];

$factory->define(Room::class, function (Faker $faker) use ($rooms_description) {
    return [
        'title' => $faker->city . ' ' . Arr::random($rooms_description),
        'description' => $faker->text(),
        'price' => random_int(15, 600),
    ];
});
