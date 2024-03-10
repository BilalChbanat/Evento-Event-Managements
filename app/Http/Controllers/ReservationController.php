<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Barryvdh\DomPDF\Facade\Pdf;
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
     * Store a newly created resource in storage.
     */
    public function store(int $id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();

        // Check if the user has already reserved this event
        if ($user->reservations()->where('event_id', $id)->exists()) {
            return redirect()->back()->with('status', 'You have already reserved this event!');
        }

        // Check if there are available seats
        if ($event->availableSeats > 0) {
            if ($event->acceptance === 'auto') {
                // Create a reservation
                $reservation = Reservation::create([
                    'event_id' => $id,
                    'user_id' => $user->id,
                    'reservation_status' => 'accepted',
                    'reference' => Str::random(22),
                ]);

                // Decrement available seats
                $event->decrement('availableSeats');

                // Prepare data for the PDF view
                $data = [
                    'event' => $event,
                    'reservation' => $reservation,
                ];

                // Generate and download the PDF
                $pdf = Pdf::loadView('tickets.ticket', $data);
                return $pdf->download('ticket.pdf');

            } else {
                // Create a reservation
                Reservation::create([
                    'event_id' => $id,
                    'user_id' => $user->id,
                    'reservation_status' => 'pending',
                    'reference' => Str::random(22),
                ]);

                // Decrement available seats
                $event->decrement('availableSeats');
            }
        } else {
            return redirect()->back()->with('status', 'Out of stock');
        }

        return redirect()->back()->with('status', 'Event not found!');
    }
}
