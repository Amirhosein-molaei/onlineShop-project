<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeProvinceRequest;
use App\Http\Requests\Admin\Content\updateProvinceRequest;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::paginate(10);
        return view('admin.content.province.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.province.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProvinceRequest $request)
    {
        $inputs = $request->validated();
        Province::create($inputs);
        return to_route('admin.content.province.index')->with('swal-success', 'استان با موفقیت ساخته شد');
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
    public function edit(Province $province)
    {
        return view('admin.content.حrovince.edit', compact('حrovince'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProvinceRequest $request, Province $province)
    {
        $inputs = $request->validated();
        $province->update($inputs);

        return to_route('admin.content.province.index')->with('swal-success', 'استان با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        $province->delete();
        return to_route('admin.content.province.index')->with('swal-success', 'استان با موفقیت حذف شد');
    }
}
