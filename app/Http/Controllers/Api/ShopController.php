<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LookBuilderProductResource;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\LookBuilderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function categories()
    {
        try {
            $categories = Category::all();
            if ($categories->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category Details',
                    'data' => CategoryResource::collection($categories)
                ]);
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'No Category found',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
            ]);
        }
    }
    public function productsByCategory($category_uuid)
    {
        try {
            $category = Category::where('uuid', $category_uuid)->first();
            $products = $category->lookBuilderProducts;
            if ($products->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => $category->name . ' are listing below',
                    'data' => LookBuilderProductResource::collection($products),
                ]);
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'No products found',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
            ]);
        }
    }
    public function productById($product_uuid)
    {
        try {
            $product = LookBuilderProduct::where('uuid', $product_uuid)->first();
            if ($product != null) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Details',
                    'data' => new LookBuilderProductResource($product),
                ]);
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'No Product Found',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                dd($th->getMessage()),
                'message' => 'Internal server error',
            ]);
        }
    }
    public function myCart($productIds)
    {
        try {
            DB::beginTransaction();
            $cart = Auth::user()->cart ?? Cart::create(['user_id' => Auth::user()->id]);
            $productIdsInCart = explode(',', $productIds);

            foreach ($productIdsInCart as $productId) {

                $existingCartProduct = CartProduct::where('look_builder_product_id', $productId)
                    ->where('cart_id', $cart->id)
                    ->first();

                if ($existingCartProduct) {
                    $existingCartProduct->increment('quantity');
                    $existingCartProduct->update([
                        'total_price' => $existingCartProduct->quantity * $existingCartProduct->lookBuilderProduct->price
                    ]);
                } else {
                    $product = LookBuilderProduct::findorfail($productId);
                    $cartProduct = CartProduct::create([
                        'look_builder_product_id' => $productId,
                        'cart_id' => $cart->id,
                        'total_price' => $product->price,
                    ]);
                    $cartProduct->load('lookBuilderProduct');
                }
            }
            DB::commit();
            $cartWithProducts = $cart->load('cartProducts');
            return response()->json([
                'status' => 200,
                'message' => 'Cart Details',
                'data' => new CartResource($cartWithProducts),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function removeItemFromCart($product_id)
    {
        try {
            DB::beginTransaction();
            $cart = Auth::user()->cart;
            $cartProducts = $cart->cartProducts;
            if ($cartProducts->count() > 0) {
                foreach ($cartProducts as $cartProduct) {

                    if ($cartProduct->look_builder_product_id == $product_id) {
                        $cartProduct->delete();
                        DB::commit();
                        return response()->json([
                            'status' => 200,
                            'message' => 'Removed from cart'
                        ]);
                        break;
                    }
                }
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'Item is not in your cart'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function viewCart()
    {
        try {
            $cart = Auth::user()->cart;
            $cartWithProducts = $cart->load('cartProducts');
            return response()->json([
                'status' => 200,
                'message' => 'Cart Details',
                'data' => new CartResource($cartWithProducts),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
