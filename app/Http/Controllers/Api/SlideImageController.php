<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SlideImage;

class SlideImageController extends Controller
{
    public function index()
    {
        $slideImages = SlideImage::all();
        return $this->getResponse($slideImages);
    }
}
