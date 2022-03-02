<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    use ApiResponser;

    protected function findPage($slug)
    {
        return Page::with('category')
            ->where('slug', $slug)
            ->firstOrFail();
    }

}
