@extends('app.layouts.master')
@section('title', 'سبد خرید')

@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9 mb-3">
                            @if (session('error'))
                                <section class="alert alert-danger">
                                    {{ session('error') }}
                                </section>
                            @endif
                            <section class="content-wrapper bg-white p-3 rounded-2">
                                @foreach ($cart->items as $item)
                                    <section class="cart-item d-md-flex py-3">
                                        <section class="cart-img align-self-start flex-shrink-1"><img
                                                src="{{ asset($item->product->image) }}" alt=""></section>
                                        <section class="align-self-start w-100">
                                            <p class="fw-bold">{{ $item->product->name }}</p>
                                            <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span>
                                                    گارانتی اصالت و سلامت فیزیکی کالا</span></p>
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا
                                                    موجود
                                                    در انبار</span></p>
                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <form action="{{ route('cart.add', $item->product->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        <button class="cart-number-up" type="submit">+</button>
                                                    </form>
                                                    <input class="" type="number" step="1"
                                                        value="{{ $item->quantity }}" readonly="readonly">
                                                    @if ($item->quantity > 1)
                                                        <form action="{{ route('cart.decrease', $item->id) }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="cart-number-down" type="submit">-</button>
                                                        </form>
                                                    @endif
                                                </section>
                                                <form action="{{ route('cart.remove', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link text-decoration-none ms-4 cart-delete d-inline" type="submit">
                                                        <i class="fa fa-trash-alt"></i> حذف از سبد
                                                    </button>
                                                </form>
                                            </section>
                                        </section>
                                        <section class="align-self-end flex-shrink-1">
                                            <section class="text-nowrap fw-bold">{{ number_format($item->total_price) }} تومان</section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها (2)</p>
                                    <p class="text-muted">{{ number_format($cart->total_price) }} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder">78,000 تومان</p>
                                </section>
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder">{{ number_format($cart->total_price) }} تومان</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت
                                    سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید.
                                    نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این
                                    سفارش صورت میگیرد.
                                </p>


                                <section class="">
                                    <a href="{{ route('checkout') }}" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

@endsection
