<?php

namespace App\Http\Resources;

use App\Models\ProductLayerImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'user_id' => $this->user_id,
            'cart_products' => $this->transformCartProducts($this->cartProducts),
        ];
    }
    protected function transformCartProducts($cartProducts)
    {
        return $cartProducts->map(function ($cartProduct) {
            if ($cartProduct->lookBuilderProduct) {
                return [
                    'lookbuilderproduct' => new LookBuilderProductResource($cartProduct->lookbuilderproduct),
                    'id' => $cartProduct->id,
                    'cart_id' => $cartProduct->cart_id,
                    'quantity' => $cartProduct->quantity,
                    'size' => $cartProduct->size,
                    'total_price' => $cartProduct->total_price,
                ];
            } else if ($cartProduct->customProduct) {
                return [
                    'lookbuilderproduct' => new CustomCartProductResource($cartProduct->customProduct),
                    'layer_image' => 'images/custom_products/layer_images/' . ProductLayerImage::where('fabric_id', $cartProduct->fabric_id)->where('custom_product_id', $cartProduct->customProduct->id)->first()->image,
                    'id' => $cartProduct->id,
                    'cart_id' => $cartProduct->cart_id,
                    'quantity' => $cartProduct->quantity,
                    'size' => $cartProduct->size,
                    'total_price' => $cartProduct->total_price,
                    'fabric' => $cartProduct->fabric->name,
                    'options' => CartProductOptionsResource::collection($cartProduct->cartProductOptions),
                ];
            }
        });
    }
}
