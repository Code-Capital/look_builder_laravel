<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Custom\ProductResource;
use App\Http\Resources\CustomProductResource;
use App\Models\CustomProduct;
use Illuminate\Http\Request;

class CustomProductController extends Controller
{
    public function getAllCustomProducts()
    {
        try {
            $products = CustomProduct::all();
            return response()->json([
                'status' => 200,
                'message' => 'Custom Products',
                'data' => $products
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getProductById($product_uuid)
    {
        try {
            $product = CustomProduct::where('uuid', $product_uuid)->first();
            $attributes = $product->attributes;
            // dd($attributes);
            return response()->json([
                'status' => 200,
                'message' => 'Product Details',
                'data' => new CustomProductResource($product),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
