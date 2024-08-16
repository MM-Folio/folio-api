<?php

namespace App\Http\Resources\Portfolio;

use App\Http\Resources\Artist\ArtistIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'url' => route('portfolios.show', $this->urlId),
            'title' => $this->title,
            'artists' => ArtistIndexResource::collection($this->artists),
            'valid_till' => $this->valid_till,
        ];
    }
}
