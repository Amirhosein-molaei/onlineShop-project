<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreProductRequest;
use App\Http\Requests\Admin\Market\UpdateProductRequest;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = ProductCategory::all();
        return view('admin.market.product.create', compact('categories', 'brands'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();
        if ($request->hasFile('image')) {
            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }
        
        $product = Product::create($inputs);
        return to_route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت ساخته شد');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.market.product.show', compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = ProductCategory::all();
        return view('admin.market.product.edit', compact('categories', 'brands', 'product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, ImageUploadService $imageUploadService, Product $product)
    {
        $inputs = $request->validated();
        if ($request->hasFile('image')) {
            //remove previous image if a new one is send by user
            if (!empty($product->image)) {             
                $imageUploadService->removeImage($product->image);
            }

            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }

        $product->update($inputs);
        return to_route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت ویرایش شد');       
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت حذف شد');
    }
}
