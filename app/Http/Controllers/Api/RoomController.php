<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;
use App\Http\Resources\RoomIndexResource;
use App\Http\Resources\RoomShowResource;

class RoomController extends Controller
{
    public function index()
    {
        return RoomIndexResource::collection(Room::all());
    }

    public function show($id)
    {
        return new RoomShowResource(Room::findOrFail($id));
    }
}
