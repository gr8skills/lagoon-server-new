<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\SiteSetting;
use App\Models\Sponsor;
use App\Models\UsefulLinks;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::firstOrCreate([]);
        $sponsors = Sponsor::all();
        $links = UsefulLinks::all();
        return view('site-setting.index')
            ->with([
                'setting' => $siteSettings,
                'sponsors' => $sponsors,
                'links' => $links
            ]);
    }

    public function createSponsor()
    {
        return view('site-setting.add-sponsor');
    }

    public function storeSponsor(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        Sponsor::create([
            'name' => $request->get('name'),
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('', 'images')
                : null
        ]);

        return redirect()->route('site-setting');
    }

    public function editSponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('site-setting.edit-sponsor')->with([
            'sponsor' => $sponsor
        ]);
    }

    public function updateSponsor(Request $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);

        $data = [];
        foreach ($request->all() as $key => $val) {
            if (!!$val) {
                $data[$key] = $val;
            }
        }
        $sponsor->fill($data);
        $sponsor->save();
        return redirect()->route('site-setting');
    }

    public function deleteSponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->delete();

        return redirect()->route('site-setting');
    }

    public function createULink()
    {
        return view('site-setting.add-useful-link');
    }
    public function storeULink(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'link' => ['required'],
            'target' => ['required'],
        ]);
        $slug = strtolower(str_replace(" ","",$request->get('title')));

        UsefulLinks::create([
            'title' => $request->get('title'),
            'url' => $request->get('link'),
            'target' => $request->get('target'),
            'slug' => $slug,
            'description' => $request->get('title'),

//            'image' => $request->hasFile('image')
//                ? $request->file('image')->store('', 'images')
//                : null
        ]);


        return redirect()->route('site-setting');
    }

    public function editULink($id)
    {
        $link = UsefulLinks::findOrFail($id);
//        $link = UsefulLinks::where(['slug'=>$slug])->first();
        return view('site-setting.edit-useful-link')->with([
            'page' => $link
        ]);
    }

    public function updateULink(Request $request)
    {
        $id = $request->page_id;
        $link = UsefulLinks::find($id);
        request()->request->remove('page_id');
        $data = [];
        foreach ($request->all() as $key => $val) {
            if (!!$val) {
                $data[$key] = $val;
            }
        }
        $link->fill($data);
        $link->save();
        return redirect()->route('site-setting');
    }

    public function deleteULink($id)
    {
        $link = UsefulLinks::findOrFail($id);
        $link->delete();

        return redirect()->route('site-setting');
    }


    public function editMission($id)
    {
        $link = Mission::query()->findOrFail($id);
//        $link = UsefulLinks::where(['slug'=>$slug])->first();
        return view('site-setting.edit-mission')->with([
            'page' => $link
        ]);
    }

    public function updateMission(Request $request)
    {
        $id = $request->page_id;
        $link = Mission::query()->find($id);
        request()->request->remove('page_id');
        $data = [];
        foreach ($request->all() as $key => $val) {
            if (!!$val) {
                $data[$key] = $val;
            }
        }
        $link->fill($data);
        $link->save();
        return redirect()->route('home-page');
    }

    public function deleteMission($id)
    {
        $link = Mission::query()->findOrFail($id);
        $link->delete();

        return redirect()->route('site-setting');
    }

    public function toggleDisplayULink($id)
    {
        $link = UsefulLinks::findOrFail($id);
        if ($link->status == 1)
            $link->status = 0;
        elseif ($link->status == 0)
            $link->status = 1;
        $link->save();
        return redirect()->route('site-setting');
    }

    public function updateSiteSetting(Request $request)
    {
        $autoplay = 0;
       if(isset($request['auto_play']) && !is_null($request->get('auto_play'))){
           $autoplay = 1;
       };
        if (!!$request->get('name') || !!$request->get('secondary_phone') || !!$request->get('primary_phone')
            || !!$request->get('apply') || !!$request->get('visit_us') || !!$request->get('direction')
            || !!$request->get('address') || !!$request->get('facebook') || !!$request->get('twitter')
            || !!$request->get('instagram') || !!$request->get('youtube') || !!$request->get('welcome_pic')
            || !!$request->get('email') || !!$request->get('portal_url') || !! $request->get('inquire')
            || !!$request->get('virtual_tour') || !!$request->get('auto_play') || $request->get('splash_screen_image')
            || !!$request->get('menu_pic') || !!$request->get('menu_text')
        ) {
            $siteSetting = SiteSetting::firstOrNew([]);
            $siteSetting->display_name = $request->get('name');
            $siteSetting->secondary_phone = $request->get('secondary_phone');
            $siteSetting->primary_phone = $request->get('primary_phone');
            $siteSetting->apply = $request->get('apply');
            $siteSetting->visit_us = $request->get('visit_us');
            $siteSetting->direction = $request->get('direction');
            $siteSetting->address = $request->get('address');
            $siteSetting->facebook = $request->get('facebook');
            $siteSetting->instagram = $request->get('instagram');
            $siteSetting->youtube = $request->get('youtube');
            $siteSetting->email = $request->get('email');
            $siteSetting->portal_url = $request->get('portal_url');
            $siteSetting->inquire = $request->get('inquire');
            $siteSetting->virtual_tour = $request->get('virtual_tour');
            $siteSetting->menu_text = $request->get('menu_text');
            $siteSetting->autoplay = $autoplay;
            if ($request->hasFile('welcome_pic')) {
                $siteSetting->welcome_pic = $request->file('welcome_pic')->store('', 'images');
            }
            if ($request->hasFile('menu_pic')) {
                $siteSetting->menu_pic = $request->file('menu_pic')->store('', 'images');
            }
            if ($request->hasFile('splash_screen_image')) {
                $siteSetting->splash_screen_image = $request->file('splash_screen_image')->store('', 'images');
            }
            $siteSetting->save();
        }

        return redirect()->route('site-setting');
    }

    public function updateSiteLogo(Request $request)
    {
        if ($request->hasFile('logo')) {
            $siteSetting = SiteSetting::firstOrNew([]);
            $siteSetting->logo = $request->file('logo')->store('', 'images');
            $siteSetting->save();
        }
        return redirect()->route('site-setting');
    }

    public function toggleDisplaySponsor()
    {
        $setting = SiteSetting::firstOrCreate();
        $setting->display_sponsors = $setting->display_sponsors === SiteSetting::DISPLAY_SPONSOR_ON
            ? SiteSetting::DISPLAY_SPONSOR_OFF
            : SiteSetting::DISPLAY_SPONSOR_ON;
        $setting->save();
        return response()->json($setting, 201);
    }
}
