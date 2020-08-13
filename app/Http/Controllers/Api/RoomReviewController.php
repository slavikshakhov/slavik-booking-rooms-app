<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;
use App\Http\Resources\RoomReviewIndexResource;

class RoomReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $room = Room::findOrFail($id);

        return RoomReviewIndexResource::collection(
            $room
                ->reviews()
                ->latest()
                ->get()
        );
    }
}
