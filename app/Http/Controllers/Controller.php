<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getContent($slug,$plucks=null)
    {
        return is_null($plucks)? (Page::query()->where('slug', $slug)->first() ?? null):(Page::query()->where('slug', $slug)->first($plucks) ?? null);
    }

    protected function getResponse($content, $code = 200)
    {
        return response()->json($content, $code);
    }
}
