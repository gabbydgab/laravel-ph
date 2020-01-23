<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        $event = Event::create($this->validateRequest($request));

        return redirect()->route('events.show', $event);
    }

    public function edit(Event $event)
    {
        $this->authorize($event);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize($event);

        $event->update($this->validateRequest($request));

        return redirect()->route('events.show', $event);
    }

    public function destroy(Event $event)
    {
        $this->authorize($event);

        $event->delete();
    }

    public function validateRequest($request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'cover' => ['required', 'string', 'url'],
            'host' => ['required', 'string', 'max:255'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['required', 'date', 'after:started_at'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'timezone' => ['required', 'string', 'timezone'],
            'google_map_embed' => ['nullable', 'string'],
            'website_url' => ['nullable', 'string', 'url'],
            'registration_url' => ['nullable', 'string', 'url'],
        ]);
    }
}
