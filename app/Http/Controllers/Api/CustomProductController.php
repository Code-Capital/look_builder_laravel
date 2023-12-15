<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Custom\ProductLayerResource;
use App\Http\Resources\Custom\ProductResource;
use App\Http\Resources\CustomProductResource;
use App\Models\CustomOption;
use App\Models\CustomOptionImage;
use App\Models\CustomProduct;
use App\Models\Fabric;
use App\Models\ProductLayerImage;
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
            return response()->json([
                'status' => 200,
                'message' => 'Product Details',
                'data' => new CustomProductResource($product),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function getLayerImageByFabric($product_uuid, $fabric_uuid)
    {
        try {
            $product = CustomProduct::where('uuid', $product_uuid)->first();
            $fabric = Fabric::where('uuid', $fabric_uuid)->first();
            $productLayerImage = ProductLayerImage::where('custom_product_id', $product->id)
                ->where('fabric_id', $fabric->id)
                ->first();
            return response()->json([
                'status' => 200,
                'message' => 'Layer Image',
                'data' => new ProductLayerResource($productLayerImage),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getOptionById($option_uuid, $fabric_uuid)
    {
        try {
            $customOption = CustomOption::where('uuid', $option_uuid)->first();
            $fabric = Fabric::where('uuid', $fabric_uuid)->first();

            $layer_image = CustomOptionImage::where('custom_option_id', $customOption->id)
                ->where('fabric_id', $fabric->id)
                ->first();
            return response()->json([
                'status' => 200,
                'message' => 'Layer Image',
                'data' => $layer_image,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
