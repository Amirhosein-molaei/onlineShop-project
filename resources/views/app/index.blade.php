@extends('app.layouts.master')
@section('title', 'خانه')

@section('content')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">

        <!-- start slideshow -->
        <section class="container-xxl my-4">
            <section class="row">
                <section class="col-md-8 pe-md-1 ">
                    <section id="slideshow" class="owl-carousel owl-theme">
                        @foreach ($mainSliders as $mainSlider)
                            <section class="item">
                                <a class="w-100 d-block h-auto text-decoration-none" href="#">
                                    <img class="w-100 rounded-2 d-block h-auto" src="{{ asset($mainSlider->image) }}"
                                        alt="">
                                </a>
                            </section>
                        @endforeach
                    </section>
                </section>
                <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                    @if ($topLeftSlider)
                        <section class="mb-2">
                            <a href="#" class="d-block"><img class="w-100 rounded-2"
                                    src="{{ asset($topLeftSlider->image) }}" alt="">
                            </a>
                        </section>
                    @endif
                    @if ($bottomLeftSlider)
                        <section class="mb-2">
                            <a href="#" class="d-block"><img class="w-100 rounded-2"
                                    src="{{ asset($bottomLeftSlider->image) }}" alt="">
                            </a>
                        </section>
                    @endif
                </section>
            </section>
        </section>
        <!-- end slideshow -->



        <!-- start product lazy load -->
        <section class="mb-3">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>پربازدیدترین کالاها</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="#">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach ($mostViewedProducts as $mostViewedProduct)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <section class="product-add-to-cart"><a href=""
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                    </section>
                                                    <section class="product-add-to-favorite"><a href="#"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>
                                                    </section>
                                                    <a class="product-link"
                                                        href="{{ route('product', $mostViewedProduct) }}">
                                                        <section class="product-image">
                                                            <img class="" src="{{ asset($mostViewedProduct->image) }}"
                                                                alt="">
                                                        </section>
                                                        <section class="product-colors"></section>
                                                        <section class="product-name">
                                                            <h3>{{ $mostViewedProduct->name }}</h3>
                                                        </section>
                                                        <section class="product-price-wrapper">
                                                            <section class="product-price">
                                                                {{ number_format($mostViewedProduct->price) }} تومان
                                                            </section>
                                                        </section>
                                                    </a>
                                                </section>
                                            </section>
                                        </section>
                                    @endforeach

                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end product lazy load -->



        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- two column-->
                <section class="row py-4">
                    <section class="col-12 col-md-6 mt-2 mt-md-0">
                        @if ($rightBanner)
                        <img class="d-block rounded-2 w-100" src="{{ asset($rightBanner->image) }}" alt="">
                        @endif
                    </section>
                    <section class="col-12 col-md-6 mt-2 mt-md-0">
                        @if ($leftBanner)
                            <img class="d-block rounded-2 w-100" src="{{ asset($leftBanner->image) }}" alt="">
                        @endif
                    </section>
                </section>

            </section>
        </section>
        <!-- end ads section -->


        <!-- start product lazy load -->
        <section class="mb-3">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>پیشنهاد آمازون به شما</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="#">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach ($popularProducts as $popularProduct)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <section class="product-add-to-cart"><a href="#"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                    </section>
                                                    <section class="product-add-to-favorite"><a href="#"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>
                                                    </section>
                                                    <a class="product-link"
                                                        href="{{ route('product', $popularProduct) }}">
                                                        <section class="product-image">
                                                            <img class="" src="{{ asset($popularProduct->image) }}"
                                                                alt="">
                                                        </section>
                                                        <section class="product-colors"></section>
                                                        <section class="product-name">
                                                            <h3>{{ $popularProduct->name }}</h3>
                                                        </section>
                                                        <section class="product-price-wrapper">
                                                            <section class="product-price">
                                                                {{ number_format($popularProduct->price) }} تومان
                                                            </section>
                                                        </section>
                                                    </a>
                                                </section>
                                            </section>
                                        </section>
                                    @endforeach

                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end product lazy load -->


        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- one column -->
                <section class="row py-4">
                    <section class="col">
                        @if ($bottomBanner)
                            <img class="d-block rounded-2 w-100" src="{{ asset($bottomBanner->image) }}" alt="">
                        @endif
                    </section>
                </section>

            </section>
        </section>
        <!-- end ads section -->



        <!-- start brand part-->
        <section class="brand-part mb-4 py-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex align-items-center">
                                <h2 class="content-header-title">
                                    <span>برندهای ویژه</span>
                                </h2>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="brands-wrapper py-4">
                            <section class="brands dark-owl-nav owl-carousel owl-theme">
                                @foreach ($brands as $brand)
                                    <section class="item">
                                        <section class="brand-item">
                                            <a href="#">
                                                <img class="rounded-2" src="{{ asset($brand->logo) }}" alt="">
                                            </a>
                                        </section>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end brand part-->

    </main>
    <!-- end main one col -->
@endsection
