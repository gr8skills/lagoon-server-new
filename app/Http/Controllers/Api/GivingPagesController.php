<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GivingPagesController extends Controller
{
    public function why()
    {
        return $this->getResponse($this->getContent('why-give'));
    }

    public function givingFaqs()
    {
        return $this->getResponse($this->getContent('giving-faqs'));
    }

    public function howTo()
    {
        return $this->getResponse($this->getContent('how-to-give'));
    }
}
