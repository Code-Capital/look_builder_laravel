<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function store(Request $request, $attribute_uuid)
    {
        try {
            DB::beginTransaction();
            $attribute = Attribute::where('uuid', $attribute_uuid)->first();
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/options', $imageName);
            }
            Option::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
                'attribute_id' => $attribute->id,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Option Created Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function optionsByAttribute($attribute_uuid)
    {
        try {
            $attribute = Attribute::where('uuid', $attribute_uuid)->first();
            $options = $attribute->options;
            return view('admin.pages.optionList', compact('options', 'attribute'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function optionById($option_uuid)
    {
        try {
            $option = Option::where('uuid', $option_uuid)->first();
            if ($option != null) {
                return $option;
            } else {
                return response()->json(['status' => false, 'message' => 'Option Not Found']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function update(Request $request, $option_uuid)
    {
        try {
            DB::beginTransaction();
            $option  = Option::where('uuid', $option_uuid)->first();
            $imageName = $option->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/options', $imageName);
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
            $option = Option::where('uuid', $option_uuid)->first();
            $option->delete();
            return response()->json(['status' => true, 'messsage' => 'Option Deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'messsage' => 'Something went wrong']);
        }
    }
}
