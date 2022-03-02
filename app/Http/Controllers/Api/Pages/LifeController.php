<?php

namespace App\Http\Controllers\Api\Pages;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;

class LifeController extends ApiBaseController
{
    public function culturalActivities()
    {
        $page = $this->findPage('cultural-activities');
        return $this->showOne($page);
    }

    public function music()
    {
        $page = $this->findPage('music');
        return $this->showOne($page);
    }

    public function foodNutrition()
    {
        $page = $this->findPage('food-nutrition');
        return $this->showOne($page);
    }

    public function sports()
    {
        $page = $this->findPage('sports');
        return $this->showOne($page);
    }

    public function vocationalActivities()
    {
        $page = $this->findPage('vocational-activities');
        return $this->showOne($page);
    }
}
