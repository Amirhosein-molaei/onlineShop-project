@extends('app.layouts.master')
@section('title', 'تکمیل سفارش و پرداخت')

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
                                <span>انتخاب روش ارسال و آدرس</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            کد تخفیف
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if ($cart->copan_id)
                                    <div class="alert alert-success">
                                        کد تخفیف با موفقیت اعمال شد
                                    </div>
                                @else
                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                        role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            کد تخفیف خود را در این بخش وارد کنید.
                                        </secrion>
                                    </section>

                                    <form action="{{ route('checkout.apply-discount') }}" method="post">
                                        @csrf
                                        <section class="row">
                                            <section class="col-md-5">
                                                <section class="input-group input-group-sm">
                                                    <input type="text" name="code" class="form-control"
                                                        placeholder="کد تخفیف را وارد کنید">
                                                    <button class="btn btn-primary" type="submit">اعمال کد</button>
                                                </section>
                                            </section>

                                        </section>
                                    </form>
                                @endif
                            </section>


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <form action="{{ route('order-submit') }}" method="post" class="w-full">
                                    @csrf
                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب روش ارسال
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>

                                    <section class="payment-select">
                                        @foreach ($deliveries as $delivery)
                                            <input type="radio" name="delivery_id" value="{{ $delivery->id }}"
                                                id="d_{{ $delivery->id }}" required />
                                            <label for="d_{{ $delivery->id }}"
                                                class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                                <section class="mb-2">
                                                    <i class="fa fa-truck mx-1"></i>
                                                    {{ $delivery->name }}
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-calendar-alt mx-1"></i>
                                                    میانگین زمان ارسال
                                                    {{ $delivery->delivery_time . ' ' . $delivery->delivery_time_unit }}
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-cash-register mx-1"></i>
                                                    هزینه : {{ number_format($delivery->amount) }} تومان
                                                </section>
                                            </label>
                                            <section class="mb-2"></section>
                                        @endforeach

                                    </section>

                                    {{-- addres selection  --}}
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب آدرس
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>
                                    
                                    <section class="payment-select">
                                        @foreach (Auth::user()->addresses as $address)
                                            <input type="radio" name="address_id" value="{{ $address->id }}"
                                                id="a_{{ $address->id }}" required />
                                            <label for="a_{{ $address->id }}"
                                                class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                                <section class="mb-2">
                                                    <i class="fa fa-city mx-1"></i>
                                                    {{ $address->city->name . '/' . $address->city->province->name . '/' . $address->address }}
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-mail-bulk mx-1"></i>
                                                    {{ $address->postal_code }}
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-building mx-1"></i>
                                                     پلاک {{ $address->no }} - واحد {{ $address->unit }}
                                                </section>
                                            </label>
                                            <section class="mb-2"></section>
                                        @endforeach

                                    </section>
                            </section>




                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ $cart->items->count() }})</p>
                                    <p class="text-muted">{{ number_format($cart->total_price) }} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder">{{ number_format($cart->total_off_price) }} تومان</p>
                                </section>

                                <section class="border-bottom mb-3"></section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که انتخاب
                                    می کنید در مدت زمان ذکر شده ارسال می شود.
                                </p>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">مبلغ قابل پرداخت</p>
                                    <p class="fw-bold">{{ number_format($cart->total_price - $cart->total_off_price) }}
                                        تومان</p>
                                </section>
                                <section class="w-full">
                                    <button id="" type="submit" class="btn btn-danger w-full">ثبت سفارش</a>
                                </section>

                            </section>
                        </section>
                        </form>

                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

@endsection
