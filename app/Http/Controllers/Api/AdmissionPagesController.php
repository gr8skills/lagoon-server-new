<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdmissionPagesController extends Controller
{
    public function procedure()
    {
        return $this->getResponse($this->getContent('admission-procedure'));
    }

    public function tuition()
    {
        return $this->getResponse($this->getContent('school-tuition-fees'));
    }

    public function scholarship()
    {
        return $this->getResponse($this->getContent('scholarships'));
    }

    public function faqs()
    {
        return $this->getResponse($this->getContent('faqs'));
    }

    public function apply()
    {
        return $this->getResponse($this->getContent('apply-to-lagoon-school'));
    }
}
