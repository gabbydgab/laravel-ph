@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">
    @foreach($articles as $article)
        @include('articles.preview')
    @endforeach
</div>
@endsection
