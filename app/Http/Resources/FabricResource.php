<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FabricResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'price' => $this->price,
            'image' => 'images/fabrics/' . $this->image,
            'composition' => $this->composition,
            'wight' => $this->weight,
            'season' => $this->season,
            'woven_by' => $this->woven_by,
            'fabric_code' => $this->fabric_code
        ];
    }
}
