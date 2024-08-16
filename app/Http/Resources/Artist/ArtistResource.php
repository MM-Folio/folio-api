<?php

namespace App\Http\Resources\Artist;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Genre\GenreResourceArtist;

class ArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'picture_url' => url('images/' . $this->picture->image),
            'picture_id' => $this->picture_id,
            'genre' => new GenreResourceArtist($this->genre),
            'location' => $this->location,
            'description' => $this->description,
            'instaHandle' => $this->instaHandle,
            'ytEmbedUrl' => $this->ytEmbedUrl,
            'spotifyEmbedUrl' => $this->spotifyEmbedUrl
        ];
    }
}
