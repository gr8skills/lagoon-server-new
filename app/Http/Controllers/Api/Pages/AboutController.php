<?php

namespace App\Http\Controllers\Api\Pages;

use App\Http\Controllers\Api\ApiBaseController;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends ApiBaseController
{
    public function schoolPolices()
    {
        $page = $this->findPage('school-policies');
        return $this->showOne($page);
    }

    public function virtualTour()
    {
        $page = $this->findPage('virtual-tour');
        return $this->showOne($page);
    }

    public function achievements()
    {
        $page = $this->findPage('achievements');
        return $this->showOne($page);
    }

    public function contactDirection()
    {
        $page = $this->findPage('contact-directions');
        return $this->showOne($page);
    }


//    private function findPage($slug)
//    {
//        return Page::with('category')
//            ->where('slug', $slug)
//            ->firstOrFail();
//    }
}
