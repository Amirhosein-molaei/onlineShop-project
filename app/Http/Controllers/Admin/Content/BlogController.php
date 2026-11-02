<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StoreBlogRequest;
use App\Http\Requests\Admin\Content\UpdateBlogRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.content.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $inputs = $request->validated();
        Blog::create($inputs);
        return to_route('admin.content.blog.index')->with('swal-success', 'بلاگ با موفقیت ساخته شد');
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
    public function edit(Blog $blog)
    {
        return view('admin.content.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $inputs = $request->validated();
        $blog->update($inputs);

        return to_route('admin.content.blog.index')->with('swal-success', 'بلاگ با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return to_route('admin.content.blog.index')->with('swal-success', 'بلاگ با موفقیت حذف شد');
    }
}
