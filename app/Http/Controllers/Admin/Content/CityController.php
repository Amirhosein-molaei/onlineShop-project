<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeCityRequest;
use App\Http\Requests\Admin\Content\updateCityRequest;
use App\Models\Province;
use App\Models\User\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::paginate(10);
        return view('admin.content.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.content.city.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeCityRequest $request)
    {
        $inputs = $request->validated();
        // dd($inputs);
        City::create($inputs);
        return to_route('admin.content.city.index')->with('swal-success', 'شهر با موفقیت ساخته شد');
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
    public function edit(City $city)
    {
        $provinces = Province::all();
        return view('admin.content.city.edit', compact('city', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCityRequest $request, City $city)
    {
        $inputs = $request->validated();
        $city->update($inputs);

        return to_route('admin.content.city.index')->with('swal-success', 'شهر با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return to_route('admin.content.city.index')->with('swal-success', 'شهر با موفقیت حذف شد');
    }
}
