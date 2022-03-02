<?php

namespace App\Http\Controllers\Api\Pages;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;

class AdmissionController extends ApiBaseController
{
    public function admissionProcedure()
    {
        $page = $this->findPage('admission-procedure');
        return $this->showOne($page);
    }

    public function tuitionFees()
    {
        $page = $this->findPage('school-tuition-fees');
        return $this->showOne($page);
    }

    public function boarding()
    {
        $page = $this->findPage('boarding');
        return $this->showOne($page);
    }

    public function scholarship()
    {
        $page = $this->findPage('scholarship');
        return $this->showOne($page);
    }

    public function faq()
    {
        $page = $this->findPage('faq');
        return $this->showOne($page);
    }

}
