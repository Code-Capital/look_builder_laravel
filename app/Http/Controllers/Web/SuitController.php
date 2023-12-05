<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LookBuilderProduct;
use App\Models\Suit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SuitController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('product_image')) {
                $product_image = $request->file('product_image');
                $product_image_name = time() . '_' . Str::random(15) . '.' . $product_image->getClientOriginalExtension();
                $product_image->storeAs('images/suits/product_images', $product_image_name);
            }
            $suit = Suit::create([
                'uuid' => Str::uuid(),
                'title' => $request->title,
                'product_image' => $product_image_name,
                'shirt_id' => $request->shirt_id,
                'trouser_id' => $request->trouser_id,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Suit Added Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function list()
    {
        try {
            $suits = Suit::all();
            $jackets = LookBuilderProduct::where('category_id', 1)->get();
            $trousers = LookBuilderProduct::where('category_id', 2)->get();
            return view('admin.pages.suits.list', compact('suits', 'jackets', 'trousers'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function all()
    {
        try {
            $suits = Suit::all();
            $jackets = LookBuilderProduct::where('category_id', 1)->get();
            $trousers = LookBuilderProduct::where('category_id', 2)->get();
            return view('admin.pages.suits.all', compact('suits', 'jackets', 'trousers'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function delete($suit_uuid)
    {
        try {
            $suit = Suit::where('uuid', $suit_uuid)->first();
            $imageName = $suit->product_image;
            if (isset($imageName)) {
                $filePathToDeleteLayer = public_path('images/suits/product_images/' . $imageName);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            $suit->delete();
            return  response()->json([
                'status' => true,
                'message' => 'Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            return  response()->json([
                'status' => false,
                'message' => 'Internal server error'
            ]);
        }
    }
    public function edit($suit_uuid)
    {
        try {
            $suit = Suit::where('uuid', $suit_uuid)->first();
            if ($suit) {
                return $suit;
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No suit found'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
    public function update(Request $request, $suit_uuid)
    {
        try {
            DB::beginTransaction();
            $suit = Suit::where('uuid', $suit_uuid)->first();
            $product_image_name = $suit->product_image;
            if ($request->hasFile('product_image')) {

                if (isset($product_image_name)) {
                    $filePathToDeleteLayer = public_path('images/suits/product_images/' . $product_image_name);

                    if (file_exists($filePathToDeleteLayer)) {
                        unlink($filePathToDeleteLayer);
                    }
                }



                $product_image = $request->file('product_image');
                $product_image_name = time() . '_' . Str::random(15) . '.' . $product_image->getClientOriginalExtension();
                $product_image->storeAs('images/suits/product_images', $product_image_name);
            }
            $suit->update([
                'id' => $suit->id,
                'product_image' => $product_image_name,
                'shirt_id' => $request->shirt_id,
                'trouser_id' => $request->trouser_id
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Suit updated successfully'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                dd($th->getMessage()),
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
