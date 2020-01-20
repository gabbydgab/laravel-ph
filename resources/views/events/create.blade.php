@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <h1 class="text-lg font-semibold text-gray-700 tracking-tight pb-2 border-b mb-8">Create New Event</h1>
    <form action="{{ route('events.store') }}" method="POST" autocomplete="off">
        @csrf
        @include('events.form', [
            'event' => new App\Event,
            'buttonText' => 'Create Event'
        ])
    </form>
</div>
@endsection
