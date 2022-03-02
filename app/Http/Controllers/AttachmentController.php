<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function index()
    {
        $uploads = Attachment::all();

        return view('uploads.index')->with([
            'uploads' => $uploads
        ]);
    }

    public function getUpload($id)
    {
        $upload = Attachment::find($id);
        if (!$upload) {
            return response()->json([
                'message' => 'File not found.'
            ], 404);
        }


        return response()->json($upload, 200);
    }

    public function storeUploads(Request $request)
    {
        $request->validate([
//            'file' => ['required', 'max:5120', 'mimes:jpg,jpeg,bmp,png,pdf,doc,docx']
            'file' => ['required']
        ]);

        $data['name'] = $request->file->getClientOriginalName();
        $data['path'] = $request->file->storeAs(
            '',
            $data['name'],
            'uploads'
        );
        $data['type'] = explode('/', $request->file->getMimeType())[0];

        $upload = Attachment::create($data);

        return response()->json([
            'file' => $upload
        ], 200);
    }

    public function delete($id)
    {
        $upload = Attachment::findOrFail($id);
        $upload->delete();

        return redirect()->route('uploads');
    }
}
