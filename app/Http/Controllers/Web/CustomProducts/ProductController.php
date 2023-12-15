<?php

namespace App\Http\Controllers\Web\CustomProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CustomProduct;
use App\Models\Fabric;
use App\Models\Category;
use App\Models\ProductLayerImage;

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
            $layer_image_name = $customProduct->layer_image;

            if ($request->hasFile('layer_image')) {

                if (isset($layer_image_name)) {
                    $filePathToDeleteLayer = public_path('images/custom_products/layer_images/' . $layer_image_name);

                    if (file_exists($filePathToDeleteLayer)) {
                        unlink($filePathToDeleteLayer);
                    }
                }

                $layer_image = $request->file('layer_image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/custom_products/layer_images', $layer_image_name);
            }

            $customProduct->update([
                'title' => $request->title,
                'layer_image' => $layer_image_name,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Product updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function layerImagesByProduct($product_uuid)
    {
        try {
            $product = CustomProduct::where('uuid', $product_uuid)->first();
            $layer_images = $product->productLayerImages;
            $fabrics = Fabric::all();
            return view('admin.pages.custom.product_layer_image', compact('layer_images', 'fabrics', 'product'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function storeLayerImage(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $layer_image = $request->file('image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/custom_products/layer_images', $layer_image_name);
            }
            ProductLayerImage::create([
                'fabric_id' => $request->fabric_id,
                'custom_product_id' => $request->product_id,
                'image' => $layer_image_name,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Image saved successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
    public function editLayerImage($layer_id)
    {
        try {
            $customLayer = ProductLayerImage::findorfail($layer_id);
            return $customLayer;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateLayerImage(Request $request, $layer_id)
    {
        try {
            DB::beginTransaction();
            $layer = ProductLayerImage::findorfail($layer_id);
            $layer_image_name = $layer->image;
            if ($request->hasFile('image')) {

                if (isset($layer_image_name)) {
                    $filePathToDeleteLayer = public_path('images/custom_products/layer_images/' . $layer_image_name);

                    if (file_exists($filePathToDeleteLayer)) {
                        unlink($filePathToDeleteLayer);
                    }
                }

                $layer_image = $request->file('image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/custom_products/layer_images', $layer_image_name);
            }
            $layer->update([
                'id' => $layer->id,
                'fabric_id' => $request->fabric_id,
                'image' => $layer_image_name,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Updated successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
    public function deleteLayerImage($layer_id)
    {
        try {
            DB::beginTransaction();
            $customLayer = ProductLayerImage::findorfail($layer_id);
            $layer_image_name = $customLayer->image;
            if (isset($layer_image_name)) {
                $filePathToDeleteLayer = public_path('images/custom_products/layer_images/' . $layer_image_name);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            $customLayer->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
}
