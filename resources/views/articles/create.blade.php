@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <h1 class="text-lg font-semibold text-gray-700 tracking-tight pb-2 border-b mb-8">Create New Article</h1>
    <form action="{{ route('articles.store') }}" method="POST" autocomplete="off">
        @csrf
        @include('articles.form', [
            'article' => new App\Article,
            'buttonText' => 'Create Article'
        ])
    </form>
</div>
@endsection
