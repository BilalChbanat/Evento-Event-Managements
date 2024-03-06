<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $events = Event::paginate(5);
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('dashboard.events.create', compact('categories', 'user'));
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
            'availableSeats' => 2,  //$validatedData['availableSeats'],
            'price' => $validatedData['price'],
            'acceptance' => 'auto', //$validatedData['acceptance'],
            'status' => 'pending', //$validatedData['status'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'user_id' => Auth::id(),
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
        $categories = Category::all();
        $user = Auth::user();
        return view('dashboard.events.edit', compact('event', 'categories', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpeg,jpg,webp',
            'location' => 'required|max:255|string',
            // 'capacity' => 'required|integer',
            // 'availableSeats' => 'required|integer',
            'price' => 'required|numeric',
            // 'acceptance' => 'required|in:auto,manual',
            // 'status' => 'required|in:pending,accepted,rejected',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $event = Event::findOrFail($id);
        $path = 'uploads/events/';
        $fileName = null; // Initialize $fileName here

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $file->move($path, $fileName);

            if (File::exists($event->image)) {
                File::delete($event->image);
            }
        }

        $event->update([
            'title' => $request->title,
            'image' => $fileName ? $path . $fileName : null,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'availableSeats' => 88,
            'price' => $request->price,
            'acceptance' => 'auto',
            'status' => 'rejected',
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => Auth::id(),
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

    public function is_active()
    {
        $events = Event::paginate(6);
        return view('dashboard.events.is_active', compact('events'));
    }

    public function approve(int $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status' => 'accepted',
        ]);

        $events = Event::paginate(6);
        return view('dashboard.events.is_active', compact('events'));
    }

    public function refuse(int $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status' => 'rejected',
        ]);

        $events = Event::paginate(6);
        return view('dashboard.events.is_active', compact('events'));
    }

}
