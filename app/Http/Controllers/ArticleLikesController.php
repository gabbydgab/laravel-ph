<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleLikesController extends Controller
{
    /**
     * Create new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Like an article.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Article $article)
    {
        $article->like(auth()->user());

        return redirect()->route('articles.show', $article);
    }

    /**
     * Unlike an article.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->unlike(auth()->user());

        return redirect()->route('articles.show', $article);
    }
}
