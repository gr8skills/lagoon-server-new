<?php

namespace App\Http\Controllers;

use App\Models\EventContent;
use App\Models\News;
use App\Models\PartnershipWithParentQuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
//        $news = News::all();
        $news = EventContent::orderBy('position', 'asc')->get();
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
        $data['ref_id'] = News::generateRefId();
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

    // Q/As
    public function indexQA()
    {
        $news = PartnershipWithParentQuestionAnswer::orderBy('position', 'asc')->get();
        return view('pages.questions-answers')->with([
            'news' => $news
        ]);
    }

    public function createQuestionAnswer()
    {
        return view('pages.create-questions-answers');
    }

    public function storeQA(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);
        $count = PartnershipWithParentQuestionAnswer::count();

        $data = $request->all();
        $data['position'] = $count+1;

        PartnershipWithParentQuestionAnswer::create($data);
        return redirect()->route('questions-answer');
    }

    public function toggleDisplayQA($id)
    {
        $qa = PartnershipWithParentQuestionAnswer::findOrFail($id);
        if ($qa->status == 1)
            $qa->status = 0;
        elseif ($qa->status == 0)
            $qa->status = 1;
        $qa->save();
        return redirect()->route('questions-answer');
    }

    public function editQA($id)
    {
        $link = PartnershipWithParentQuestionAnswer::findOrFail($id);
        return view('pages.edit-questions-answers')->with([
            'page' => $link
        ]);
    }

    public function updateQA(Request $request)
    {
        $id = $request->page_id;
        $link = PartnershipWithParentQuestionAnswer::find($id);
        request()->request->remove('page_id');

        $link->title = $request->title;
        $link->content = $request->content;
        $link->position = $request->position;
        $link->status = $request->status;

        $link->save();
        return redirect()->route('questions-answer');
    }

    public function deleteQA($id)
    {
        $qa = PartnershipWithParentQuestionAnswer::findOrFail($id);
        $qa->delete();
        return redirect()->route('questions-answer');
    }
}
