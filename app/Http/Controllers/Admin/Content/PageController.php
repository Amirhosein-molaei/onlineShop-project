<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StorePageRequest;
use App\Http\Requests\Admin\Content\UpdatePageRequest;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.content.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $inputs = $request->validated();
        Page::create($inputs);
        return to_route('admin.content.page.index')->with('swal-success', 'صفحه با موفقیت ساخته شد');
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
    public function edit(Page $page)
    {
        return view('admin.content.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $inputs = $request->validated();
        $page->update($inputs);

        return to_route('admin.content.page.index')->with('swal-success', 'صفحه با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return to_route('admin.content.page.index')->with('swal-success', 'صفحه با موفقیت حذف شد');
    }
}
