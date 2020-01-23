<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * View all articles.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::visible()
            ->latest('published_at')
            ->paginate();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the create article page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Article::class);

        return view('articles.create');
    }

    /**
     * Store an article.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(Article::class);

        $attributes = $this->validateRequest($request);

        $attributes['author_id'] = auth()->id();

        $article = Article::create($attributes);

        $article->syncTags(request('tags'));

        return redirect()->route('articles.index');
    }

    /**
     * View an article.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        abort_if(Gate::inspect('view', $article)->denied(), 404);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the edit article page.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize($article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update an article.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize($article);

        $attributes = $this->validateRequest($request);

        $article->update($attributes);

        $article->syncTags(request('tags'));

        return redirect()->route('articles.index');
    }

    /**
     * Delete an article.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize($article);

        $article->delete();

        return $article;
    }

    /**
     * Validate the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function validateRequest($request)
    {
        return Arr::except($request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'cover' => ['nullable', 'string', 'url'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['required', 'string', 'max:20']
        ]), ['tags']);
    }
}
