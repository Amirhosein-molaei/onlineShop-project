@extends('admin.layouts.master')
@section('title', 'روش های ارسال')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    روش های ارسال
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد روش های ارسال به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.market.delivery.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">زمان</th>
                        <th scope="col">واحد</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $delivery->name }}</td>
                            <td>{{ number_format($delivery->amount) }}</td>
                            <td>{{ $delivery->delivery_time }}</td>
                            <td>{{ $delivery->delivery_time_unit }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.market.delivery.destroy', $delivery) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.market.delivery.edit', $delivery) }}"
                                            class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </section>
@endsection
