<?php

namespace App\Http\Controllers;

use App\Http\Resources\MiscTexts\MiscTextIndexResource;
use App\Http\Resources\MiscTexts\MiscTextDTO;
use App\Http\Resources\MiscTexts\MiscTextResource;
use App\Models\MiscTexts;
use Illuminate\Http\Request;

class MiscTextsController extends Controller
{
    public function index()
    {
        return response()->json([
            MiscTextIndexResource::collection(MiscTexts::all())
        ]);
    }

    public function show($textId)
    {
        $text = MiscTexts::where('textId',$textId)->first();
        if(!$text) {
            return response()->json([
                'message' => 'Text not found!'
            ], 404);
        }

        return response()->json([
            new MiscTextDTO($text)
        ]);
    }

    public function edit($id)
    {
        $miscText = MiscTexts::find($id);

        if(!$miscText) {
            return response()->json([
                'message' => 'Text not found!'
            ], 404);
        }

        return response()->json([
            new MiscTextResource($miscText)
        ]);
    }

    public function store(Request $request)
    {
        $miscText = MiscTexts::create([
            ...$request->validate([
                'textId' => ['required', 'string:unique:misc_texts'],
                'text' => 'required'
            ])
        ]);
        return response()->json([
            'message' => 'Text uploaded successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $miscText = MiscTexts::find($id);
        $miscText->update([
            ...$request->validate([
                'text' => 'required'
            ])
        ]);
        return response()->json([
            'message' => 'Text updated successfully'
        ]);
    }

    public function destroy($id)
    {
        MiscTexts::destroy($id);
        return response()->json([
            'message' => 'Text deleted successfully'
        ]);
    }
}
