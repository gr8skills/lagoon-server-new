<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubsController extends Controller
{
    public function index()
    {
        $clubs = ['primary'=>[],'secondary'=>[]];
        Club::all()->mapToGroups(function ($club)use (&$clubs){
            $clubs[$club->category][]=$club;
            return [];
        });
        $clubs['notes']=$this->getContent('club-activities');
        return response()->json($clubs);
    }
}
