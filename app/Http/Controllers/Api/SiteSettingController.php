<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\LandingPage;
use App\Models\MainMenu;
use App\Models\Mission;
use App\Models\SiteSetting;
use App\Models\SplashPhoto;
use App\Models\Sponsor;
use App\Models\Testimonial;
use App\Models\UsefulLinks;
use Carbon\Carbon;

class SiteSettingController extends Controller
{
    public function index()
    {
        return response()->json(
            SiteSetting::firstOrCreate(),
            200
        );
    }

    public function sponsors()
    {
        return response()->json(
            Sponsor::all(),
            200
        );
    }

    public function menus()
    {
        $menu = MainMenu::with('submenu')->orderBy('position', 'asc')->get();
        return response()->json(
           $menu, 200
        );
    }

    public function usefulLinks()
    {
        $menu = UsefulLinks::orderBy('id', 'asc')->get();
        return response()->json(
           $menu, 200
        );
    }

    public function splashPhoto()
    {
        $menu = SplashPhoto::query()->where(['category'=>'photo_splash'])->orderBy('position', 'asc')->get();
        return response()->json(
           $menu, 200
        );
    }
    public function facilityIndex()
    {
        $images = SplashPhoto::query()->where(['category'=>'facility'])->get(['id','title','image_path']);
        $note=$this->getContent('academic-facilities',['id','content','banner']);
        return $this->getResponse(['note'=>$note,'images'=>$images]);
    }
    public function primaryIndex()
    {
        $images = SplashPhoto::query()->where(['category'=>'primary'])->get(['id','title','image_path']);
        $note=$this->getContent('primary-school',['id','content','banner','other_images_1','other_titles_1']);
        return $this->getResponse(['note'=>$note,'images'=>$images]);
    }
    public function secondaryIndex()
    {
        $images = SplashPhoto::query()->where(['category'=>'secondary'])->get(['id','title','image_path']);
        $note=$this->getContent('secondary-school',['id','content','banner','other_images_1','other_images_2','other_images_3','other_images_4','other_titles_1','other_titles_4']);
        return $this->getResponse(['note'=>$note,'images'=>$images]);
    }
    public function coursesIndex()
    {
        $testimonials = Testimonial::query()->inRandomOrder()->limit(2)->get(['id','commentor','paragraph']);
        $note=$this->getContent('courses',['id','content','banner']);
        return $this->getResponse(['note'=>$note,'testimonials'=>$testimonials]);
    }

    public function mentorsIndex()
    {
        $testimonials = Testimonial::query()->inRandomOrder()->first(['id','commentor','paragraph']);
        $images = SplashPhoto::query()->where(['category'=>'mentoring'])->get(['id','title','image_path']);
        return $this->getResponse(['images'=>$images,'testimonials'=>$testimonials]);
    }


    public function landingData()
    {
        $data = LandingPage::with(['explore'])->get();
        $explore = collect($data)->toArray();
        $explore = $explore[0]['explore'];
        $mission=Mission::all();
        $data = [
            'messages'=> json_decode($data[0]->message),
            'mission'=> $mission,
            'explore'=> $explore,
        ];
        return response()->json(
            $data, 200
        );
    }

    public function newsArticles()
    {
        $news =[];
        EventContent::where(['status'=>1])->orderBy('id', 'desc')->limit(2)
            ->get()
        ->mapToGroups(function ($evntC)use(&$news){
            try {
                $dt=Carbon::parse($evntC->date)->format('d/m/Y');
                $evntC->date=$dt;
                $news[]=$evntC;
            }
            catch (\Exception $exception){
                $news[]=$evntC;
            }
            return [];
        });
        $events = [];
        EventDate::where(['status'=>1])->orderBy('id', 'desc')->limit(3)
            ->get()
        ->mapToGroups(function ($evnt)use(&$events){
            try {
                $dt=Carbon::parse($evnt->date)->format('M d');
                $evnt->date=$dt;
                $events[]=$evnt;
            }
            catch (\Exception $exception){
                $events[]=$evnt;
            }
            return [];
        });
        $data = [
            'news'=>$news,
            'events'=>$events,
        ];
        return response()->json(
            $data
        );
    }
    public function fullCalendar()
    {
        $news =[];
        EventContent::where(['status'=>1])->orderBy('id', 'desc')->limit(2)
            ->get()
        ->mapToGroups(function ($evntC)use(&$news){
            try {
                $dt=Carbon::parse($evntC->date)->format('d/m/Y');
                $evntC->date=$dt;
                $news[]=$evntC;
            }
            catch (\Exception $exception){
                $news[]=$evntC;
            }
            return [];
        });
        $events = [];
        EventDate::where(['status'=>1])->orderBy('id', 'desc')->limit(3)
            ->get()
        ->mapToGroups(function ($evnt)use(&$events){
            try {
                $dt=Carbon::parse($evnt->date)->format('M d');
                $evnt->date=$dt;
                $events[]=$evnt;
            }
            catch (\Exception $exception){
                $events[]=$evnt;
            }
            return [];
        });
        $data = [
            'news'=>$news,
            'events'=>$events,
        ];
        return response()->json(
            $data
        );
    }


    public function traditionIndex()
    {
        $images = SplashPhoto::query()->where(['category'=>'traditions'])->get(['id','title','image_path']);
        $note=$this->getContent('lagoon-traditions',['id','content','banner']);
        return $this->getResponse(['note'=>$note,'images'=>$images]);
    }


}
