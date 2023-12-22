<?php

namespace App\Http\Controllers\Web\CustomProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomAttribute;
use App\Models\CustomOption;
use App\Models\CustomOptionImage;
use App\Models\Fabric;
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
                'fabric_id' => $request->fabric_id,
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
            $fabrics = Fabric::all();
            $options = $attribute->customOptions;
            return view('admin.pages.custom.optionList', compact('options', 'attribute', 'fabrics'));
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
    public function custom_option_images($option_uuid)
    {
        try {
            $option = CustomOption::where('uuid', $option_uuid)->first();
            $customImages = $option->customOptionImages;
            $fabrics = Fabric::all();
            return view('admin.pages.custom.optionImages', compact('option', 'customImages', 'fabrics'));
        } catch (\Throwable $th) {
        }
    }
    public function addCustomOptionImage(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/custom_products/options/images', $imageName);
            }
            CustomOptionImage::create([
                'fabric_id' => $request->fabric_id,
                'custom_option_id' => $request->option_id,
                'layer_image' => $imageName,
                'sequence_no' => $request->sequence,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Layer Image added successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
    public function editCustomOptionImage($id)
    {
        try {
            return CustomOptionImage::findorfail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
    public function updateCustomOptionImage(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $customOptionImage = CustomOptionImage::findorfail($id);
            $layer_image_name = $customOptionImage->layer_image;
            if ($request->hasFile('image')) {

                if (isset($layer_image_name)) {
                    $filePathToDeleteLayer = public_path('images/custom_products/options/images/' . $layer_image_name);

                    if (file_exists($filePathToDeleteLayer)) {
                        unlink($filePathToDeleteLayer);
                    }
                }

                $layer_image = $request->file('image');
                $layer_image_name = time() . '_' . Str::random(15) . '.' . $layer_image->getClientOriginalExtension();
                $layer_image->storeAs('images/custom_products/options/images', $layer_image_name);
            }
            $customOptionImage->update([
                'id' => $customOptionImage->id,
                'fabric_id' => $request->fabric_id,
                'layer_image' => $layer_image_name,
                'custom_option_id' => $request->option_id,
                'sequence_no' => $request->sequence
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Updated Successfully',
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
    public function deleteCustomOptionImage($id)
    {
        try {
            DB::beginTransaction();
            $customImage = CustomOptionImage::findorfail($id);
            $layer_image_name = $customImage->layer_image;
            if (isset($layer_image_name)) {
                $filePathToDeleteLayer = public_path('images/custom_products/options/images/' . $layer_image_name);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            $customImage->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
