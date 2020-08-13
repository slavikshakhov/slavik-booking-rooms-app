<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::all()->each(function (Room $room) {
            $reviews = factory(Review::class, random_int(5, 30))->make();
            $room->reviews()->saveMany($reviews);
        });
    }
}
