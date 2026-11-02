<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeSliderRequest;
use App\Http\Requests\Admin\Content\updateSliderRequest;
use App\Models\Slider;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.content.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeSliderRequest $request, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();
        // main slider can be stored unlimitedly. but other sliders only can be only 1 record at the time
        if ($inputs['position'] == 0) {

            if ($request->hasFile('image')) {
                $result = $imageUploadService->uploadImage($request->file('image'));
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['image'] = $result;
            }
            $slider = Slider::create($inputs);
            return to_route('admin.content.slider.index')->with('swal-success', 'اسلایدر با موفقیت ساخته شد');
        } else {
            // for other position we must check if it already exists or not

            $previousSlider = Slider::where('position', $inputs['position'])->exists();
            if ($previousSlider) {

                // a slider already exitst for that position. so we redirect with error message
                return to_route('admin.content.slider.index')->with('swal-error', 'برای موقعیت انتخاب شده اسلایدر وجود دارد!');
            } else {

                // no slider exists for that position. so it will be stored

                if ($request->hasFile('image')) {
                    $result = $imageUploadService->uploadImage($request->file('image'));
                    if ($result === false) {
                        return back()->with('swal-error', 'خطا در آپلود فایل');
                    }
                    $inputs['image'] = $result;
                }
                $slider = Slider::create($inputs);
                return to_route('admin.content.slider.index')->with('swal-success', 'بنر با موفقیت ساخته شد');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.content.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateSliderRequest $request, Slider $slider, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();
        // change position to main banner can be done regardless of requested position
        if ($inputs['position'] == 0) {

            if ($request->hasFile('image')) {

                if (!empty($slider->image)) {
                    $imageUploadService->removeImage($slider->image);
                }

                $result = $imageUploadService->uploadImage($request->file('image'));
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['image'] = $result;
            }

            $slider->update($inputs);
            return to_route('admin.content.slider.index')->with('swal-success', 'اسلایدر با موفقیت ویرایش شد');
        } else {
            $requestedPositionSlider = Slider::where('position', $inputs['position'])->exists();
            // a slider exists for that position
            if ($requestedPositionSlider) {
                // slider is updating with same position and maybe different image
                if ($slider->position == $inputs['position']) {
                    if ($request->hasFile('image')) {

                        if (!empty($slider->image)) {
                            $imageUploadService->removeImage($slider->image);
                        }

                        $result = $imageUploadService->uploadImage($request->file('image'));
                        if ($result === false) {
                            return back()->with('swal-error', 'خطا در آپلود فایل');
                        }
                        $inputs['image'] = $result;
                    }
                    $slider->update($inputs);
                    return to_route('admin.content.slider.index')->with('swal-success', 'اسلایدر با موفقیت ویرایش شد');

                } else {
                    // slider is asking for shift position, but that position is occupied so it can't be done
                    return to_route('admin.content.slider.index')->with('swal-error', 'برای موقعیت درخواست شده اسلایدر وجود دارد');
                }
            } else {
                // requested position is free so it will be upated
                if ($request->hasFile('image')) {

                    if (!empty($slider->image)) {
                        $imageUploadService->removeImage($slider->image);
                    }

                    $result = $imageUploadService->uploadImage($request->file('image'));
                    if ($result === false) {
                        return back()->with('swal-error', 'خطا در آپلود فایل');
                    }
                    $inputs['image'] = $result;
                }
                $slider->update($inputs);
                return to_route('admin.content.slider.index')->with('swal-success', 'اسلایدر با موفقیت ویرایش شد');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return to_route('admin.content.slider.index')->with('swal-success', 'اسلایدر با موفقیت حذف شد');
    }
}
