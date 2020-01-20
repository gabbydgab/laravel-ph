<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::latest('started_at')->paginate();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function create()
    {
        $this->authorize(Event::class);

        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->authorize(Event::class);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'cover' => ['nullable', 'string', 'url'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['required', 'date', 'after:started_at'],
            'location' => ['required', 'string', 'max:255'],
            'host' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'string', 'url'],
            'registration_url' => ['nullable', 'string', 'url'],
        ]);

        Event::create($attributes);

        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        $this->authorize($event);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize($event);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'cover' => ['nullable', 'string', 'url'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['required', 'date', 'after:started_at'],
            'location' => ['required', 'string', 'max:255'],
            'host' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'string', 'url'],
            'registration_url' => ['nullable', 'string', 'url'],
        ]);

        $event->update($attributes);

        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $this->authorize($event);

        $event->delete();
    }
}
