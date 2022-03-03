<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlideImage;
use Illuminate\Support\Facades\Storage;

class SlideImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('pages.slide-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required']
        ]);

        $imagePath = $request->image->store('', 'images');

        SlideImage::create([
            'title' => $request->get('title'),
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully.'
        ], 200);
    }

    public function destroy($id)
    {
        $slideImage = SlideImage::find($id);

        if (!$slideImage) {
            return response()->json([
                'message' => 'Image not found.'
            ], 404);
        }

        if(Storage::disk('images')->exists($slideImage->image_path)) {
            Storage::disk('images')->delete($slideImage->image_path);
        }
        
        $slideImage->delete();

        return response()->json([
            'message' => 'Image deleted successfully.'
        ], 200);
    }
}
