<?php

namespace App\Http\Controllers\Api;
use App\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomPriceController extends Controller
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
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:fro',
        ]);

        return response()->json([
            'data' => $room->priceFor($data['from'], $data['to']),
        ]);
    }
}
