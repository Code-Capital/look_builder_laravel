<?php

namespace App\Http\Resources\Custom;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'attribute' => $this->customAttribute->name,
            'images' =>  '/images/custom_products/options/' . $this->image,
        ];
    }
}
