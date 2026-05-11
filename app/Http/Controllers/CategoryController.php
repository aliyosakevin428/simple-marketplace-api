<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Categories',
            'data' => $categories
        ], 200);
    }

    public function show(Category $category)
    {
        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Category',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category Not Found',
            ], 404);
        }
    }

    public function store(CategoryRequest $request)
    {

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category Created',
            'data' => $category
        ], 201);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if ($category) {
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category Updated',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category Not Found',
            ], 404);
        }
    }

    public function destroy(Category $category)
    {
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category Deleted',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category Not Found',
            ], 404);
        }
    }
}
