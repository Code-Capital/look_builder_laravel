<?php

namespace App\Http\Controllers\Web\CustomProducts;

use App\Http\Controllers\Controller;
use App\Models\CustomAttribute;
use App\Models\CustomProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function attributesByProduct($product_uuid)
    {
        try {
            $product = CustomProduct::where('uuid', $product_uuid)->first();
            $attributes = $product->customAttributes;
            return view('admin.pages.custom.attributeList', compact('attributes', 'product'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $productId = $request->input('look_builder_product_id');
            $nameArray = $request->input('name', []);
            $descriptionArray = $request->input('description', []);

            if (count($nameArray) !== count($descriptionArray)) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Mismatched data');
            }
            for ($i = 0; $i < count($nameArray); $i++) {
                CustomAttribute::create([
                    'uuid' => Str::uuid(),
                    'name' => $nameArray[$i],
                    'description' => $descriptionArray[$i],
                    'custom_product_id' => $productId
                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'CustomAttribute added successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function edit($attribute_uuid)
    {
        try {
            $attribute = CustomAttribute::where('uuid', $attribute_uuid)->first();
            return $attribute;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function update($attribute_uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $attribute = CustomAttribute::where('uuid', $attribute_uuid)->first();
            $attribute->update([
                'id' => $attribute->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'CustomAttribute Updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function delete($attribute_uuid)
    {
        try {
            DB::beginTransaction();
            $attribute = CustomAttribute::where('uuid', $attribute_uuid)->first();
            $attribute->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'CustomAttribute Deleted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function customSizeList($product_uuid)
    {
        try {
            $custom_product = CustomProduct::where('uuid', $product_uuid)->first();
            $sizes = $custom_product->attributes;
            return view('admin.pages.custom.sizes', compact('sizes', 'custom_product'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function addSizeInCustomProduct($product_uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $custom_product = CustomProduct::where('uuid', $product_uuid)->first();
            $attribute = Attribute::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'description' => $request->description,
                'custom_product_id' => $custom_product->id,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'messsage' => 'Size Added Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'messsage' => 'Something went wrong',
            ]);
        }
    }
}
