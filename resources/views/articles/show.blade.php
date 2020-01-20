@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4">

    <div class="flex items-end justify-between mt-6">
        <div class="flex items-center">
            <img class="rounded-full h-10 w-10 object-cover border-2" src="{{ $article->author->avatar }}" alt="{{ $article->author->name }} avatar">
            <div class="ml-4 leading-tight">
                {{ $article->author->name }}
                <div class="text-gray-600">{{ optional($article->published_at)->diffForHumans() }}</div>
            </div>
        </div>

        <div>
            <form action="{{ route('articles.show', $article) . '/likes' }}" method="POST">
                @csrf
                <div class="flex items-center">
                    <div class="text-gray-600 font-medium mr-2">{{ $article->likes_count }}</div>
                    @if($article->isLiked(auth()->user()))
                        @method("DELETE")
                        <button class="focus:outline-none text-red-600">
                            <svg class="fill-current w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                            </svg>
                        </button>
                    @else
                        <button class="focus:outline-none text-gray-600">
                            <svg class="fill-current w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                            </svg>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if($article->cover)
        <img class="w-full rounded-lg mt-6 shadow-md" src="{{ $article->cover }}" alt="{{ $article->title }}">
    @endif

    <h1 class="text-3xl font-semibold leading-none tracking-tight mt-6">{{ $article->title }}</h1>

    @if($article->tags->count())
        <div class="flex flex-wrap mt-6">
            @foreach($article->tags as $tag)
            <span class="px-2 py-1 rounded bg-gray-300 text-sm text-gray-700 font-medium tracking-wider mr-2 mb-2">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif

    @if($article->body)
        <div class="text-gray-700 leading-loose mt-6">
            {{ $article->body }}
        </div>
    @endif

    <div class="border-t flex justify-between mt-6 py-6">
        <div class="w-48 overflow-hidden">
            @if($previousRecord = $article->previousRecord())
            <a href="{{ route('articles.show', $previousRecord) }}">
                <div class="text-gray-600">Previous</div>
                <h6 class="truncate">{{ $previousRecord->title }}</h6>
            </a>
            @endif
        </div>

        <div class="w-48 text-right overflow-hidden">
            @if($nextRecord = $article->nextRecord())
            <a href="{{ route('articles.show', $nextRecord) }}">
                <div class="text-gray-600">Next</div>
                <h6 class="truncate">{{ $nextRecord->title }}</h6>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
