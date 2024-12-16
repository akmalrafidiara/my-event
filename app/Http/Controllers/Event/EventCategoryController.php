<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCategoryCreateRequest;
use App\Models\Event\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = EventCategory::all();
        return view("event-categories.index", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventCategoryCreateRequest $request)
    {
        EventCategory::create($request->all());

        return redirect()->route("categories.index")->with("success","Event category created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = EventCategory::findOrFail($id);

        return view("event-categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventCategoryCreateRequest $request, string $id)
    {
        $eventCategory = EventCategory::findOrFail($id);

        $eventCategory->update($request->all());

        return redirect()->route("categories.index")->with("success","Event category updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventCategory = EventCategory::findOrFail($id);

        $eventCategory->delete();

        return redirect()->route("categories.index")->with("success","Event category deleted successfully");
    }
}