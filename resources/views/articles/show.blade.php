@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4">
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

    <div class="flex items-end justify-between mt-4">
        <div class="flex items-center mt-6">
            <img class="rounded-full h-16 w-16 object-cover border-2" src="{{ $article->author->avatar }}" alt="{{ $article->author->name }} avatar">
            <div class="ml-4">
                {{ $article->author->name }}
                <div class="text-gray-600 text-sm">{{ $article->author->bio }}</div>
                @if ($article->published_at)
                <div class="text-gray-600 text-sm">{{ $article->published_at->diffForHumans() }}</div>
                @else
                <div class="mt-2">
                    <span class="px-2 py-1 rounded text-sm font-semibold uppercase bg-gray-200 text-gray-500">Unpublished</span>
                </div>
                @endif
            </div>
        </div>

        @can('update', $article)
        <div>
            <a href="{{ route('articles.edit', $article) }}" class="inline-block px-3 py-2 border-2 rounded font-medium text-gray-700 focus:outline-none">Edit</a>
        </div>
        @endcan
    </div>

    <div class="border-t flex justify-between mt-6 py-6">
        <div class="w-48 overflow-hidden">
            @if($previousArticle = $article->previousArticle())
            <a href="{{ route('articles.show', $previousArticle) }}">
                <div class="text-gray-600">Previous</div>
                <h6 class="truncate">{{ $previousArticle->title }}</h6>
            </a>
            @endif
        </div>

        <div class="w-48 text-right overflow-hidden">
            @if($nextArticle = $article->nextArticle())
            <a href="{{ route('articles.show', $nextArticle) }}">
                <div class="text-gray-600">Next</div>
                <h6 class="truncate">{{ $nextArticle->title }}</h6>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
