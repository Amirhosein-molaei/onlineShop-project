<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeBannerRequest;
use App\Http\Requests\Admin\Content\updateBannerRequest;
use App\Models\Banner;
use App\Services\ImageUploadService;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.content.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBannerRequest $request, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();

        $previousBanner = Banner::where('position', $inputs['position'])->exists();
        if ($previousBanner) {
            // a banner already exitst for that position. so we redirect with error message
            return to_route('admin.content.banner.index')->with('swal-error', 'برای موقعیت انتخاب شده اسلایدر وجود دارد!');
        } else {

            // no banner exists for that position. so it will be stored

            if ($request->hasFile('image')) {
                $result = $imageUploadService->uploadImage($request->file('image'));
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['image'] = $result;
            }
            $slider = Banner::create($inputs);
            return to_route('admin.content.banner.index')->with('swal-success', 'بنر با موفقیت ساخته شد');
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
    public function edit(Banner $banner)
    {
        return view('admin.content.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateBannerRequest $request, ImageUploadService $imageUploadService, Banner $banner)
    {
        $inputs = $request->validated();

        $requestedPositionBanner = Banner::where('position', $inputs['position'])->exists();
        // a banner exists for that position
        if ($requestedPositionBanner) {
            // banner is updating with same position and maybe different image
            if ($banner->position == $inputs['position']) {
                if ($request->hasFile('image')) {

                    if (!empty($slider->image)) {
                        $imageUploadService->removeImage($banner->image);
                    }

                    $result = $imageUploadService->uploadImage($request->file('image'));
                    if ($result === false) {
                        return back()->with('swal-error', 'خطا در آپلود فایل');
                    }
                    $inputs['image'] = $result;
                }
                $banner->update($inputs);
                return to_route('admin.content.banner.index')->with('swal-success', 'بنر با موفقیت ویرایش شد');
            } else {
                // slider is asking for shift position, but that position is occupied so it can't be done
                return to_route('admin.content.banner.index')->with('swal-error', 'برای موقعیت درخواست شده بنر وجود دارد');
            }
        } else {
            // requested position is free so it will be upated
            if ($request->hasFile('image')) {

                if (!empty($slider->image)) {
                    $imageUploadService->removeImage($banner->image);
                }

                $result = $imageUploadService->uploadImage($request->file('image'));
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['image'] = $result;
            }
            $banner->update($inputs);
            return to_route('admin.content.banner.index')->with('swal-success', 'اسلایدر با موفقیت ویرایش شد');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('swal-success', 'بنر با موفقیت حذف شد');
    }
}
