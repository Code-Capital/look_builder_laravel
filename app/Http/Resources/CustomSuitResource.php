<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomSuitResource extends JsonResource
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
            'shirt' => new CustomProductResource($this->jacket),
            'pant' => new CustomProductResource($this->pant),
            'waistcoat' => new CustomProductResource($this->waistcoat),
        ];
    }
}
