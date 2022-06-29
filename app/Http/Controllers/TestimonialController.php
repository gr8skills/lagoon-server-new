<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class TestimonialController extends Controller
{
    public function createTestimonial()
    {
        return view('pages.create-testimonial');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'image' => ['required']
        ]);

        $imagePath = $request->image->store('', 'images');

        Testimonial::create([
            'label' => $request->get('label'),
            'paragraph' => $request->get('paragraph'),
            'commentor' => $request->get('commentor'),
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Testimonial created successfully.'
        ], 200);
    }

    public function updateOne(Request $request)
    {
        $data = $request->all();
        $testimonial = Testimonial::query()->find($data['id']);
        if(is_null($testimonial))
            $testimonial=Testimonial::query()->create($data);
        $testimonial->update($data);
//        return redirect()->route('students-slide');
        return redirect()->route('testimonials');
    }


}
