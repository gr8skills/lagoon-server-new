<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\LandingPage;
use App\Models\MainMenu;
use App\Models\SiteSetting;
use App\Models\SplashPhoto;
use App\Models\Sponsor;
use App\Models\UsefulLinks;

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
        $menu = SplashPhoto::orderBy('id', 'asc')->get();
        return response()->json(
           $menu, 200
        );
    }

    public function landingData()
    {
        $data = LandingPage::with(['explore'])->get();
        $explore = collect($data)->toArray();
        $explore = $explore[0]['explore'];
        $data = [
            'messages'=> json_decode($data[0]->message),
            'mission'=> json_decode($data[0]->mission),
            'explore'=> $explore,
        ];
        return response()->json(
            $data, 200
        );
    }

    public function newsArticles()
    {
        $news = EventContent::where(['status'=>1])->orderBy('id', 'desc')->limit(2)->get();
        $events = EventDate::where(['status'=>1])->orderBy('id', 'desc')->limit(3)->get();
        $data = [
            'news'=>$news,
            'events'=>$events,
        ];
        return response()->json(
            $data
        );
    }


}
