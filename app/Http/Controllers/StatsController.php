<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category', 'all');
        $categories = Category::all(); // Assuming you have a Category model

        // Fetch events based on the selected category
        $events = Event::when($selectedCategory != 'all', function ($query) use ($selectedCategory) {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('id', $selectedCategory);
            });
        })->paginate(10);
        $events = Event::where('status', '=', 'accepted')->simplePaginate(6);
        return view('welcome', compact('events','categories', 'selectedCategory'));
    }
    public function dashBoardStatistiques(Request $request)
    {
        $categories = Category::all()->count();
        $events = Event::all()->count();
        $users = User::all()->count();
        $organizers = Role::where('name', 'organizer')->first()->users->count();

        return view('dashboard', compact('categories', 'events','users','organizers'));
    }

}
