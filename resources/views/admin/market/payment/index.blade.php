@extends('admin.layouts.master')
@section('title', 'روش های ارسال')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    پرداخت ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد پرداخت ها به شما داده می شود
                </p>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">توسط کاربر</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">نوع پرداخت</th>
                        <th scope="col">درگاه پرداخت</th>
                        <th scope="col">شناسه پرداخت</th>
                        <th scope="col">کد پیگری</th>
                        <th scope="col">تاریخ پرداخت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ number_format($payment->amount) }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td>
                                @if ($payment->status == 0)
                                    در انتظار پرداخت
                                @elseif ($payment->status == 1)
                                    پرداخت شده
                                @else
                                    پرداخت نشده
                                @endif
                            </td>
                            <td>{{ $payment->type == 0 ? 'آنلاین' : 'نقدی'}}</td>
                            <td>{{ $payment->gateway }}</td>
                            <td>{{ $payment->transaction_id }}</td>
                            <td>{{ $payment->tracking_code }}</td>
                            <td>{{ jdate($payment->created_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </section>
@endsection
