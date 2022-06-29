<?php

namespace App\Http\Controllers;

use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\LandingPage;
use App\Models\LandingPageExplore;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = LandingPage::with(['explore'])->get();
        dd($data, json_decode($data));
    }

    public function updateOne(Request $request)
    {
        $landing = LandingPage::first();
        $data = $request->all();
        unset($data['_token']);
        $landing->message = json_encode($data);
        $landing->save();
        return redirect()->route('home-page');
    }

    public function toggleDisplayExploreMore($id)
    {
        $explore = LandingPageExplore::findOrFail($id);
        if ($explore->status == 1)
            $explore->status = 0;
        elseif ($explore->status == 0)
            $explore->status = 1;
        $explore->save();
        return redirect()->route('home-page');
    }

    public function createExploreMore()
    {
        return view('includes.pages.add-explore-more');
    }

    public function storeExploreMore(Request $request)
    {
        $request->validate([
            'section' => ['required'],
            'receipt' => ['required'],
            'status' => ['required'],
        ]);
        $last_id = LandingPageExplore::orderBy('id','desc')->select('id')->first();

        LandingPageExplore::create([
            'landing_id' => 1,
            'section' => $request->get('section'),
            'receipt' => $request->get('receipt'),
            'link' => $request->get('link'),
            'status' => $request->get('status'),
            'position' => (int)$last_id->id + 1,
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('', 'images')
                : null
        ]);


        return redirect()->route('home-page');
    }

    public function editExploreMore($id)
    {
        $link = LandingPageExplore::findOrFail($id);
        return view('includes.pages.edit-explore-more')->with([
            'page' => $link
        ]);
    }

    public function updateExploreMore(Request $request)
    {
        $id = $request->page_id;
        $link = LandingPageExplore::find($id);
        request()->request->remove('page_id');

        if ($request->hasFile('image')) {
            $link->image = $request->file('image')->store('', 'images');
        }

        $link->section = $request->section;
        $link->receipt = $request->receipt;
        $link->link = $request->link;
        $link->status = $request->status;

        $link->save();
        return redirect()->route('home-page');
    }

    public function deleteExploreMore($id)
    {
        $explore = LandingPageExplore::findOrFail($id);
        $explore->delete();

        return redirect()->route('home-page');
    }

    public function createNewsArticle()
    {
        return view('includes.pages.add-news-article');
    }

    public function storeNewsArticle(Request $request)
    {
        $request->validate([
            'header' => ['required'],
            'date' => ['required'],
            'ceremony' => ['required'],
        ]);
        $last_id = EventContent::orderBy('id','desc')->select('id')->first();

        EventContent::create([
            'header' => $request->get('header'),
            'date' => $request->get('date'),
            'ceremony' => $request->get('ceremony'),
            'status' => $request->get('status'),
            'position' => (int)$last_id->id + 1,
            'holder' => $request->hasFile('holder')
                ? $request->file('holder')->store('', 'images')
                : null
        ]);

        return redirect()->route('home-page');
    }

    public function toggleDisplayNewsArticle($id)
    {
        $news = EventContent::findOrFail($id);
        if ($news->status == 1)
            $news->status = 0;
        elseif ($news->status == 0)
            $news->status = 1;
        $news->save();
        return redirect()->route('home-page');
    }

    public function editNewsArticle($id)
    {
        $link = EventContent::findOrFail($id);
        return view('includes.pages.edit-news-article')->with([
            'page' => $link
        ]);
    }

    public function updateNewsArticle(Request $request)
    {
        $id = $request->page_id;
        $link = EventContent::find($id);
        request()->request->remove('page_id');

        if ($request->hasFile('holder')) {
            $link->holder = $request->file('holder')->store('', 'images');
        }

        $link->header = $request->header;
        $link->date = $request->date;
        $link->ceremony = $request->ceremony;
        $link->position = $request->position;
        $link->status = $request->status;

        $link->save();
        return redirect()->route('news');
    }

    public function deleteNewsArticle($id)
    {
        $explore = EventContent::findOrFail($id);
        $explore->delete();
        return redirect()->route('news');
    }

    public function createUpcomingEvent()
    {
        return view('includes.pages.add-upcoming-event');
    }

    public function storeUpcomingEvent(Request $request)
    {
        $request->validate([
            'date' => ['required'],
            'ceremony' => ['required'],
        ]);
        $last_id = EventDate::orderBy('id','desc')->select('id')->first();

        EventDate::create([
            'date' => $request->get('date'),
            'ceremony' => $request->get('ceremony'),
            'status' => $request->get('status'),
            'position' => (int)$last_id->id + 1,
        ]);

        return redirect()->route('home-page');
    }


    public function toggleDisplayUpcomingEvent($id)
    {
        $event = EventDate::findOrFail($id);
        if ($event->status == 1)
            $event->status = 0;
        elseif ($event->status == 0)
            $event->status = 1;
        $event->save();
        return redirect()->route('home-page');
    }


    public function editUpcomingEvent($id)
    {
        $link = EventDate::findOrFail($id);
        return view('includes.pages.edit-upcoming-event')->with([
            'page' => $link
        ]);
    }

    public function updateUpcomingEvent(Request $request)
    {
        $id = $request->page_id;
        $link = EventDate::find($id);
        request()->request->remove('page_id');

        $link->date = $request->date;
        $link->ceremony = $request->ceremony;
        $link->position = $request->position;
        $link->status = $request->status;

        $link->save();
        return redirect()->route('home-page');
    }


    public function deleteUpcomingEvent($id)
    {
        $event = EventDate::findOrFail($id);
        $event->delete();
        return redirect()->route('home-page');
    }

}
