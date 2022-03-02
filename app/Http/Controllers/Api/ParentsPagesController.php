<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentsPagesController extends Controller
{
    public function nafad()
    {
        return $this->getResponse($this->getContent('nafad'));
    }

    public function digitalSafety()
    {
        return $this->getResponse($this->getContent('digital-safety'));
    }

    public function launchMenu()
    {
        return $this->getResponse($this->getContent('lunch-menu'));

    }
}
