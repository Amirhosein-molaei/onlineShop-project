<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();
        return view('admin.market.product-image.index', compact('images', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product-image.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,gif'
        ]);
        if ($request->hasFile('image')) {
            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }
        $inputs['product_id'] = $product->id;
        
        $image = ProductImage::create($inputs);
        return to_route('admin.market.product-image.index', $product)->with('swal-success', 'تصویر با موفقیت ساخته شد');
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
    public function edit(Product $product, ProductImage $productImage)
    {
        return view('admin.market.product-image.edit', compact('product', 'productImage'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, ProductImage $productImage, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);

        if ($request->hasFile('image')) {
            //remove previous image if a new one is send by user
            if (!empty($productImage->image)) {             
                $imageUploadService->removeImage($productImage->image);
            }
            
            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }

        $productImage->update($inputs);
        return to_route('admin.market.product-image.index', $product)->with('swal-success', 'تصویر با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductImage $productImage)
    {
        $productImage->delete();
        return to_route('admin.market.product-image.index', $product)->with('swal-success', 'تصویر با موفقیت حذف شد');
    }
}
