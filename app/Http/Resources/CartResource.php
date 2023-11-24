<?php

namespace App\Http\Resources;

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
            return [
                'lookbuilderproduct' => new ProductResource($cartProduct->lookbuilderproduct),
                'id' => $cartProduct->id,
                'cart_id' => $cartProduct->cart_id,
                'quantity' => $cartProduct->quantity,
                'total_price' => $cartProduct->total_price,

            ];
        });
    }
}
