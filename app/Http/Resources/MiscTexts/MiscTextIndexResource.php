<?php

namespace App\Http\Resources\MiscTexts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MiscTextIndexResource extends JsonResource
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
            'textId' => $this->textId,
        ];
    }
}
