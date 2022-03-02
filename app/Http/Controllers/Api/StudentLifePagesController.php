<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentLifePagesController extends Controller
{
    public function life()
    {
        return $this->getResponse($this->getContent('life-in-lagoon'));
    }

    public function traditions()
    {
        return $this->getResponse($this->getContent('lagoon-traditions'));
    }

    public function leadership()
    {
        return $this->getResponse($this->getContent('student-leadership'));
    }

    public function services()
    {
        return $this->getResponse($this->getContent('service'));
    }

    public function clubActivities()
    {
        return $this->getResponse($this->getContent('club-and-activities'));
    }

    public function tutorials()
    {
        return $this->getResponse($this->getContent('mentoringtutorials'));
    }
}
