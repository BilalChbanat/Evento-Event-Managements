<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('status' , '==', 'accepted')->paginate(10);
        return view('events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();

        $path = 'uploads/events/';
        $fileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $file->move($path, $fileName);
        }

        $data = [
            'title' => $validatedData['title'],
            'image' => $fileName ? $path . $fileName : null,
            'location' => $validatedData['location'],
            'capacity' => $validatedData['capacity'],
            'availableSeats' => $validatedData['availableSeats'],
            'price' => $validatedData['price'],
            'acceptance' => $validatedData['acceptance'],
            'status' => $validatedData['status'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'user_id' => 2, 
            'category_id' => 1, 
        ];

        $event = Event::create($data);

        return redirect()->back()->with('status', 'Event Created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $event = Event::findOrFail($id);
        return view('admin', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, int $id)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpeg,jpg,webp',
            'location' => 'required|max:255|string',
            'capacity' => 'required|integer',
            'availableSeats' => 'required|integer',
            'price' => 'required|numeric',
            'acceptance' => 'required|in:auto,manual',
            'status' => 'required|in:pending,accepted,rejected',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $path = 'uploads/events/';
            $file->move($path, $fileName);

            if (File::exists($event->image)) {
                File::delete($event->image);
            }
        }


        $event->update([
            'title' => $request->title,
            'image' => $path . $fileName,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'availableSeats' => $request->availableSeats,
            'price' => $request->price,
            'acceptance' => $request->acceptance,
            'status' => $request->status,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => 2,
            'category_id' => 1,
        ]);

        return redirect()->back()->with('status', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->back();
    }
}
