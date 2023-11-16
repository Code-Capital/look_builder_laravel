<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LookBuilderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function attributesByProduct($product_uuid)
    {
        try {
            $product = LookBuilderProduct::where('uuid', $product_uuid)->first();
            $attributes = $product->attributes;
            return view('admin.pages.products.custom_attribute', compact('attributes', 'product'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->input('attributes');

            foreach ($attributes as $attribute) {
                Attribute::create([
                    'uuid' => Str::uuid(),
                    'name' => $attribute,
                    'look_builder_product_id' => $request->look_builder_product_id
                ]);
                DB::commit();
            }

            return response()->json(['status' => true, 'message' => 'Attribute added successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
