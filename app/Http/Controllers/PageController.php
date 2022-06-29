<?php

namespace App\Http\Controllers;

use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\LandingPage;
use App\Models\MainMenu;
use App\Models\Mission;
use App\Models\Page;
use App\Models\SlideImage;
use App\Models\SplashPhoto;
use App\Models\StudentSlide;
use App\Models\StudentSlideMessage;
use App\Models\SubMenu;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use PHPUnit\Util\Test;

class PageController extends Controller
{
    // About Pages
    public function about()
    {
        $pages = Page::where('page_category_id', 1)->with('category')->get();

        return view('pages.about')->with([
            'pages' => $pages
        ]);
    }

    // Academics
    public function academics()
    {
        $pages = Page::where('page_category_id', 2)->with('category')->get();

        return view('pages.academics')->with([
            'pages' => $pages
        ]);
    }

    // Admission
    public function admission()
    {
        $pages = Page::where('page_category_id', 3)->with('category')->get();

        return view('pages.admission')->with([
            'pages' => $pages
        ]);
    }

    // Landing Page
    public function homepage()
    {
        $slideImages = SlideImage::all();
        $data = LandingPage::with(['explore'])->get();
        $explore = collect($data)->toArray();
        $explore = $explore[0]['explore'];
        $news = EventContent::orderBy('id', 'desc')->get();
        $event_dates = EventDate::orderBy('id', 'desc')->get();
        $mission=Mission::all();
//        dd($mission);
        return view('pages.home-page')->with([
            'slideImages' => $slideImages,
            'message' => json_decode($data[0]->message),
            'mission' => $mission,
            'explore' => $explore,
            'news' => $news,
            'event_dates' => $event_dates,
        ]);
    }
    // Photo Splash
    public function photoSplash()
    {
        $splashImages = SplashPhoto::all();

        return view('pages.photo-splash')->with([
            'splashImages' => $splashImages
        ]);
    }
    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('pages.testimonials')->with([
            'testimonials' => $testimonials,
        ]);
    }

    // Media
    public function media()
    {
        $pages = Page::where('page_category_id', 4)->with('category')->get();

        return view('pages.media')->with([
            'pages' => $pages
        ]);
    }

    // Facilities
    public function facilities()
    {
        $pages = Page::where('page_category_id', 5)->with('category')->get();

        return view('pages.parents')->with([
            'pages' => $pages
        ]);
    }


    public function editPage($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.edit-page')->with([
            'page' => $page
        ]);
    }

    public function updatePage(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $data = $request->only(['content', 'banner', 'footerImage', 'title']);

        if ($request->banner) {
            $data['banner'] = $request->banner->store('', 'public');
        }

        if ($request->footerImage) {
            $data['footer_image'] = $request->footerImage->store('', 'images');
        }

        if (!$data['title']) {
            unset($data['title']);
        }

        unset($request);

        $page->fill($data);
        $page->save();

        $redirectPath = str_replace(' ', '-', $page->category->name);
        return redirect('/pages/' . $redirectPath)->with(['message' => 'Page updated successfully', 'type' => 'success']);
    }

    //    public function deletePage($slug)
    //    {
    //        $page = Page::where('slug', $slug)->firstOrFail();
    //        $page->delete();
    //
    //        $redirectPath = str_replace(' ', '-', $page->category->name);
    //        return redirect('/pages/' . $redirectPath);
    //    }


    // Menu & Submenu
    public function menu($menu_id=null)
    {
        $menus = MainMenu::with(['submenu'])->orderBy('position','asc')->get();
        $submenus = SubMenu::orderBy('id','asc')->get();
//        dump($submenus);
        return view('menu-submenu')->with([
            'menus' => $menus,
            'submenus'=>$submenus
        ]);
    }

}
