<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\Event\EventEditRequest;
use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('created_at','desc')->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = EventCategory::get();

        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventCreateRequest $request)
    {
        $data = $request->validated();

        $data['featured_image'] = $request->file('featured_image')->store('events', 'public');

        Event::create($data);

        return redirect()->route("events.index")->with("success","Event created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return view("events.show", compact("event"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = EventCategory::get();

        return view("events.edit", compact("event","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventEditRequest $request, string $id)
    {
        $getEvent = Event::findOrFail($id);
        
        $oldImage = $getEvent->featured_image;
        
        $event = $getEvent->fill($request->validated());

        if ($request->hasFile("featured_image")) {
            $newImagePath = $request->file('featured_image')->store('events', 'public');

            $event->featured_image = $newImagePath;

            Storage::disk('public')->delete($oldImage);
        }

        $event->save();

        return redirect()->route('events.index')->with('success','Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        Storage::disk('public')->delete($event->featured_image);

        $event->delete();

        return redirect()->route('events.index')->with('success','Event deleted successfully');
    }

    public function welcome()
    {
        // Mengambil event dengan status 'upcoming'
        $upcomingEvents = Event::where('status', 'upcoming')->get();
        
        // Mengambil event dengan status 'ongoing'
        $ongoingEvents = Event::where('status', 'ongoing')
            ->where('start_event_at', '<=', now())
            ->where('end_event_at', '>=', now())
            ->get();
        
        // Mengambil event dengan status 'open'
        $openEvents = Event::where('status', 'open')->get(); // Event dengan status open
        
        return view('welcome', compact('upcomingEvents', 'ongoingEvents', 'openEvents'));
    }
    
    

        

}
