<?php

namespace App\Http\Controllers\Home\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\User\storeAddressRequest;
use App\Http\Requests\Home\User\updateAddressRequest;
use App\Models\Province;
use App\Models\User\Address;
use App\Models\User\City;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $provinces = Province::all();
        return view('app.profile.addresses', compact( 'provinces', 'user'));
    }

    /**
     * get cities based on selected province
     */
    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeAddressRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::user()->id;
        
        Address::create($inputs);
        return to_route('profile.address.index')->with('success', 'آدرس با موفقیت ذخیره شد');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateAddressRequest $request, Address $address)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::user()->id;
        
        $address->update($inputs);
        return to_route('profile.address.index')->with('success', 'آدرس با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return to_route('profile.address.index')->with('success', 'آدرس با موفقیت حذف شد');
    }
}
