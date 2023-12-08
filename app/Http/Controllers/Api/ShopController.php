<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LookBuilderProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SizeResource;
use App\Http\Resources\SuitResource;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\LookBuilderModel;
use App\Models\LookBuilderProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Suit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    public function myCart(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = Auth::user()->cart ?? Cart::create(['user_id' => Auth::user()->id]);
            // $productIdsInCart = explode(',', $request->productId);

            // foreach ($productIdsInCart as $productUuid) {
            $productForCart = LookBuilderProduct::where('uuid', $request->productId)->first();
            $existingCartProduct = CartProduct::where('look_builder_product_id', $productForCart->id)
                ->where('size', $request->size)
                ->where('cart_id', $cart->id)
                ->first();

            if ($existingCartProduct) {
                $existingCartProduct->increment('quantity');
                $existingCartProduct->update([
                    'total_price' => $existingCartProduct->quantity * $existingCartProduct->lookBuilderProduct->price
                ]);
            } else {
                $product = LookBuilderProduct::findorfail($productForCart->id);
                $cartProduct = CartProduct::create([
                    'look_builder_product_id' => $productForCart->id,
                    'cart_id' => $cart->id,
                    'total_price' => $product->price,
                    'size' => $request->size,
                ]);
                $cartProduct->load('lookBuilderProduct');
            }
            // }
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
    public function addSize(Request $request)
    {
        try {
            $cart = Auth::user()->cart;
            if ($cart != null) {
                $cartProducts = $cart->cartProducts;
                if ($cartProducts->count() > 0) {
                    $cartProducts->where('look_builder_product_id', $request->product_id)->first()->update([
                        'size' => $request->size,
                    ]);
                } else {
                    return response()->json([
                        'status' => 204,
                        'message' => 'Your cart is empty'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'Your cart is empty'
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function removeItemFromCart($product_id)
    {
        try {
            DB::beginTransaction();
            $removeProduct = LookBuilderProduct::where('uuid', $product_id)->first();
            $cart = Auth::user()->cart;
            $cartProducts = $cart->cartProducts;
            if ($cartProducts->count() > 0) {
                foreach ($cartProducts as $cartProduct) {

                    if ($cartProduct->look_builder_product_id == $removeProduct->id) {
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
            if ($cart != null) {
                $cartWithProducts = $cart->load('cartProducts');
                if ($cartWithProducts->count() > 0) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Cart Details',
                        'data' => new CartResource($cartWithProducts),
                    ]);
                } else {
                    return response()->json([
                        'status' => 204,
                        'message' => 'Your cart is empty'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'Your cart is empty'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
            ]);
        }
    }
    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = Auth::user()->cart;
            $user = Auth::user();
            $user->update([
                'id' => $user->id,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->state,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            if ($cart != null) {
                $cartProducts = $cart->cartProducts;
                $amount = $cartProducts->sum('total_price');
                if ($cartProducts->count() > 0) {
                    $order = Order::create([
                        'uuid' => Str::uuid(),
                        'user_id' => Auth::user()->id,
                        'amount' => $amount,
                    ]);
                    foreach ($cartProducts as $cartProduct) {
                        OrderProduct::create([
                            'order_id' => $order->id,
                            'look_builder_product_id' => $cartProduct->look_builder_product_id,
                            'size' => $cartProduct->size,
                            'quantity' => $cartProduct->quantity,
                        ]);
                    }
                    DB::commit();
                    $cart->delete();
                    DB::commit();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Order has been placed'
                    ]);
                } else {
                    DB::rollBack();
                    return response()->json([
                        'status' => 204,
                        'message' => 'Your cart is empty'
                    ]);
                }
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => 204,
                    'message' => 'Your cart is empty'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function getSizes($product_uuid)
    {
        try {
            $product = LookBuilderProduct::where('uuid', $product_uuid)->first();
            $attributes = $product->attributes;
            if ($attributes->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Sizes',
                    'data' => SizeResource::collection($attributes),
                ]);
            } else {
                return response()->json([
                    'status' => 204,
                    'message' => 'No sizes available',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function selectSizes(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = Auth::user()->cart;
            $cartProducts = $cart->cartProducts;
            if ($cartProducts->count() > 0) {
                $productForSelectSize = LookBuilderProduct::where('uuid', $request->look_builder_product_id)->first();
                $cartProduct = CartProduct::where('look_builder_product_id', $productForSelectSize->id)->first();
                if ($cartProduct != null) {
                    $cartProduct->update([
                        'id' => $cartProduct->id,
                        'size' => $request->size,
                    ]);
                    DB::commit();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Size successfully selected',
                        'data' => $cartProduct,
                    ]);
                }
                return response()->json([
                    'status' => 500,
                    'message' => 'Size not found '
                ]);
            }
            return response()->json([
                'status' => 500,
                'message' => 'Size not found '
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error '
            ]);
        }
    }
    public function getModels()
    {
        try {
            $lookBuilderModels = LookBuilderModel::all();
            return response()->json([
                'status' => 200,
                'messasge' => 'Model Details',
                'data' => $lookBuilderModels,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'messasge' => 'Internal server error',
            ]);
        }
    }
    public function fabrics()
    {
        try {
            $fabrics = Fabric::all();
            return response()->json([
                'status' => 200,
                'message' => 'All Fabrics',
                'data' => $fabrics,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
            ]);
        }
    }
    public function suits()
    {
        try {
            $suits = Suit::all();
            return response()->json([
                'status' => 200,
                'data' => SuitResource::collection($suits),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function suitById($suit_uuid)
    {
        try {
            $suit = Suit::where('uuid', $suit_uuid)->first();
            return response()->json([
                'status' => 200,
                'message' => 'Suit Details',
                'data' => new SuitResource($suit),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function shopLook($productIds)
    {
        try {
            DB::beginTransaction();
            $productIdsInCart = explode(',', $productIds);
            $productsForCart = [];

            foreach ($productIdsInCart as $productUuid) {
                $productForCart = LookBuilderProduct::where('uuid', $productUuid)->first();
                if ($productForCart) {
                    $productsForCart[] = $productForCart;
                }
            }

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Shop Look Details',
                'data' =>  ProductResource::collection($productsForCart),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function newestFirst()
    {
        try {
            $products = LookBuilderProduct::orderBy('created_at', 'desc')->get();

            return response()->json([
                'status' => 200,
                'message' => 'Newest Products',
                'data' => LookBuilderProductResource::collection($products),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function lowToHigh()
    {
        try {
            $products = LookBuilderProduct::orderBy('price', 'asc')->get();
            return response()->json([
                'status' => 200,
                'message' => 'Price low to high',
                'data' => LookBuilderProductResource::collection($products),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function highToLow()
    {
        try {
            $products = LookBuilderProduct::orderBy('price', 'desc')->get();
            return response()->json([
                'status' => 200,
                'message' => 'Price high to low',
                'data' => LookBuilderProductResource::collection($products),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function profile()
    {
        try {
            return response()->json([
                'status' => 200,
                'message' => 'User Details',
                'data' => Auth::user(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',

            ]);
        }
    }
}
