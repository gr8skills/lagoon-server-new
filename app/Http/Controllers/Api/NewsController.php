<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends ApiBaseController
{
    public function index()
    {
        $news = News::latest()->get();
        return $this->showAll($news);
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();

        if (!$news) {
            return $this->errorResponse('News not found', 404);
        }

        return $this->showOne($news);
    }

    public function recentNews()
    {
        $news = News::orderBy('created_at', 'DESC')->get()->take(5);
        return $this->showAll($news);
=======
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return response()->json($news, 200);
    }


    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return response()->json($news);
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
    }
}
