<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LookBuilderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LookBuilderProductController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('product_image')) {
                $product_image = $request->file('product_image');
                $product_image_name = time() . '_' . Str::random(15);
                $product_image->storeAs('images/look_builder_products/product_images', $product_image_name);
            }
            if ($request->hasFile('layer_image')) {
                $layer_image = $request->file('layer_image');
                $layer_image_name = time() . '_' . Str::random(15);
                $layer_image->storeAs('images/look_builder_products/layer_images', $layer_image_name);
            }

            LookBuilderProduct::create([
                'title' => $request->title,
                'product_image' => $product_image_name,
                'layer_image' => $layer_image_name,
                'color' => $request->color,
                'size' => $request->size,
                'price' => $request->price,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Product added successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
