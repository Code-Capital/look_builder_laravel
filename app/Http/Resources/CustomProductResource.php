<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Custom\AttributeResource;



class CustomProductResource extends JsonResource
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
            'product_image' =>  '/images/custom_products/product_images/' . $this->product_image,
            'layer_image' => '/images/custom_products/layer_images/' . $this->layer_image,
            'color' => $this->color,
            'price' => $this->price,
            'description' => $this->description,
            'attributes' => AttributeResource::collection($this->customAttributes),
            'sizes' => SizeResource::collection($this->attributes),
        ];
    }
}
