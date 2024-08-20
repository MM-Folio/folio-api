<?php

namespace App\Http\Resources\Artist;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistDTO extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'picture_url' => url('images/' . $this->picture->image),
            'genre' => $this->genre->name,
            'location' => $this->location,
            'description' => $this->description,
            'instaHandle' => $this->instaHandle,
            'ytEmbedUrl' => $this->ytEmbedUrl,
            'spotifyEmbedUrl' => $this->spotifyEmbedUrl,
            'isBand' => $this->isBand,
        ];
    }
}
