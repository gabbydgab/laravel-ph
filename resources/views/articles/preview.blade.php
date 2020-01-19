<div class="bg-white rounded-lg shadow p-6 mt-4">
    <a href="{{ route('articles.show', $article) }}" class="text-lg leading-none">
        <h6>{{ $article->title }}</h6>
    </a>
    <div class="mt-2">
        <span class="text-gray-700">{{ $article->author->name }}</span>
        <span class="text-gray-500 mx-2">•</span>
        <span class="text-gray-700">{{ $article->published_at->diffForHumans() }}</span>
    </div>
</div>
