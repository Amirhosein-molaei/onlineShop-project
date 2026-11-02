<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // sliders
        $mainSliders = Slider::where('position', 0)->get();
        $topLeftSlider = Slider::where('position', 1)->first();
        $bottomLeftSlider = Slider::where('position', 2)->first();
        $leftBanner = Banner::where('position', 0)->first();
        $rightBanner = Banner::where('position', 1)->first();
        $bottomBanner = Banner::where('position', 2)->first();

        //must viewed products
        $mostViewedProducts = Product::where('marketable', 1)->orderBy('view_count', 'desc')->take(8)->get();

        $popularProducts = Product::where('marketable', 1)->inRandomOrder()->take(8)->get();

        $brands = Brand::all();
        return view('app.index', compact('mainSliders', 'topLeftSlider', 'bottomLeftSlider', 'leftBanner', 'rightBanner', 'bottomBanner', 'mostViewedProducts', 'popularProducts', 'brands'));
    }

    public function show(Product $product)
    {
        $product->increment('view_count');

        $relatedProducts = Product::where('marketable', 1)->where('brand_id', $product->brand_id)->whereNot('id', $product->id)->inRandomOrder()->take(8)->get();

        return view('app.product', compact('product', 'relatedProducts'));
    }
}
