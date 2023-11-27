<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fabric;
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
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'fabric_id' => $request->fabric_id,
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
            $fabrics = Fabric::all();
            $categories = Category::all();
            $tabCategory = Category::where('uuid', $category_uuid)->first();
            $products = $tabCategory->lookBuilderProducts;
            return view('admin.pages.look_builder.shirts', compact('products', 'categories', 'tabCategory', 'fabrics'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function delete($product_uuid)
    {
        try {
            DB::beginTransaction();
            $lookBuilderProduct = LookBuilderProduct::where('uuid', $product_uuid)->first();
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
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function allProducts()
    {
        try {
            $products = LookBuilderProduct::all();
            $fabrics = Fabric::all();
            return view('admin.pages.products.all', compact('products', 'fabrics'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function productsByFabric($fabric_uuid)
    {
        try {
            $fabric = Fabric::where('uuid', $fabric_uuid)->first();
            $products = $fabric->products;
            return view('admin.pages.products.all', compact('products'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function edit($product_uuid)
    {
        try {
            $lookBuilderProduct = LookBuilderProduct::where('uuid', $product_uuid)->first();
            return $lookBuilderProduct;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function update($product_uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $lookBuilderProduct = LookBuilderProduct::where('uuid', $product_uuid)->first();
            $product_image_name = $lookBuilderProduct->product_image;
            $layer_image_name = $lookBuilderProduct->layer_image;

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

            $lookBuilderProduct->update([
                'title' => $request->title,
                'color' => $request->color,
                'price' => $request->price,
                'description' => $request->description,
                'product_image' => $product_image_name,
                'layer_image' => $layer_image_name,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Product updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
