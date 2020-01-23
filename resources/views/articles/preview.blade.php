<div class="bg-white rounded-lg shadow p-6 mt-4">
    <a href="{{ route('articles.show', $article) }}">
        <h6 class="text-lg text-gray-800 font-medium leading-none">
            {{ $article->title }}
        </h6>
    </a>
    <div class="markdown mt-4">
        {!! $article->excerpt !!}
        <a href="{{ route('articles.show', $article) }}" class="underline text-gray-800">See More</a>
    </div>
    <div class="mt-4">
        <span class="text-gray-700">{{ $article->author->name }}</span>
        <span class="text-gray-500 mx-2">•</span>
        <span class="text-gray-700">{{ $article->published_at->diffForHumans() }}</span>
        <span class="text-gray-500 mx-2">•</span>
        <span class="text-gray-700">@include('articles.likes-count')</span>
    </div>
</div>
