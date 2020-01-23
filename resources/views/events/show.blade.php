@extends('layouts.app')

@push('metas')
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:url"content="{{ url()->current() }}" />
<meta property="og:title" content="{{ $event->name }}" />
<meta property="og:description" content="{{ Str::limit(strip_tags($event->body), 100) }}" />
<meta property="og:image" content="{{ $event->cover }}" />
<meta property="og:type" content="event" />
<meta property="og:locale" content="en-us" />
@endpush

@section('content')
<div class="bg-white shadow py-10">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="font-medium text-3xl tracking-tight leading-none">{{ $event->name }}</h1>
        <h3 class="mt-2"><span class="text-gray-600">Hosted by</span> <span class="text-gray-700">{{ $event->host }}</span></h3>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4">
    <div class="flex flex-wrap justify-center -mx-4">
        <div class="order-last lg:order-first  w-full max-w-lg lg:max-w-full lg:w-3/5 px-4">
            <img class="w-full h-64 object-cover rounded-lg shadow mt-6" src="{{ $event->cover }}" alt="">
            <h6 class="font-medium text-gray-800 leading-none tracking-tight text-xl mt-6">Description</h6>
            <div class="markdown mt-6">
                {!! $event->body !!}
            </div>
        </div>
        <div class="order-first lg:order-last w-full max-w-lg lg:max-w-full lg:w-2/5 px-4">
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <div class="flex items-start">
                    <svg class="flex-shrink-0 w-6 h-6 fill-current text-gray-500" viewBox="0 0 24 24">
                        <path d="M12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5M12,2A7,7 0 0,1 19,9C19,14.25 12,22 12,22C12,22 5,14.25 5,9A7,7 0 0,1 12,2M12,4A5,5 0 0,0 7,9C7,10 7,12 12,18.71C17,12 17,10 17,9A5,5 0 0,0 12,4Z" />
                    </svg>
                    <div class="flex-1 ml-4 leading-relaxed whitespace-pre-line">{{ $event->address }}</div>
                </div>

                <div class="flex items-start mt-6">
                    <svg class="flex-shrink-0 w-6 h-6 fill-current text-gray-500" viewBox="0 0 24 24">
                        <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" />
                    </svg>
                    <div class="flex-1 ml-4">
                        <div>{{ $event->started_at->setTimezone($event->timezone)->format('M d, Y h:i A') }}</div>
                        <div>{{ $event->ended_at->setTimezone($event->timezone)->format('M d, Y h:i A') }}</div>
                    </div>
                </div>

                @if($event->website_url)
                <div class="flex items-start mt-6">
                    <svg class="flex-shrink-0 w-6 h-6 fill-current text-gray-500" viewBox="0 0 24 24">
                        <path d="M16.36,14C16.44,13.34 16.5,12.68 16.5,12C16.5,11.32 16.44,10.66 16.36,10H19.74C19.9,10.64 20,11.31 20,12C20,12.69 19.9,13.36 19.74,14M14.59,19.56C15.19,18.45 15.65,17.25 15.97,16H18.92C17.96,17.65 16.43,18.93 14.59,19.56M14.34,14H9.66C9.56,13.34 9.5,12.68 9.5,12C9.5,11.32 9.56,10.65 9.66,10H14.34C14.43,10.65 14.5,11.32 14.5,12C14.5,12.68 14.43,13.34 14.34,14M12,19.96C11.17,18.76 10.5,17.43 10.09,16H13.91C13.5,17.43 12.83,18.76 12,19.96M8,8H5.08C6.03,6.34 7.57,5.06 9.4,4.44C8.8,5.55 8.35,6.75 8,8M5.08,16H8C8.35,17.25 8.8,18.45 9.4,19.56C7.57,18.93 6.03,17.65 5.08,16M4.26,14C4.1,13.36 4,12.69 4,12C4,11.31 4.1,10.64 4.26,10H7.64C7.56,10.66 7.5,11.32 7.5,12C7.5,12.68 7.56,13.34 7.64,14M12,4.03C12.83,5.23 13.5,6.57 13.91,8H10.09C10.5,6.57 11.17,5.23 12,4.03M18.92,8H15.97C15.65,6.75 15.19,5.55 14.59,4.44C16.43,5.07 17.96,6.34 18.92,8M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                    </svg>
                    <div class="flex-1 ml-4">
                        <a href="{{ $event->website_url }}" target="_blank">
                            <h6 class="underline text-gray-900">{{ $event->website_url }}</h6>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            @if($event->google_map_embed)
            <div class="shadow rounded-lg overflow-hidden mt-6">
                {!! $event->google_map_embed !!}
            </div>
            @endif

            @if($event->registration_url)
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <h6 class="text-gray-700 leading-none">Event registration is available!</h6>
                <a href="{{ $event->registration_url }}" target="_blank">
                    <h6 class="mt-4 font-mono px-4 py-5 bg-gray-200 rounded truncate">{{ $event->registration_url }}</h6>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
