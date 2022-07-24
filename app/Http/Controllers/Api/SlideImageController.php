<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SlideImage;

class SlideImageController extends Controller
{
    public function index()
    {
        $slideImages = SlideImage::query()->get('image_path')->pluck(['image_path']);
        return $this->getResponse($slideImages);
    }
}
