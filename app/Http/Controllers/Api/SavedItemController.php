<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SavedItemResource;
use App\Models\LookBuilderProduct;
use App\Models\SavedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SavedItemController extends Controller
{
    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $lookBuilderProduct = LookBuilderProduct::where('uuid', $request->uuid)->first();
            SavedItem::create([
                'uuid' => Str::uuid(),
                'look_builder_product_id' => $lookBuilderProduct->id,
                'user_id' => Auth::user()->id,
            ]);
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Item saved successfully'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function getSavedItems()
    {
        try {
            $savedItems = Auth::user()->savedItems;
            if ($savedItems->count() > 0) {
                return  response()->json([
                    'status' => 200,
                    'message' => 'Saved Items',
                    'data' => SavedItemResource::collection($savedItems),
                ]);
            }
            return  response()->json([
                'status' => 204,
                'message' => 'No saved items found',
            ]);
        } catch (\Throwable $th) {
            return  response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function removeFromSaveItem($itemId)
    {
        try {
            $lookBuilderProduct = LookBuilderProduct::where('uuid', $itemId)->first();
            SavedItem::where('look_builder_product_id', $lookBuilderProduct->id)->first()->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Item removed from saved items',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
            ]);
        }
    }
}
