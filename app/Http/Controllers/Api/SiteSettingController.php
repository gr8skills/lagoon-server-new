<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Sponsor;

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
}
