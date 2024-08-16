<?php

namespace App\Http\Resources\Portfolio;

use App\Http\Resources\Artist\ArtistDTO;
use App\Http\Resources\Artist\ArtistResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioDTO extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'artists' => ArtistDTO::collection($this->artists)
        ];
    }
}
