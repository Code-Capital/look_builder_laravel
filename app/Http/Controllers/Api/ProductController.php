<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\LookBuilderProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productById($product_uuid)
    {
        try {
            $product = LookBuilderProduct::where('uuid', $product_uuid)->first();
            $product = LookBuilderProduct::with('attributes.options')->find($product->id);
            return response()->json([
                'status' => 200,
                'message' => 'Product Details',
                'data' => new ProductResource($product),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
