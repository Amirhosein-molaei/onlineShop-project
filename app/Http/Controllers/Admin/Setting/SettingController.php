<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\StoreOrUpdateSettingRequest;
use App\Models\Setting\Setting;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function set()
    {
        $setting = Setting::first();
        return view('admin.setting.setting.set', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function setStore(StoreOrUpdateSettingRequest $request, ImageUploadService $imageUploadService)
    {
        $setting = Setting::first();
        $inputs = $request->validated();
        if ($setting) {
            // updating setting
            //remove previous logo if a new one is send by user and upload the new one
            if ($request->hasFile('logo')) {
                if (!empty($setting->logo)) {
                    $imageUploadService->removeImage($setting->logo);
                }

                $result = $imageUploadService->uploadImage($request->file('logo'), 'logo');
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['logo'] = $result;
            }

            //remove previous icon if a new one is send by user and upload the new one
            if ($request->hasFile('icon')) {
                if (!empty($setting->icon)) {
                    $imageUploadService->removeImage($setting->logo);
                }

                $result = $imageUploadService->uploadImage($request->file('icon'), 'icon');
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['icon'] = $result;
            }

            $setting->update($inputs);
            return to_route('admin.setting.')->with('swal-success', 'تنظیمات با موفقیت ویرایش شد');
        } else {
            // creating setting
            if ($request->hasFile('logo')) {
                $result = $imageUploadService->uploadImage($request->file('logo'), 'logo');
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['logo'] = $result;
            }

            if ($request->hasFile('icon')) {
                $result = $imageUploadService->uploadImage($request->file('icon'), 'icon');
                if ($result === false) {
                    return back()->with('swal-error', 'خطا در آپلود فایل');
                }
                $inputs['icon'] = $result;
            }

            Setting::create($inputs);
            return to_route('admin.setting.')->with('swal-success', 'تنظیمات با موفقیت ساخته شد');
        }
    }
}
