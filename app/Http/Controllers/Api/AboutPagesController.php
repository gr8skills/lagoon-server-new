<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutPagesController extends Controller
{
    public function home()
    {
        return $this->getResponse($this->getContent('about-the-lagoon-school'));
    }

    public function meetHead()
    {
        return $this->getResponse($this->getContent('meet-the-head'));
    }

    public function philosophy()
    {
        return $this->getResponse($this->getContent('educational-philosophy-model'));
    }

    public function virtualTour()
    {
        return $this->getResponse($this->getContent('news-and-updates'));
    }

    public function partners()
    {
        return $this->getResponse($this->getContent('partnership-with-parents'));
    }

    public function contactUs()
    {
        return $this->getResponse($this->getContent('contact-us'));
    }
}
