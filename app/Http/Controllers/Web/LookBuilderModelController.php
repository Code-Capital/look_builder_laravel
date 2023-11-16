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
            DB::beginTransaction();
            LookBuilderModel::create([
                'title' => $request->title,
                'image' => $imageName,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Model Created Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
