<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;

class AcademicsPagesController extends Controller
{
    public function facilities()
    {
        return $this->getResponse($this->getContent('academic-facilities'));
    }

    public function juniorSchool()
    {
     return $this->getResponse($this->getContent('junior-school'));
    }

    public function seniorSchool()
    {
        return $this->getResponse($this->getContent('senior-school'));
    }

    public function library()
    {
        return $this->getResponse($this->getContent('library'));
    }

    public function calendar()
    {
        return $this->getResponse($this->getContent('academic-calendar'));
    }
}
