<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return view('articles.index')->with([
            'articles' => $articles
        ]);
    }

    public function createArticle()
    {
        return view('articles.create-article');
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:10'],
            'content' => ['required']
        ]);

        $data = $request->only(['title', 'content']);
        $data['ref_id'] = Article::generateRefId();
        Article::create($data);

        return redirect()->route('article');
    }

    public function editArticle($refId)
    {
        $article = Article::where('ref_id', $refId)->firstOrFail();

        return view('articles.edit-article')->with([
            'article' => $article
        ]);
    }

    public function updateArticle(Request $request, $refId)
    {
        $article = Article::where('ref_id', $refId)->firstOrFail();

        $article->fill($request->all());
        $article->save();

        return redirect()->route('article');
    }

    public function deleteArticle($refId)
    {
        $article = Article::where('ref_id', $refId)->firstOrFail();

        $article->delete();

        return redirect()->route('article');
    }
}
