<?php

namespace App\Http\Controllers\Web\CustomProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomAttribute;
use App\Models\CustomOption;
use Illuminate\Support\Str;

class OptionController extends Controller
{
    public function store(Request $request, $attribute_uuid)
    {
        try {
            DB::beginTransaction();
            $attribute = CustomAttribute::where('uuid', $attribute_uuid)->first();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/custom_products/options', $imageName);
            }

            CustomOption::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
                'custom_attribute_id' => $attribute->id,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Created Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function optionsByAttribute($attribute_uuid)
    {
        try {
            $attribute = CustomAttribute::where('uuid', $attribute_uuid)->first();
            $options = $attribute->customOptions;
            return view('admin.pages.custom.optionList', compact('options', 'attribute'));
        } catch (\Throwable $th) {
        }
    }
    public function optionById($option_uuid)
    {
        try {
            $option = CustomOption::where('uuid', $option_uuid)->first();
            if ($option != null) {
                return $option;
            } else {
                return response()->json(['status' => false, 'message' => 'CustomOption Not Found']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function update(Request $request, $option_uuid)
    {
        try {
            DB::beginTransaction();
            $option  = CustomOption::where('uuid', $option_uuid)->first();
            $imageName = $option->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/custom_products/options', $imageName);
            }
            $option->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Updated Successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function delete($option_uuid)
    {
        try {
            $option = CustomOption::where('uuid', $option_uuid)->first();
            $imageName = $option->product_image;

            if (isset($layer_image_name)) {
                $filePathToDeleteLayer = public_path('images/custom_products/options/' . $imageName);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            $option->delete();
            return response()->json(['status' => true, 'messsage' => 'Deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'messsage' => 'Something went wrong']);
        }
    }
}
