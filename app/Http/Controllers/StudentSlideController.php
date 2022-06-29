<?php

namespace App\Http\Controllers;

use App\Models\StudentSlide;
use App\Models\StudentSlideMessage;
use Illuminate\Http\Request;

class StudentSlideController extends Controller
{
    public function createStudentSlide()
    {
        return view('pages.students-slide-create');
    }

    public function storeSlide(Request $request)
    {
        $request->validate([
            'image' => ['required']
        ]);

        $imagePath = $request->image->store('', 'images');

        StudentSlide::create([
            'title' => $request->get('title'),
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully.'
        ], 200);
    }

    public function updateOne(Request $request)
    {
        $slideMessage = StudentSlideMessage::query()->first();
        if(is_null($slideMessage))
            $slideMessage=StudentSlideMessage::query()->create();
        $data = $request->all();
//        dd($data,$slideMessage);
        unset($data['_token']);
        $slideMessage->update($data);
        return redirect()->route('students-slide');
    }



}
