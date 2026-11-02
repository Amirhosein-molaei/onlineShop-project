<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreCopanRequest;
use App\Http\Requests\Admin\Market\UpdateCopanRequest;
use App\Models\Market\Copan;
use Illuminate\Http\Request;

class CopanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $copans = Copan::all();
        return view('admin.market.copan.index', compact('copans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.copan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCopanRequest $request)
    {
        $inputs = $request->validated();
        // if( $inputs['amount_type'] == 0 and $inputs['amount'] > 100) {
        //     return to_route('admin.market.copan.create')->with('swal-success', 'کد تخفیف نمیتواند بیش از 100 درصد باشد');
        // }
        $realStartDate = substr($inputs['start_date'], 0, 10);
        $realEndDate = substr($inputs['end_date'], 0, 10);

        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realStartDate);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realEndDate);

        $copan = Copan::create($inputs);
        return to_route('admin.market.copan.index')->with('swal-success', 'کد تخفیف با موفقیت ساخته شد');
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
    public function edit(Copan $copan)
    {
        return view('admin.market.copan.edit', compact('copan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCopanRequest $request, Copan $copan)
    {
        $inputs = $request->validated();
        $realStartDate = substr($inputs['start_date'], 0, 10);
        $realEndDate = substr($inputs['end_date'], 0, 10);

        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realStartDate);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realEndDate);
        
        $copan->update(attributes: $inputs);
        return to_route(route: 'admin.market.copan.index')->with('swal-success', 'کد تخفیف با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copan $copan)
    {
        $copan->delete();
        return to_route(route: 'admin.market.copan.index')->with('swal-success', 'کد تخفیف با موفقیت حذف شد');
    }
}
