<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategorySaveRequest;

class CategoryController extends Controller
{
    //list category
    public function index()
    {
        $categories = Category::all()->map(function ($category) {
            $category->image = $category->getFirstMediaUrl('categories');
            return $category;
        });
        return Inertia::render('Backend/Category/CategoryPage', compact('categories'));
    }

    //store category
    public function store(CategorySaveRequest $request)
    {

        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            if ($request->hasFile('image')) {
                $category->addMediaFromRequest('image')->toMediaCollection('categories');

            }

            return redirect()->back()->with(['status' => true, 'message' => 'Category created successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //category save page
    public function categorySavePage(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            $category->image = $category->getFirstMediaUrl('categories');
        }

        return Inertia::render('Backend/Category/CategorySavePage', compact('category'));
    }

    //update category
    public function update(CategorySaveRequest $request, Category $category)
    {
        try {
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            if ($request->hasFile('image')) {
                $category->clearMediaCollection('categories');
                $category->addMediaFromRequest('image')->toMediaCollection('categories');
            }

            return redirect()->back()->with(['status' => true, 'message' => 'Category updated successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //delete category
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Category deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
