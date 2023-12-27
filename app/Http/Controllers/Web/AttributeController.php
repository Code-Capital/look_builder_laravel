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
            $productId = $request->input('look_builder_product_id');
            $lookBuilderProduct = LookBuilderProduct::findorfail($productId);
            $nameArray = $request->input('name', []);
            $descriptionArray = $request->input('description', []);

            if (count($nameArray) !== count($descriptionArray)) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Mismatched data');
            }
            for ($i = 0; $i < count($nameArray); $i++) {
                Attribute::create([
                    'uuid' => Str::uuid(),
                    'name' => $nameArray[$i],
                    'description' => $descriptionArray[$i],
                    'look_builder_product_id' => $productId,
                    'category_id' => $lookBuilderProduct->category_id,
                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Attribute added successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function edit($attribute_uuid)
    {
        try {
            $attribute = Attribute::where('uuid', $attribute_uuid)->first();
            return $attribute;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function update($attribute_uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $attribute = Attribute::where('uuid', $attribute_uuid)->first();
            $attribute->update([
                'id' => $attribute->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Attribute Updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function delete($attribute_uuid)
    {
        try {
            DB::beginTransaction();
            $attribute = Attribute::where('uuid', $attribute_uuid)->first();
            $attribute->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Attribute Deleted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
