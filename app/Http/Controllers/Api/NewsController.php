<?php

namespace App\Http\Controllers\Api;


use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\News;
use App\Models\PartnershipWithParentQuestionAnswer;
use Illuminate\Http\Request;

class NewsController extends ApiBaseController
{
    public function index()
    {
        $news = EventDate::where(['status'=>1])->orderBy('id', 'desc')
            ->get();
        $notes=$this->getContent('academic-calendar',['banner','other_images_1','other_images_2']);
        $data=['events'=>$news,'notes'=>$notes];
        return $this->showAll(collect($data));
    }

    public function show($slug)
    {
        $news =EventContent::query()->where('slug', $slug)->first();

        if (!$news) {
            return $this->errorResponse('News not found', 404);
        }

        return $this->showOne($news);
    }
    public function listRelatedNews($slug)
    {
        $news =EventContent::query()
            ->where('slug','<>', $slug)
            ->orderBy('updated_at', 'DESC')->get(['id','slug','holder','header','ceremony'])->take(15);
        return $this->showAll($news);
    }

    public function recentNews()
    {
        $news = EventContent::orderBy('created_at', 'DESC')->get()->take(5);
        return $this->showAll($news);

    }

    public function questionAndAnswer()
    {
        $menu = PartnershipWithParentQuestionAnswer::where(['status'=>1])->orderBy('position', 'asc')->get();
        return response()->json(
            $menu, 200
        );
    }
}
