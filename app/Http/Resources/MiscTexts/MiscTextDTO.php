<?php

namespace App\Http\Resources\MiscTexts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MiscTextDTO extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'textId' => $this->textId,
            'text' => $this->text,
        ];
    }
}
