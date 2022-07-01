<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutPagesController extends Controller
{
    public function welcomeToLagoonSchool()
    {
        return $this->getResponse($this->getContent('welcome-to-the-lagoon-school'));
    }

    public function meetHead()
    {
        return $this->getResponse($this->getContent('meet-the-head'));
    }

    public function philosophy()
    {
        return $this->getResponse($this->getContent('educational-phylosophy-and-model'));
    }

    public function faith()
    {
        return $this->getResponse($this->getContent('faith'));
    }

    public function virtualTour()
    {
        return $this->getResponse($this->getContent('virtual-tour'));
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
