<?php

namespace App\Http\Controllers;

use App\Models\SplashPhoto;
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

//        return redirect('/pages/home-page');

        return response()->json([
            'message' => 'Image deleted successfully.'
        ], 200);
    }

    public function createSplash()
    {
        return view('pages.splash-create');
    }

    public function storeSplash(Request $request)
    {
        $request->validate([
            'image' => ['required']
        ]);

        $maxPosition = SplashPhoto::orderBy('id','desc')->limit(1)->get();
        $maxPosition = collect($maxPosition)->toArray();
        if(!isset($maxPosition[0]))
            $maxPosition[0]=['position'=>0];

        $imagePath = $request->image->store('', 'images');
//        dd($request->get('category'));

        SplashPhoto::create([
            'title' => $request->get('title'),
            'category' => $request->get('category'),
            'image_path' => $imagePath,
            'position' => (int)$maxPosition[0]['position'] + 1,
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully.'
        ], 200);
    }

    public function destroySplash($id)
    {
        $photoSplash = SplashPhoto::find($id);

        if (!$photoSplash) {
            return response()->json([
                'message' => 'Image not found.'
            ], 404);
        }

        if(Storage::disk('images')->exists($photoSplash->image_path)) {
            Storage::disk('images')->delete($photoSplash->image_path);
        }

        $photoSplash->delete();

//        return redirect('/pages/photo-splash');

        return response()->json([
            'message' => 'Image deleted successfully.'
        ], 200);
    }
}
