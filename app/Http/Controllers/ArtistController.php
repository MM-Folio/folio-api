<?php

namespace App\Http\Controllers;

use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Artist\ArtistIndexResource;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::query()->paginate(20);
        return response()->json([
            "artists" => ArtistIndexResource::collection($artists),
            "pagination" => [
                "total_artists" => $artists->total(),
                "current_page" => $artists->currentPage(),
                "total_pages" => $artists->lastPage(),
                "first_page" => $artists->url(1),
                "last_page" => $artists->url($artists->lastPage()),
                "prev_page" => $artists->previousPageUrl(),
                "next_page" => $artists->nextPageUrl(),

            ]
        ]);
    }

    public function edit($id)
    {
        return response()->json(new ArtistResource(Artist::find($id)));
    }

    

    public function destroy($id)
    {
        if(!Artist::find($id)) {
            return response()->json([
                'message' => 'Artist not found!'
            ], 404);
        }   

        Artist::destroy($id);

        return response()->json([
            'message' => 'Artist deleted!',
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $artist = Artist::create([
            ...$request->validate([
                'name' => ['required', 'string', 'max:255'],
                'picture_id' => ['required', 'integer'],
                'genre_id' => ['required', 'integer'],
                'location' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'instaHandle' => ['required', 'string', 'max:255'],
                'ytEmbedUrl' => ['required', 'string'],
                'spotifyEmbedUrl' => ['required', 'string'],
                'isBand' => ['required', 'boolean'],
            ])
        ]);

        return response()->json([
            'message' => 'Artist created!'
        ], 201);
    }
    public function update(Request $request, $id): JsonResponse
    {
        $artist = Artist::find($id);
        
        if(!$artist) {
            return response()->json([
                'message' => 'Artist not found!'
            ], 404);
        }

        $artist->update([...$request->validate([
                'name' => ['required', 'string', 'max:255'],
                'picture_id' => ['required', 'integer'],
                'genre_id' => ['required', 'integer'],
                'location' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'instaHandle' => ['required', 'string', 'max:255'],
                'ytEmbedUrl' => ['required', 'string'],
                'spotifyEmbedUrl' => ['required', 'string'],
                'isBand' => ['required', 'boolean'],
            ])]);

        return response()->json([
            'message' => 'Artist updated!'
        ], 200);
    }
}
