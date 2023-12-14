<?php

namespace App\Http\Controllers\Web\CustomProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CustomProduct;
use App\Models\Fabric;
use App\Models\Category;


class ProductController extends Controller
{
    public function byCategory($category_uuid)
    {
        try {
            $fabrics = Fabric::all();
            $categories = Category::all();
            $tabCategory = Category::where('uuid', $category_uuid)->first();
            $products = $tabCategory->customProducts;
            return view('admin.pages.custom.products', compact('products', 'categories', 'tabCategory', 'fabrics'));
        } catch (\Throwable $th) {
            return redirect(route('customProductByCategory', $tabCategory->id))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $layer_image_name = null;
            if ($request->hasFile('layer_image')) {
                $layer_image = $request->file('layer_image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/custom_products/layer_images', $layer_image_name);
            }

            CustomProduct::create([
                'uuid' => Str::uuid(),
                'title' => $request->title,
                'layer_image' => $layer_image_name,
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
    public function allProducts()
    {
        try {
            $products = CustomProduct::all();
            $fabrics = Fabric::all();
            return view('admin.pages.custom.allProducts', compact('products', 'fabrics'));
        } catch (\Throwable $th) {
        }
    }
    public function delete($product_uuid)
    {
        try {
            DB::beginTransaction();
            $customProduct = CustomProduct::where('uuid', $product_uuid)->first();
            $layer_image_name = $customProduct->layer_image;
            $product_image_name = $customProduct->product_image;

            if (isset($layer_image_name)) {
                $filePathToDeleteLayer = public_path('images/custom_products/layer_images/' . $layer_image_name);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            if (isset($product_image_name)) {
                $filePathToDeleteProduct = public_path('images/custom_products/product_images/' . $product_image_name);

                if (file_exists($filePathToDeleteProduct)) {
                    unlink($filePathToDeleteProduct);
                }
            }
            $customProduct->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Deleted Successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function edit($product_uuid)
    {
        try {
            $customProduct = CustomProduct::where('uuid', $product_uuid)->first();
            return $customProduct;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function update($product_uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $customProduct = CustomProduct::where('uuid', $product_uuid)->first();
            $product_image_name = $customProduct->product_image;
            $layer_image_name = $customProduct->layer_image;

            if ($request->hasFile('product_image')) {
                $product_image = $request->file('product_image');
                $product_image_name = time() . '_' . Str::random(15) . '.' . $product_image->getClientOriginalExtension();
                $product_image->storeAs('images/custom_products/product_images', $product_image_name);
            }
            if ($request->hasFile('layer_image')) {
                $layer_image = $request->file('layer_image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/custom_products/layer_images', $layer_image_name);
            }

            $customProduct->update([
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
