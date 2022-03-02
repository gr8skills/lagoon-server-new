<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::firstOrCreate([]);
        $sponsors = Sponsor::all();

        return view('site-setting.index')
            ->with([
                'setting' => $siteSettings,
                'sponsors' => $sponsors
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

    public function updateSiteName(Request $request)
    {
        if (!!$request->get('name')) {
            $siteSetting = SiteSetting::firstOrNew([]);
            $siteSetting->display_name = $request->get('name');
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
