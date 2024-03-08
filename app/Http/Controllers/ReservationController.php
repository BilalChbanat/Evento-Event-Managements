<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Event;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::simplePaginate(6);
        return view('reservations', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $id)
    {
        $event = Event::findorFail($id);

        if ($event) {
            Reservation::create([
                'event_id' => $id,
                'user_id' => auth()->id(),
                'reservation_status' => 'accepted',
                'reference' => Str::random(10),
            ]);


            return redirect()->back()->with('status', 'Reservation created successfully!');
        }

        return redirect()->back()->with('status', 'Event not found!');
    }
    /**
     * Display the specified resource.
     */
    // public function show(Reservation $reservation)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Reservation $reservation)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateReservationRequest $request, Reservation $reservation)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Reservation $reservation)
    // {
    //     //
    // }
}
