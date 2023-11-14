<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LookBuilderProduct;
use App\Models\Product;
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
                $product_image_name = time() . '_' . Str::random(15) . '.' . $product_image->getClientOriginalExtension();
                $product_image->storeAs('images/look_builder_products/product_images', $product_image_name);
            }
            if ($request->hasFile('layer_image')) {
                $layer_image = $request->file('layer_image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/look_builder_products/layer_images', $layer_image_name);
            }

            LookBuilderProduct::create([
                'uuid' => Str::uuid(),
                'title' => $request->title,
                'product_image' => $product_image_name,
                'layer_image' => $layer_image_name,
                'color' => $request->color,
                'size' => $request->size,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Product added successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function byCategory($category_uuid)
    {
        try {
            $categories = Category::all();
            $tabCategory = Category::where('uuid', $category_uuid)->first();
            $products = $tabCategory->lookBuilderProducts;
            return view('admin.pages.look_builder.shirts', compact('products', 'categories', 'tabCategory'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function delete($uuid)
    {
        try {
            DB::beginTransaction();
            $lookBuilderProduct = LookBuilderProduct::where('uuid', $uuid)->first();
            $layer_image_name = $lookBuilderProduct->layer_image;
            $product_image_name = $lookBuilderProduct->product_image;

            if (isset($layer_image_name)) {
                $filePathToDeleteLayer = public_path('images/look_builder_products/layer_images/' . $layer_image_name);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            if (isset($product_image_name)) {
                $filePathToDeleteProduct = public_path('images/look_builder_products/product_images/' . $product_image_name);

                if (file_exists($filePathToDeleteProduct)) {
                    unlink($filePathToDeleteProduct);
                }
            }
            $lookBuilderProduct->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Deleted Successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
