@extends('app.layouts.master')
@section('title', $product->title)

@section('content')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">

        <!-- start cart -->
        <section class="mb-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>{{ $product->name }}</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <section class="row mt-4">
                            <!-- start image gallery -->
                            <section class="col-md-4">
                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                    <section class="product-gallery">
                                        <section class="product-gallery-selected-image mb-3">
                                            <img src="{{ asset($product->image) }}" alt="" class="W-100">
                                        </section>
                                        <section class="product-gallery-thumbs">
                                            <img src="{{ asset($product->image) }}" alt="" class="product-gallery-thumb" data-input="{{ asset($product->image) }}">
                                            @foreach ($product->images as $image)
                                                
                                            <img class="product-gallery-thumb" src="{{ asset($image->image) }}"
                                            alt="" data-input="{{ asset($image->image) }}">
                                            @endforeach
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <!-- end image gallery -->
                            <!-- start product info -->
                            <section class="col-md-5">

                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                {{ $product->name }}
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>
                                    <section class="product-info">
                                        <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span>
                                                گارانتی اصالت و سلامت فیزیکی کالا</span></p>
                                        <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود
                                                در انبار</span></p>
                                        <p><a class="btn btn-light  btn-sm text-decoration-none" href="#"><i
                                                    class="fa fa-heart text-danger"></i> افزودن به علاقه مندی</a></p>
                                        <section>
                                            <section class="cart-product-number d-inline-block ">
                                                <button class="cart-number-down" type="button">-</button>
                                                <input class="" type="number" min="1" max="5"
                                                    step="1" value="1" readonly="readonly">
                                                <button class="cart-number-up" type="button">+</button>
                                            </section>
                                        </section>
                                        <p class="mb-3 mt-5">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است.
                                            برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال
                                            را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد.
                                            و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال
                                            که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                        </p>
                                    </section>
                                </section>

                            </section>
                            <!-- end product info -->

                            <section class="col-md-3">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالا</p>
                                        <p class="text-muted">{{ number_format($product->price) }} <span
                                                class="small">تومان</span></p>
                                    </section>

                                    <section class="border-bottom mb-3"></section>
                                    <section class="">
                                        <form action="{{ route('cart.add', $product->id) }}" method="post" class="m-0 p-0">
                                            @csrf
                                            <button id="next-level" type="submit"
                                                class="btn btn-danger d-block w-100">افزودن به سبد خرید</button>
                                        </form>
                                    </section>

                                </section>
                            </section>
                        </section>
                    </section>
                </section>

            </section>
        </section>
        <!-- end cart -->



        <!-- start product lazy load -->
        <section class="mb-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>کالاهای مرتبط</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach ($relatedProducts as $relatedProduct)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <a class="product-link" href="#">
                                                        <section class="product-image">
                                                            <img class="" src="{{ asset($relatedProduct->image) }}"
                                                                alt="">
                                                        </section>
                                                        <section class="product-colors"></section>
                                                        <section class="product-name">
                                                            <h3>{{ $relatedProduct->name }}</h3>
                                                        </section>
                                                        <section class="product-price-wrapper">
                                                            <section class="product-price">
                                                                {{ number_format($relatedProduct->price) }} تومان
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

        <!-- start description, features and comments -->
        <section class="mb-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start content header -->
                            <section id="introduction-features-comments" class="introduction-features-comments">
                                <section class="content-header">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title">
                                            <span class="me-2"><a class="text-decoration-none text-dark"
                                                    href="#introduction">معرفی</a></span>
                                            <span class="me-2"><a class="text-decoration-none text-dark"
                                                    href="#features">ویژگی ها</a></span>
                                            <span class="me-2"><a class="text-decoration-none text-dark"
                                                    href="#comments">دیدگاه ها</a></span>
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <!-- start content header -->

                            <section class="py-4">

                                <!-- start vontent header -->
                                <section id="introduction" class="content-header mt-2 mb-4">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            معرفی
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-introduction mb-4">
                                    {{ $product->description }}
                                </section>

                                <!-- start vontent header -->
                                <section id="features" class="content-header mt-2 mb-4">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            ویژگی ها
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-features mb-4 table-responsive">
                                    <table class="table table-bordered border-white">
                                        <tr>
                                            <td>وزن</td>
                                            <td>{{ $product->weight }} گرم</td>
                                        </tr>
                                        <tr>
                                            <td>طول</td>
                                            <td>{{ $product->length }}</td>
                                        </tr>
                                        <tr>
                                            <td>عرض</td>
                                            <td>{{ $product->width }}</td>
                                        </tr>
                                        <tr>
                                            <td>ارتفاع</td>
                                            <td>{{ $product->height }}</td>
                                        </tr>
                                        
                                    </table>
                                </section>

                                <!-- start vontent header -->
                                <section id="comments" class="content-header mt-2 mb-4">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            دیدگاه ها
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-comments mb-4">

                                    @if (Auth::check())
                                        <section class="comment-add-wrapper">
                                            <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                                data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن
                                                دیدگاه</button>
                                            <!-- start add comment Modal -->
                                            <section class="modal fade" id="add-comment" tabindex="-1"
                                                aria-labelledby="add-comment-label" aria-hidden="true">
                                                <section class="modal-dialog">
                                                    <section class="modal-content">
                                                        <section class="modal-header">
                                                            <h5 class="modal-title" id="add-comment-label"><i
                                                                    class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </section>
                                                        <section class="modal-body">
                                                            <form class="row"
                                                                action="{{ route('product.add-comment', $product) }}"
                                                                method="post">
                                                                @csrf

                                                                <section class="col-12 mb-2">
                                                                    <label for="body" class="form-label mb-1">دیدگاه
                                                                        شما</label>
                                                                    <textarea class="form-control form-control-sm" id="body" name="body" placeholder="دیدگاه شما ..."
                                                                        rows="5">{{ old('body') }}</textarea>
                                                                </section>

                                                                <button type="submit"
                                                                    class="w-25 mx-auto btn btn-sm btn-primary">ثبت
                                                                    دیدگاه</button>
                                                            </form>
                                                        </section>
                                                        <section class="modal-footer py-1">
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-dismiss="modal">بستن</button>
                                                        </section>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>
                                    @endif
                                    @foreach ($product->comments->where('status', 2) as $comment)
                                        <section class="product-comment">
                                            <section class="product-comment-header d-flex justify-content-start">
                                                <section class="product-comment-date">{{ jdate($comment->created_at) }}
                                                </section>
                                                <section class="product-comment-title">{{ $comment->user->name }}
                                                </section>
                                            </section>
                                            <section class="product-comment-body">
                                                {{ $comment->body }}
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
        <!-- end description, features and comments -->

    </main>
    <!-- end main one col -->
@endsection
