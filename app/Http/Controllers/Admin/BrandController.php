<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandSaveRequest;


class BrandController extends Controller
{
    //list brands
    public function index()
    {
        $brands = Brand::all()->map(function ($brand) {
            $brand->image = $brand->getFirstMediaUrl('brands');
            return $brand;
        });

        return Inertia::render('Backend/Brand/BrandPage', compact('brands'));
    }

    //brand store
    public function store(BrandSaveRequest $request)
    {
        try {

            $brand = Brand::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);


            if ($request->hasFile('image')) {
                $brand->addMediaFromRequest('image')->toMediaCollection('brands');
            }

            return redirect()->back()->with(['status' => true, 'message' => 'Brand created successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }


    //brandsave page
    public function brandSavePage(Request $request)
    {
        $brand = Brand::find($request->id);
        if ($brand) {
            $brand->image = $brand->getFirstMediaUrl('brands');
        }
        return Inertia::render('Backend/Brand/BrandSavePage', compact('brand'));
    }

    //brand update
    public function update(BrandSaveRequest $request, Brand $brand)
    {
        try {

            $brand->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            if ($request->hasFile('image')) {
                $brand->clearMediaCollection('brands');
                $brand->addMediaFromRequest('image')
                    ->toMediaCollection('brands');
            }

            return redirect()->back()->with([
                'status' => true,
                'message' => 'Brand updated successfully'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    //brand delete
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();

            return redirect()->back()->with([
                'status' => true,
                'message' => 'Brand deleted successfully'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
