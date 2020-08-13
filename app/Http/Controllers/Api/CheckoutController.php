<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\Address;
use App\Room;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'bookings' => 'required|array|min:1',
            'bookings.*.room_id' => 'required|exists:rooms,id',
            'bookings.*.from' => 'required|date|after_or_equal:today',
            'bookings.*.to' => 'required|date|after_or_equal:bookings.*.from',
            'customer.first_names' => 'required|min:2',
            'customer.last_name' => 'required|min:2',
            'customer.street' => 'required|min:3',
            'customer.city' => 'required|min:2',
            'customer.email' => 'required|email',
            'customer.country' => 'required|min:2',
            'customer.state' => 'required|min:2',
            'customer.zip' => 'required|min:2',
        ]);
        $data = array_merge(
            $data,
            $request->validate([
                'bookings.*' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $room = Room::findOrFail($value['room_id']);

                        if (
                            !$room->availableFor($value['from'], $value['to'])
                        ) {
                            $fail(
                                'The object is not available in given dates!'
                            );
                        }
                    },
                ],
            ])
        );

        $bookingsData = $data['bookings'];
        $addressData = $data['customer'];

        $bookings = collect($bookingsData)->map(function ($bookingData) use (
            $addressData
        ) {
            $room = Room::findOrFail($bookingData['room_id']);
            $booking = new Booking();
            $booking->from = $bookingData['from'];
            $booking->to = $bookingData['to'];
            $booking->price = $room->priceFor($booking->from, $booking->to)[
                'total'
            ];
            $booking->room()->associate($room);
            $booking->address()->associate(Address::create($addressData)); // Address has no Booking's id, only vice versa

            $booking->save();

            return $booking;
        });

        return $bookings;
    }
}
