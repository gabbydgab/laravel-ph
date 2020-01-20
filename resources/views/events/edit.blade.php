@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <h1 class="text-lg font-semibold text-gray-700 tracking-tight pb-2 border-b mb-8">Edit Event</h1>
    <form action="{{ route('events.update', $event) }}" method="POST" autocomplete="off">
        @csrf
        @method("PATCH")
        @include('events.form', [
            'buttonText' => 'Update Event'
        ])
    </form>
</div>
@endsection
