<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PartnershipWithParentQuestionAnswer;
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
        $menu = PartnershipWithParentQuestionAnswer::where(['status'=>1])->orderBy('position', 'asc')->get();
        return response()->json(
            $menu, 200
        );
    }

    public function apply()
    {
        return $this->getResponse($this->getContent('apply-to-lagoon-school'));
    }
}
