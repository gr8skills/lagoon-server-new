<?php

namespace App\Http\Controllers\Api\Pages;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;

class AcademicController extends ApiBaseController
{
    public function academicFacilities()
    {
        $page = $this->findPage('academic-facilities');
        return $this->showOne($page);
    }

    public function curriculum()
    {
        $page = $this->findPage('curriculum');
        return $this->showOne($page);
    }

    public function library()
    {
        $page = $this->findPage('library');
        return $this->showOne($page);
    }

    public function academicMethods()
    {
        $page = $this->findPage('academic-methods');
        return $this->showOne($page);
    }
}
