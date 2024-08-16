<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;

class PictureController extends Controller
{
    public function store(Request $request)
    {
        $image = new Picture();
        if($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $image->image = $filename;
        }
        $image->save();
        return response()->json([
            'message' => 'Image uploaded successfully',
            'image_id' => $image->id
        ]);

    }
}
