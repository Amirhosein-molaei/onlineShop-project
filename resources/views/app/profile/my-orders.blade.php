@extends('app.layouts.master')
@section('title', 'لیست سفارشات من')

@section('content')

    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        @include('app.profile.partials.sidebar')
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه سفارشات</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->


                        <section class="d-flex justify-content-center my-4">
                            <a class="btn btn-info btn-sm mx-1"
                                href="{{ route('profile.my-orders', ['order_status' => 0]) }}">در انتظار پرداخت</a>
                            <a class="btn btn-warning btn-sm mx-1"
                                href="{{ route('profile.my-orders', ['order_status' => 1]) }}">در حال پردازش</a>
                            <a class="btn btn-success btn-sm mx-1"
                                href="{{ route('profile.my-orders', ['order_status' => 2]) }}">تحویل شده</a>
                            <a class="btn btn-dark btn-sm mx-1"
                                href="{{ route('profile.my-orders', ['order_status' => 3]) }}">لغو شده</a>
                            <a class="btn btn-danger btn-sm mx-1"
                                href="{{ route('profile.my-orders', ['order_status' => 4]) }}">مرجوعی</a>
                        </section>


                        <!-- start content header -->
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    @if (isset($filtered) and $orders->count() > 0)
                                        {{ $orders[0]->order_status }}
                                    @endif
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->


                        <section class="order-wrapper">

                            @forelse ($orders as $order)
                                <section class="order-item">
                                    <section class="d-flex justify-content-between">
                                        <section class="w-75">
                                            <section class="order-item-date"><i class="fa fa-calendar-alt"></i> تاریخ سفارش: 
                                                {{ jDate($order->created_at) }}
                                            </section>
                                            <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد پیگیری سفارش :
                                                {{ $order->id }}
                                            </section>
                                            <section class="order-item-status"><i class="fa fa-clock"></i>
                                                {{ $order->order_status }}
                                            </section>
                                            <section class="order-item-products mt-3">

                                                <h5>محصولات :</h5>

                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>تصویر</th>
                                                            <th>نام</th>
                                                            <th>تعداد</th>
                                                            <th>قیمت</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($order->items as $item)
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ asset($item->product->image) }}" alt=""
                                                                        style="width: 60px; height: 60px;">
                                                                </td>
                                                                <td>{{ $item->product->name }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ number_format($item->total_price) }} تومان</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </section>
                                        </section>
                                        <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                                    </section>
                                </section>
                            @empty
                                <p>سفارشی یافت نشد</p>
                            @endforelse
                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
