<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderSaveRequest;
use Exception;

class SliderController extends Controller
{
    //list slider
    public function index()
    {
        $sliders = Slider::get()->map(function($slider){
             $slider->image=$slider->getMedia('sliders')->first()->getUrl();
            return $slider;
        });
        return Inertia::render('Backend/Slider/SliderPage', compact('sliders'));
    }

    //slider save page
    public function sliderSavePage(Request $request)
    {
        $slider = Slider::find($request->id);
        if($slider){
            $slider->image=$slider->getMedia('sliders')->first()->getUrl();
        }
        return Inertia::render('Backend/Slider/SliderSavePage', compact('slider'));
    }

    //store
    public function store(SliderSaveRequest $request)
    {
        try {
            $data = [
                'tagline' => $request->tagline,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'rank' => $request->rank,
            ];
            $slider = Slider::create($data);

            if ($request->hasFile('image')) {
                $slider->addMediaFromRequest('image')->toMediaCollection('sliders');
            }
            return redirect()->back()->with(['status' => true, 'message' => 'Slider created successfully']);

        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //update
    public function update(SliderSaveRequest $request, Slider $slider){
        try {
            $data = [
                'tagline' => $request->tagline,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'rank' => $request->rank,
            ];
            $slider->update($data);

            if ($request->hasFile('image')) {
                $slider->clearMediaCollection('sliders');
                $slider->addMediaFromRequest('image')->toMediaCollection('sliders');
            }
            return redirect()->back()->with(['status' => true, 'message' => 'Slider updated successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //delete
    public function destroy(Slider $slider){
        try {
            $slider->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Slider deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
