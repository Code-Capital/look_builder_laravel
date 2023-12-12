<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/categories', $imageName);
            }
            $category = Category::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'image' => $imageName
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Category Created Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function delete($uuid)
    {
        try {
            DB::beginTransaction();
            $category = Category::where('uuid', $uuid)->first();
            $image = $category->image;

            if (isset($image)) {
                $filePathToDeleteLayer = public_path('images/categories/' . $image);

                if (file_exists($filePathToDeleteLayer)) {
                    unlink($filePathToDeleteLayer);
                }
            }
            if ($category != null) {
                $category->delete();
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Category Deleted Successfully',
                ]);
            }
            return response()->json(['status' => false, 'message' => 'Category Not Found']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function edit($uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->first();
            if ($category != null) {
                return $category;
            }
            return response()->json(['status' => false, 'message' => 'Category Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function update($uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $category = Category::where('uuid', $uuid)->first();
            $imageName = $category->image;
            if ($request->hasFile('image')) {
                if (isset($imageName)) {
                    $filePathToDeleteLayer = public_path('images/categories/' . $imageName);

                    if (file_exists($filePathToDeleteLayer)) {
                        unlink($filePathToDeleteLayer);
                    }
                }
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/categories', $imageName);
            }
            if ($category != null) {
                $category->update([
                    'id' => $category->id,
                    'name' => $request->name,
                    'image' => $imageName,
                ]);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Category Updated Successfully',
                ]);
            }
            return response()->json(['status' => false, 'message' => 'Category Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function all()
    {
        try {
            $categories = Category::all();
            return view('admin.pages.categoryList', compact('categories'));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function sizesOfCategory($category_id)
    {
        try {
            $category = Category::where('uuid', $category_id)->first();
            $attributes = $category->attributes;
            return view('admin.pages.products.custom_attribute', compact('attributes', 'category'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
