<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LookBuilderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LookBuilderModelController extends Controller
{
    public function list()
    {
        try {
            $models = LookBuilderModel::all();
            return view('admin.pages.look_builder_model', compact('models'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/look_builder_models', $imageName);
            }
            if ($request->hasFile('layer_image')) {
                $image = $request->file('layer_image');
                $layerImageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/look_builder_models/layer_images', $layerImageName);
            }
            if ($request->hasFile('hand_image')) {
                $image = $request->file('hand_image');
                $handImageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/look_builder_models/hand_images', $handImageName);
            }
            DB::beginTransaction();
            LookBuilderModel::create([
                'title' => $request->title,
                'image' => $imageName,
                'layer_image' => $layerImageName,
                'hand_image' => $handImageName,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Model Created Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function delete($uuid)
    {
        try {
            DB::beginTransaction();
            $lookBuilderModel = LookBuilderModel::where('id', $uuid)->first();
            if ($lookBuilderModel != null) {
                $lookBuilderModel->delete();
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'LookBuilderModel Deleted Successfully',
                ]);
            }
            return response()->json(['status' => false, 'message' => 'LookBuilderModel Not Found']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function edit($uuid)
    {
        try {
            $lookBuilderModel = LookBuilderModel::where('id', $uuid)->first();
            if ($lookBuilderModel != null) {
                return $lookBuilderModel;
            }
            return response()->json(['status' => false, 'message' => 'LookBuilderModel Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function update($uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $lookBuilderModel = LookBuilderModel::where('id', $uuid)->first();
            $imageName = $lookBuilderModel->image;
            $layerImageName = $lookBuilderModel->layer_image;
            $handImageName = $lookBuilderModel->hand_image;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/look_builder_models', $imageName);
            }
            if ($request->hasFile('layer_image')) {
                $image = $request->file('layer_image');
                $layerImageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/look_builder_models/layer_images', $layerImageName);
            }
            if ($request->hasFile('hand_image')) {
                $image = $request->file('hand_image');
                $handImageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/look_builder_models/hand_images', $handImageName);
            }
            if ($lookBuilderModel != null) {
                $lookBuilderModel->update([
                    'title' => $request->title,
                    'image' => $imageName,
                    'layer_image' => $layerImageName,
                    'hand_image' => $handImageName,
                ]);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'LookBuilderModel Updated successfully',
                ]);
            }
            return response()->json(['status' => false, 'message' => 'LookBuilderModel Not Found']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => ' went wrong']);
        }
    }
}
