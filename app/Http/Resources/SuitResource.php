<?php

namespace App\Http\Resources;

use App\Models\LookBuilderProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuitResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->shirt->price + $this->trouser->price,
            'product_image' => 'images/suits/product_images/' . $this->product_image,
            'jacket' => new ProductResource($this->shirt),
            'trouser' => new ProductResource($this->trouser),
        ];
    }
}
