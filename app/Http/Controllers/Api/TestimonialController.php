<?php

namespace App\Http\Controllers\Api;


use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\News;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends ApiBaseController
{
    public function index()
    {
        $testimonials = Testimonial::query()->orderBy('id', 'desc')
            ->get();
        return $this->showAll(collect($testimonials));
    }
    public function courseTestimonial()
    {
        $testimonials = Testimonial::query()->where(['category'=>'courses'])->orderBy('id', 'desc')
            ->get();
        return $this->showAll(collect($testimonials));
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

    }
}
