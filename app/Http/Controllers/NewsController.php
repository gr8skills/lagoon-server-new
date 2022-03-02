<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index')->with([
            'news' => $news
        ]);
    }

    public function create()
    {
        return view('news.add-news');
    }

    public function edit($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('news.edit-news')->with(['news' => $news]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        $data = $request->all();
        $data['slug'] = Str::of($request->get('title'))->slug('-');
        if ($request->hasFile('thumb')) {
            $data['thumb'] = $request->file('thumb')->store('', 'images');
        }

        News::create($data);
        return redirect()->route('news');
    }

    public function update(Request $request, $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        foreach ($request->all() as $key => $param) {
            if (!!$param && $key !== '_token') {
                $news->{$key} = $param;
            }
        }
        $news->save();
        return redirect()->route('news');
    }

    public function destroy($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();
        return redirect()->route('news');
    }
}
