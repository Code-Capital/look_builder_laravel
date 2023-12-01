<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_image' =>  '/images/look_builder_products/product_images/' . $this->product_image,
            'layer_image' => '/images/look_builder_products/layer_images/' . $this->layer_image,
            'color' => $this->color,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category->name,
            'fabric' => $this->fabric->name,
            'sizes' => AttributeResource::collection($this->attributes),
        ];
    }
}
