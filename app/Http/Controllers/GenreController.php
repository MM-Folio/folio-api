<?php

namespace App\Http\Controllers;

use App\Http\Resources\Genre\GenreResource;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(GenreResource::collection(Genre::all()));
    }

    public function show($id)
    {
        $genre = Genre::find($id);

        if(!$genre) {
            return response()->json([
                'message' => 'Genre not found!'
            ], 404);
        }

        return response()->json(new GenreResource($genre));
    }

    public function store(Request $request)
    {
        $genre = Genre::create([
            ...$request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
            ])
        ]);

        return response()->json([
            'message' => 'Genre created!'
        ], 201);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);

        if(!$genre) {
            return response()->json([
                'message' => 'Genre not found!'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'message' => 'Genre deleted!'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if(!$genre) {
            return response()->json([
                'message' => 'Genre not found!'
            ], 404);
        }

        $genre->update([
            ...$request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
            ])
        ]);

        return response()->json([
            'message' => 'Genre updated!'
        ], 201);
    }
}
