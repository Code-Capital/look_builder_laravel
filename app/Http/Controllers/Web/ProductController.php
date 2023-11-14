<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
            ]);
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Product Created Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function delete($uuid)
    {
        try {
            DB::beginTransaction();
            $product = Product::where('uuid', $uuid)->first();
            if ($product != null) {
                $product->delete();
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Deleted Successfully',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'Product Not Found']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function view($uuid)
    {
        try {
            $product = Product::where('uuid', $uuid)->first();
            if ($product != null) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Details',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'Product Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function update($uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::where('uuid', $uuid)->first();
            if ($product != null) {
                $product->update([
                    'id' => $product->id,
                    'name' => $request->name,
                ]);
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Details',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'Product Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function all()
    {
        try {
            $products = Product::all();
            if ($products->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Product List',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'No Products Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
}
