@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">
    @foreach($events as $event)
        <div class="bg-white rounded-lg shadow p-6 mt-4">
            <a href="{{ route('events.show', $event) }}">
                <h6 class="font-medium text-gray-800 text-lg leading-none">{{ $event->name }}</h6>
            </a>
            <div class="mt-2">
                <div>
                    <span class="text-gray-600">Host:</span>
                    <span class="text-gray-700">{{ $event->host }}</span>
                </div>
                <div>
                    <span class="text-gray-600">When:</span>
                    <span class="text-gray-700" v-cloak>
                        <local-time value="{{ $event->started_at->toIsoString() }}" format="MMM DD, YYYY, hh:mm A" />
                    </span>
                </div>
                <div>
                    <span class="text-gray-600">Where:</span>
                    <span class="text-gray-700">{{ $event->location }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
